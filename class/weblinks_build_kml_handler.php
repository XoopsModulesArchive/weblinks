<?php
// $Id: weblinks_build_kml_handler.php,v 1.2 2008/02/28 02:52:17 ohwada Exp $

//=========================================================
// WebLinks Module
// 2008-02-17 K.OHWADA
//=========================================================

// === class begin ===
if (!class_exists('weblinks_build_kml_handler')) {

    //=========================================================
    // class weblinks_build_kml_handler
    //=========================================================
    class weblinks_build_kml_handler extends happy_linux_build_kml
    {
        public $_DIRNAME;

        public $_config_handler;
        public $_link_handler;
        public $_link_view;
        public $_htmlout;
        public $_myts;
        public $_strings;

        public $_conf;

        public $_LANG_NO_MATCH = 'No matches found for your query';
        public $_MIN_PAGE      = 1; // page start from 1

        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------
        public function __construct($dirname)
        {
            $this->_DIRNAME = $dirname;
            $DIR_XML        = XOOPS_ROOT_PATH . '/modules/' . $dirname . '/templates/xml';

            parent::__construct();
            $this->set_template($DIR_XML . '/weblinks_build_kml.html');
            $this->init_obj();

            $this->_config_handler = weblinks_get_handler('config2_basic', $dirname);
            $this->_link_handler   = weblinks_get_handler('link_basic', $dirname);
            $this->_link_view      = weblinks_link_view_basic::getInstance($dirname);
            $this->_htmlout        = weblinks_htmlout::getInstance($dirname);

            $this->_myts    = MyTextSanitizer::getInstance();
            $this->_strings = happy_linux_strings::getInstance();

            $this->_conf = $this->_config_handler->get_conf();

            $this->_htmlout->add_plugin_line('kmlout', $this->_conf['kmlout']);
        }

        //---------------------------------------------------------
        // public
        //---------------------------------------------------------
        public function build()
        {
            if ($this->_get_op() == 'page') {
                $this->build_by_page();
                return;
            } elseif ($this->_get_op() == 'lid') {
                $this->build_by_lid();
                return;
            }
            $this->_print_error($this->_LANG_NO_MATCH);
        }

        public function view()
        {
            if ($this->_get_op() == 'page') {
                $this->view_by_page();
                return;
            } elseif ($this->_get_op() == 'lid') {
                $this->view_by_lid();
                return;
            }
            $this->_print_error($this->_LANG_NO_MATCH);
        }

        public function build_by_page($page = null, $limit = null)
        {
            $ret = $this->_execute_page($page, $limit);
            if (!$ret) {
                return false;
            }

            $this->build_kml();
        }

        public function build_by_lid($lid = null)
        {
            $ret = $this->_execute_lid($lid);
            if (!$ret) {
                return false;
            }

            $this->build_kml();
        }

        public function view_by_page($page = null, $limit = null)
        {
            $ret = $this->_execute_page($page, $limit);
            if (!$ret) {
                return false;
            }

            $this->view_kml();
        }

        public function view_by_lid($lid = null)
        {
            $ret = $this->_execute_lid($lid);
            if (!$ret) {
                return false;
            }

            $this->view_kml();
        }

        //---------------------------------------------------------
        // private
        //---------------------------------------------------------
        public function _execute_page($page, $limit)
        {
            if (empty($page)) {
                $page = $this->_get_page();
            }

            if (empty($limit)) {
                $limit = $this->_get_limit();
            }

            $rows = $this->_get_placemarks_page($page, $limit);
            if (!is_array($rows) || !count($rows)) {
                $this->_print_error($this->_LANG_NO_MATCH);
                return false;
            }

            $this->set_page($page);

            $this->set_document_tag_use(true);
            $this->set_document_open_use(true);
            $this->set_document_name($this->build_document_name());

            $this->set_folder_tag_use(true);
            $this->set_folder_name($this->build_folder_name());

            $this->set_placemarks($rows);
            return true;
        }

        public function _execute_lid($lid)
        {
            if (empty($lid)) {
                $lid = $this->_get_lid();
            }

            $row = $this->_get_placemarks_single($lid);
            if (!is_array($row) || !count($row)) {
                $this->_print_error($this->_LANG_NO_MATCH);
                return false;
            }

            $this->set_document_tag_use(true);
            $this->set_document_open_use(true);
            $this->set_document_name($this->build_document_name());

            $rows = array($row);
            $this->set_placemarks($rows);
            return true;
        }

        public function _get_op()
        {
            $op = '';
            if (isset($_GET['page'])) {
                $op = 'page';
            }
            if (isset($_GET['lid'])) {
                $op = 'lid';
            }
            return $op;
        }

        public function _get_lid()
        {
            $lid = isset($_GET['lid']) ? (int)$_GET['lid'] : 0;
            return $lid;
        }

        public function _get_page()
        {
            $page = isset($_GET['page']) ? (int)$_GET['page'] : $this->_MIN_PAGE;
            if ($page < $this->_MIN_PAGE) {
                $page = $this->_MIN_PAGE;
            }
            return $page;
        }

        public function _get_limit()
        {
            $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 0;
            return $limit;
        }

        public function _print_error($err)
        {
            echo $this->build_html_header($this->_view_title, false);
            echo $this->build_highlight($this->xml_utf8($error));
            echo $this->build_html_footer();
        }

        //---------------------------------------------------------
        // link handler
        //---------------------------------------------------------
        public function _get_placemarks_page($page, $limit)
        {
            $flase = false;
            $start = $limit * ($page - 1);

            $lid_array =& $this->_link_handler->get_lid_array_gmap_by_orderby(null, $start, $limit);

            if (!is_array($lid_array) || !count($lid_array)) {
                return $false;
            }

            $arr = array();
            foreach ($lid_array as $lid) {
                $arr[] = $this->_get_kml_by_lid($lid);
            }
            return $arr;
        }

        public function _get_placemarks_single($lid)
        {
            return $this->_get_kml_by_lid($lid);
        }

        public function _get_kml_by_lid($lid)
        {
            // not use return references
            $arr1 = $this->_link_view->get_kml_by_lid($lid);
            $arr2 = $this->_htmlout->execute($arr1);
            $arr3 = array();
            foreach ($arr2 as $k => $v) {
                // match
                if (strpos($k, 'kml_') === 0) {
                    $name        = str_replace('kml_', '', $k);
                    $arr3[$name] = $v;
                }
            }
            return $arr3;
        }

        // --- class end ---
    }

    // === class end ===
}
