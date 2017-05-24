<?php
// $Id: weblinks_pagerank_update_handler.php,v 1.1 2008/02/26 16:06:49 ohwada Exp $

//=========================================================
// WebLinks Module
// 2008-02-17 K.OHWADA
//=========================================================

// === class begin ===
if (!class_exists('weblinks_pagerank_update_handler')) {

    //=========================================================
    // class weblinks_pagerank_update_handler
    //=========================================================
    class weblinks_pagerank_update_handler extends weblinks_link_check_base
    {
        public $_pagerank_handler;

        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------
        public function __construct($dirname)
        {
            parent::__construct($dirname);

            $this->_pagerank_handler = weblinks_get_handler('pagerank', $dirname);

            $this->_TITLE = 'Update PageRank';
        }

        //---------------------------------------------------------
        // public
        //---------------------------------------------------------
        public function update($limit = 0, $offset = 0)
        {
            return $this->_execute($limit, $offset);
        }

        public function _loop(&$row)
        {
            $pr = $this->_pagerank_handler->get_page_rank($row['lid'], true, true);
            if ($this->_flag_echo_lid) {
                echo '-' . $pr;
            }
        }

        // --- class end ---
    }

    // === class end ===
}
