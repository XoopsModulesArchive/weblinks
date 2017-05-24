<?php
// $Id: weblinks_catlink_basic_handler.php,v 1.1 2007/03/06 02:02:39 ohwada Exp $

// 2007-03-01 K.OHWADA
// divid from weblinks_catlink_handler

//=========================================================
// WebLinks Module
// 2007-03-01 K.OHWADA
//=========================================================

// === class begin ===
if (!class_exists('weblinks_catlink_basic_handler')) {

    //=========================================================
    // class weblinks_catlink_basic_handler
    //=========================================================
    class weblinks_catlink_basic_handler extends happy_linux_basic_handler
    {

        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------
        public function __construct($dirname)
        {
            parent::__construct($dirname);

            $this->set_table_name('catlink');
            $this->set_id_name('jid');

            $this->set_debug_db_sql(WEBLINKS_DEBUG_CATLINK_BASIC_SQL);
            $this->set_debug_db_error(WEBLINKS_DEBUG_ERROR);
            $this->set_debug_print_time(WEBLINKS_DEBUG_TIME);

            // hack for multi site
            if (WEBLINKS_FLAG_MULTI_SITE) {
                $this->renew_prefix(WEBLINKS_DB_PREFIX);
            }
        }

        //---------------------------------------------------------
        // get cid_array
        //---------------------------------------------------------
        public function &get_cid_array_by_lid($lid, $limit = 0, $offset = 0)
        {
            $sql = 'SELECT cid FROM ' . $this->_table . ' WHERE lid=' . (int)$lid;
            $arr =& $this->get_first_row_by_sql($sql);
            return $arr;
        }

        // --- class end ---
    }

    // === class end ===
}
