<?php
// $Id: weblinks_link_count_handler.php,v 1.2 2008/02/26 16:01:37 ohwada Exp $

// 2008-02-17 K.OHWADA
// gmap

// 2007-11-01 K.OHWADA
// divid from weblinks_link_view_handler

//=========================================================
// WebLinks Module
// 2006-05-15 K.OHWADA
//=========================================================

// === class begin ===
if (!class_exists('weblinks_link_count_handler')) {

    //=========================================================
    // class weblinks_link_count_handler
    // show link count in guidance bar
    //=========================================================
    class weblinks_link_count_handler extends happy_linux_error
    {
        public $_DIRNAME;

        public $_config_handler;
        public $_link_handler;
        public $_category_handler;
        public $_catlink_handler;
        public $_link_catlink_handler;

        // local
        public $_conf        = array();
        public $_cached_cid  = array();
        public $_cached_mark = array();

        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------
        public function __construct($dirname)
        {
            parent::__construct();
            $this->set_debug_print_time(WEBLINKS_DEBUG_TIME);

            $this->_DIRNAME = $dirname;

            $this->_config_handler       = weblinks_get_handler('config2_basic', $dirname);
            $this->_link_handler         = weblinks_get_handler('link_basic', $dirname);
            $this->_category_handler     = weblinks_get_handler('category_basic', $dirname);
            $this->_catlink_handler      = weblinks_get_handler('catlink_basic', $dirname);
            $this->_link_catlink_handler = weblinks_get_handler('link_catlink_basic', $dirname);

            $this->_conf =& $this->_config_handler->get_conf();
        }

        //=========================================================
        // public
        //=========================================================
        //---------------------------------------------------------
        // init
        //---------------------------------------------------------
        public function init()
        {
            $this->_category_handler->load_once();
        }

        //---------------------------------------------------------
        // link count
        //---------------------------------------------------------
        // index
        public function get_link_count_public()
        {
            if (isset($this->_cached_mark['public'])) {
                return (int)$this->_cached_mark['public'];
            }

            $count                        = $this->_link_handler->get_count_public();
            $this->_cached_mark['public'] = $count;
            return $count;
        }

        // viewmark
        public function get_link_count_by_mark($mark)
        {
            if (isset($this->_cached_mark[$mark])) {
                return (int)$this->_cached_mark[$mark];
            }

            if ($mark == 'rss') {
                $count = $this->_link_handler->get_count_rss_flag();
            } elseif ($mark == 'gmap') {
                $count = $this->_link_handler->get_count_gmap();
            } else {
                $count = $this->_link_handler->get_count_by_mark($mark);
            }

            $this->_cached_mark[$mark] = $count;
            return $count;
        }

        // viewcat
        public function get_top_link_count_by_cid($cid)
        {
            if (isset($this->_cached_cid[$cid]['top_link_count'])) {
                return (int)$this->_cached_cid[$cid]['top_link_count'];
            }

            $count                                     = $this->_link_catlink_handler->get_count_by_cid($cid);
            $this->_cached_cid[$cid]['top_link_count'] = $count;
            return $count;
        }

        // viewcat
        public function get_all_link_count_by_cid($cid)
        {
            if (isset($this->_cached_cid[$cid]['all_link_count'])) {
                return (int)$this->_cached_cid[$cid]['all_link_count'];
            }

            if ($this->_conf['cat_count']) {
                $count = $this->_category_handler->get_link_count($cid);
            } else {
                $cid_arr =& $this->get_cid_array_patent_children($cid);
                $count   = $this->_link_catlink_handler->get_count_by_cid_array($cid_arr);
            }

            $this->_cached_cid[$cid]['all_link_count'] = $count;
            return $count;
        }

        // search
        public function get_link_count_by_cid_array_where(&$cid_arr, $where)
        {
            return $this->_link_catlink_handler->get_count_by_cid_array_where($cid_arr, $where);
        }

        // search
        public function get_link_count_by_where($where)
        {
            return $this->_link_handler->get_count_by_where($where);
        }

        //---------------------------------------------------------
        // cid array
        //---------------------------------------------------------
        public function &get_cid_array_patent_children($cid)
        {
            return $this->_category_handler->get_parent_and_all_child_id($cid);
        }

        //---------------------------------------------------------
        // config
        //---------------------------------------------------------
        public function get_config()
        {
            return $this->_conf;
        }

        // --- class end ---
    }

    // === class end ===
}
