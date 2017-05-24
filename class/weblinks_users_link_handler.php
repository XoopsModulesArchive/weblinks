<?php
// $Id: weblinks_users_link_handler.php,v 1.1 2007/05/09 04:39:14 ohwada Exp $

//=========================================================
// WebLinks Module
// 2007-05-06 K.OHWADA
//=========================================================

// === class begin ===
if (!class_exists('weblinks_users_link_handler')) {

    //=========================================================
    // class weblinks_users_link_handler
    // handling for table_link & table_catlink
    //=========================================================
    class weblinks_users_link_handler extends happy_linux_basic_handler
    {
        public $_table_xoops_users;
        public $_table_weblinks_link;

        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------
        public function __construct($dirname)
        {
            parent::__construct($dirname);

            // hack for multi site
            if (WEBLINKS_FLAG_MULTI_SITE) {
                $this->renew_prefix(WEBLINKS_DB_PREFIX);
            }

            $this->_table_weblinks_link = $this->prefix('link');
            $this->_table_xoops_users   = $this->db_prefix('users');
        }

        //---------------------------------------------------------
        // count
        //---------------------------------------------------------
        public function &get_uid_count_with_use()
        {
            $sql = 'SELECT COUNT(DISTINCT u.uid) FROM ';
            $sql .= $this->_table_xoops_users . ' u, ';
            $sql .= $this->_table_weblinks_link . ' l ';
            $sql .= 'WHERE u.uid = l.uid ';
            $sql .= 'ORDER BY u.uid';

            $ret =& $this->get_count_by_sql($sql);
            return $ret;
        }

        public function &get_uid_count_without_use($limit = 0, $start = 0)
        {
            $sql = 'SELECT COUNT(u.uid) FROM ';
            $sql .= $this->_table_xoops_users . ' u ';
            $sql .= 'WHERE u.uid NOT IN ( ';
            $sql .= 'SELECT l.uid FROM ';
            $sql .= $this->_table_weblinks_link . ' l ';
            $sql .= ') ';

            $ret =& $this->get_count_by_sql($sql, $limit, $start);
            return $ret;
        }

        //---------------------------------------------------------
        // uid list
        //---------------------------------------------------------
        public function &get_uid_list_with_use($limit = 0, $start = 0)
        {
            $sql = 'SELECT DISTINCT u.uid FROM ';
            $sql .= $this->_table_xoops_users . ' u, ';
            $sql .= $this->_table_weblinks_link . ' l ';
            $sql .= 'WHERE u.uid = l.uid ';
            $sql .= 'ORDER BY u.uid';

            $ret =& $this->get_first_row_by_sql($sql, $limit, $start);
            return $ret;
        }

        public function &get_uid_list_without_use($limit = 0, $start = 0)
        {
            $sql = 'SELECT u.uid FROM ';
            $sql .= $this->_table_xoops_users . ' u ';
            $sql .= 'WHERE u.uid NOT IN ( ';
            $sql .= 'SELECT l.uid FROM ';
            $sql .= $this->_table_weblinks_link . ' l ';
            $sql .= ') ';
            $sql .= 'ORDER BY u.uid';

            $ret =& $this->get_first_row_by_sql($sql, $limit, $start);
            return $ret;
        }

        // --- class end ---
    }

    // === class end ===
}
