<?php
// $Id: weblinks_broken_handler.php,v 1.6 2007/02/27 14:46:00 ohwada Exp $

// 2007-02-20 K.OHWADA
// hack for multi site

// 2006-09-20 K.OHWADA
// use happy_linux

// 2006-05-15 K.OHWADA
// new handler
// not use weblinks_module_base

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//=========================================================
// WebLinks Module
// this file contain 2 class
//   weblinks_broken
//   weblinks_broken_handler
// 2004/01/14 K.OHWADA
//=========================================================

// === class begin ===
if (!class_exists('weblinks_broken_handler')) {

    //=========================================================
    // class weblinks_broken
    //=========================================================
    class weblinks_broken extends happy_linux_object
    {

        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------
        public function __construct()
        {
            parent::__construct();

            $this->initVar('bid', XOBJ_DTYPE_INT, 0, false);
            $this->initVar('lid', XOBJ_DTYPE_INT, 0, false);
            $this->initVar('sender', XOBJ_DTYPE_INT, 0, false);
            $this->initVar('ip', XOBJ_DTYPE_TXTBOX, null, false, 20);
        }

        //---------------------------------------------------------
        // function
        //---------------------------------------------------------
        public function get_uname($usereal = 0)
        {
            $uid          = $this->get('sender');
            $user_handler = xoops_getHandler('user');
            $user_obj     = $user_handler->get($uid);
            $uname        = '';

            if (is_object($user_obj)) {
                $uname = $user_obj->getUnameFromId($uid, $usereal);
            }

            return $uname;
        }

        public function get_email($format = 's')
        {
            $uid          = $this->get('sender');
            $user_handler = xoops_getHandler('user');
            $user_obj     = $user_handler->get($uid);
            $email        = '';

            if (is_object($user_obj)) {
                $email = $user_obj->getVar('email', $format);
            }

            return $email;
        }

        // --- class end ---
    }

    //=========================================================
    // class weblinks_broken_handler
    //=========================================================
    class weblinks_broken_handler extends happy_linux_object_handler
    {

        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------
        public function __construct($dirname)
        {
            parent::__construct($dirname, 'broken', 'bid', 'weblinks_broken');

            $this->set_debug_db_sql(WEBLINKS_DEBUG_BROKEN_SQL);
            $this->set_debug_db_error(WEBLINKS_DEBUG_ERROR);

            // hack for multi site
            if (WEBLINKS_FLAG_MULTI_SITE) {
                $this->renew_prefix(WEBLINKS_DB_PREFIX);
            }
        }


        //---------------------------------------------------------
        // basic function
        //---------------------------------------------------------
        public function _build_insert_sql(&$obj)
        {
            foreach ($obj->gets() as $k => $v) {
                ${$k} = $v;
            }

            $sql = 'INSERT INTO ' . $this->_table . ' (';
            $sql .= 'lid, ';
            $sql .= 'sender, ';
            $sql .= 'ip ';
            $sql .= ') VALUES ( ';
            $sql .= (int)$lid . ', ';
            $sql .= (int)$sender . ', ';
            $sql .= $this->quote($ip) . ' ';
            $sql .= ')';

            return $sql;
        }

        public function _build_update_sql(&$obj)
        {
            foreach ($obj->gets() as $k => $v) {
                ${$k} = $v;
            }

            $sql = 'UPDATE ' . $this->_table . ' SET ';
            $sql .= 'lid=' . (int)$lid . ', ';
            $sql .= 'sender=' . (int)$sender . ', ';
            $sql .= 'ip=' . $this->quote($ip) . ' ';
            $sql .= 'WHERE bid=' . (int)$bid;

            return $sql;
        }

        //---------------------------------------------------------
        // delete
        //---------------------------------------------------------
        public function delete_by_lid($lid, $force = false)
        {
            $lid = (int)$lid;
            $sql = 'DELETE FROM ' . $this->_table . ' WHERE lid=' . (int)$lid;

            if (!$this->query($sql, 0, 0, $force)) {
                return false;
            }

            return true;
        }

        //---------------------------------------------------------
        // get count
        //---------------------------------------------------------
        public function get_count_by_lid($lid)
        {
            $lid      = (int)$lid;
            $criteria = new CriteriaCompo();
            $criteria->add(new criteria('lid', $lid, '='));
            $ret = $this->getCount($criteria);
            return $ret;
        }

        public function get_count_by_lid_uid($lid, $uid)
        {
            $lid      = (int)$lid;
            $uid      = (int)$uid;
            $criteria = new CriteriaCompo();
            $criteria->add(new criteria('lid', $lid, '='));
            $criteria->add(new criteria('sender', $uid, '='));
            $ret = $this->getCount($criteria);
            return $ret;
        }

        public function get_count_by_lid_ip($lid, $ip)
        {
            $lid      = (int)$lid;
            $criteria = new CriteriaCompo();
            $criteria->add(new criteria('lid', $lid, '='));
            $criteria->add(new criteria('ip', $ip, '='));
            $ret = $this->getCount($criteria);
            return $ret;
        }

        //---------------------------------------------------------
        // get objects
        //---------------------------------------------------------
        public function &get_objects_group_by_lid()
        {
            $ret   = array();
            $limit = $start = 0;

            $sql = 'SELECT * FROM ' . $this->_table . ' ';
            $sql .= 'GROUP BY lid ORDER BY bid DESC';

            $result =& $this->query($sql);
            if (!$result) {
                return false;
            }

            while ($row = $this->fetchArray($result)) {
                $obj =& $this->create();
                $obj->setVars($row);
                $ret[] =& $obj;
                unset($obj);
            }

            return $ret;
        }

        // --- class end ---
    }

    // === class end ===
}
