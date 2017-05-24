<?php
// $Id: weblinks_votedata_handler.php,v 1.6 2007/11/26 11:33:58 ohwada Exp $

// 2007-11-24 K.OHWADA
// move create_table() to weblinks_install.php

// 2007-02-20 K.OHWADA
// hack for multi site

// 2006-09-30 K.OHWADA
// use happy_linux
// add get_count_user()

// 2006-05-15 K.OHWADA
// new handler
// not use weblinks_module_base

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//=========================================================
// WebLinks Module
// this file contain 2 class
//   weblinks_votedata
//   weblinks_votedata_handler
// 2004/01/14 K.OHWADA
//=========================================================

// === class begin ===
if (!class_exists('weblinks_votedata_handler')) {

    //=========================================================
    // class weblinks_votedata
    //=========================================================
    class weblinks_votedata extends happy_linux_object
    {

        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------
        public function __construct()
        {
            parent::__construct();

            $this->initVar('ratingid', XOBJ_DTYPE_INT, 0, false);
            $this->initVar('lid', XOBJ_DTYPE_INT, 0, false);
            $this->initVar('ratinguser', XOBJ_DTYPE_INT, 0, false);
            $this->initVar('rating', XOBJ_DTYPE_INT, 0, false);
            $this->initVar('ratinghostname', XOBJ_DTYPE_TXTBOX, null, false, 255);
            $this->initVar('ratingtimestamp', XOBJ_DTYPE_INT, 0);
        }

        //---------------------------------------------------------
        // function
        //---------------------------------------------------------
        // name for "anonymous" if not found
        public function get_uname($usereal = 0)
        {
            $uid   = $this->get('ratinguser');
            $uname = XoopsUser::getUnameFromId($uid, $usereal);
            return $uname;
        }

        public function get_formatted_timestamp()
        {
            $timestamp = $this->get('ratingtimestamp');
            $formatted = formatTimestamp($timestamp);
            return $formatted;
        }

        // --- class end ---
    }

    //=========================================================
    // class weblinks_votedata_handler
    //=========================================================
    class weblinks_votedata_handler extends happy_linux_object_handler
    {

        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------
        public function __construct($dirname)
        {
            parent::__construct($dirname, 'votedata', 'ratingid', 'weblinks_votedata');

            $this->set_debug_db_sql(WEBLINKS_DEBUG_VOTEDATA_SQL);
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
            $sql .= 'ratinguser, ';
            $sql .= 'rating, ';
            $sql .= 'ratinghostname, ';
            $sql .= 'ratingtimestamp ';
            $sql .= ') VALUES ( ';
            $sql .= (int)$lid . ', ';
            $sql .= (int)$ratinguser . ', ';
            $sql .= (int)$rating . ', ';
            $sql .= $this->quote($ratinghostname) . ', ';
            $sql .= (int)$ratingtimestamp . ' ';
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
            $sql .= 'ratinguser=' . (int)$ratinguser . ', ';
            $sql .= 'rating=' . (int)$rating . ', ';
            $sql .= 'ratinghostname=' . $this->quote($ratinghostname) . ', ';
            $sql .= 'ratingtimestamp=' . (int)$ratingtimestamp . ' ';
            $sql .= 'WHERE ratingid=' . (int)$ratingid;

            return $sql;
        }

        //---------------------------------------------------------
        // delete
        //---------------------------------------------------------
        public function delete_by_lid($lid)
        {
            $sql = 'DELETE FROM ' . $this->_table . ' WHERE lid=' . (int)$lid;

            if (!$this->query($sql)) {
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
            $count = $this->getCount($criteria);
            return $count;
        }

        public function get_count_by_lid_ip_time($lid, $ip, $time)
        {
            $lid      = (int)$lid;
            $time     = (int)$time;
            $criteria = new CriteriaCompo();
            $criteria->add(new criteria('lid', $lid, '='));
            $criteria->add(new criteria('ratinghostname', $ip, '='));
            $criteria->add(new criteria('ratingtimestamp', $time, '>'));
            $criteria->add(new criteria('ratinguser', 0, '='));
            $count = $this->getCount($criteria);
            return $count;
        }

        public function &get_count_user()
        {
            $criteria = new CriteriaCompo();
            $criteria->add(new criteria('ratinguser', 0, '>'));
            $count = $this->getCount($criteria);
            return $count;
        }

        public function &get_count_user_by_lid($lid)
        {
            $lid      = (int)$lid;
            $criteria = new CriteriaCompo();
            $criteria->add(new criteria('lid', $lid, '='));
            $criteria->add(new criteria('ratinguser', 0, '>'));
            $count = $this->getCount($criteria);
            return $count;
        }

        public function &get_count_by_uid($uid)
        {
            $uid      = (int)$uid;
            $criteria = new CriteriaCompo();
            $criteria->add(new criteria('ratinguser', $uid, '='));
            $count = $this->getCount($criteria);
            return $count;
        }

        public function &get_count_by_lid_uid($lid, $uid)
        {
            $lid      = (int)$lid;
            $uid      = (int)$uid;
            $criteria = new CriteriaCompo();
            $criteria->add(new criteria('lid', $lid, '='));
            $criteria->add(new criteria('ratinguser', $uid, '='));
            $count = $this->getCount($criteria);
            return $count;
        }

        //---------------------------------------------------------
        // get objects
        //---------------------------------------------------------
        public function &get_objects_by_lid($lid, $limit = 0, $start = 0)
        {
            $lid      = (int)$lid;
            $criteria = new CriteriaCompo();
            $criteria->add(new criteria('lid', $lid, '='));
            $criteria->setStart($start);
            $criteria->setLimit($limit);
            $objs = $this->getObjects($criteria);
            return $objs;
        }

        public function &get_objects_user_by_lid($lid, $limit = 0, $start = 0)
        {
            $lid      = (int)$lid;
            $criteria = new CriteriaCompo();
            $criteria->add(new criteria('lid', $lid, '='));
            $criteria->add(new criteria('ratinguser', 0, '>'));
            $criteria->setSort('ratingtimestamp', 'DESC');
            $criteria->setStart($start);
            $criteria->setLimit($limit);
            $objs = $this->getObjects($criteria);
            return $objs;
        }

        public function &get_objects_by_uid($uid, $limit = 0, $start = 0)
        {
            $uid      = (int)$uid;
            $criteria = new CriteriaCompo();
            $criteria->add(new criteria('ratinguser', $uid, '='));
            $criteria->setStart($start);
            $criteria->setLimit($limit);
            $objs = $this->getObjects($criteria);
            return $objs;
        }

        public function &get_objects_by_lid_uid($lid, $uid, $limit = 0, $start = 0)
        {
            $lid      = (int)$lid;
            $uid      = (int)$uid;
            $criteria = new CriteriaCompo();
            $criteria->add(new criteria('lid', $lid, '='));
            $criteria->add(new criteria('ratinguser', $uid, '='));
            $criteria->setSort('ratingtimestamp', 'DESC');
            $criteria->setStart($start);
            $criteria->setLimit($limit);
            $objs = $this->getObjects($criteria);
            return $objs;
        }

        public function &get_objects_orderby_lid($limit = 0, $start = 0)
        {
            $criteria = new CriteriaCompo();
            $criteria->setSort('lid ASC, ratingid ASC');
            $criteria->setStart($start);
            $criteria->setLimit($limit);
            $objs = $this->getObjects($criteria);
            return $objs;
        }

        public function &get_objects_orderby_uid($limit = 0, $start = 0)
        {
            $criteria = new CriteriaCompo();
            $criteria->add(new criteria('ratinguser', 0, '!='));
            $criteria->setSort('ratinguser ASC, ratingid ASC');
            $criteria->setStart($start);
            $criteria->setLimit($limit);
            $objs = $this->getObjects($criteria);
            return $objs;
        }

        public function &get_objects_anoymous($limit = 0, $start = 0)
        {
            $criteria = new CriteriaCompo();
            $criteria->add(new criteria('ratinguser', 0, '='));
            $criteria->setStart($start);
            $criteria->setLimit($limit);
            $objs = $this->getObjects($criteria);
            return $objs;
        }

        //---------------------------------------------------------
        // check
        //---------------------------------------------------------
        public function check_by_lid_uid($lid, $uid)
        {
            $lid = (int)$lid;
            $uid = (int)$uid;

            $objs =& $this->get_objects_by_lid($lid);

            if (count($objs) == 0) {
                return false;
            }

            foreach ($objs as $obj) {
                if (is_object($obj)) {
                    $user = $obj->getVar('ratinguser');

                    if ($user == $uid) {
                        return true;
                    }
                }
            }

            return false;
        }

        //---------------------------------------------------------
        // calculation
        //---------------------------------------------------------
        public function calc_rating(&$objs)
        {
            $total = 0;

            $count = count($objs);
            if ($count == 0) {
                return array(0, 0);
            }

            foreach ($objs as $obj) {
                if (is_object($obj)) {
                    $total += $obj->get('rating');
                }
            }

            return array($count, $total);
        }

        public function calc_rating_by_lid($lid, $decimals = 4)
        {
            $lid      = (int)$lid;
            $decimals = (int)$decimals;

            $objs =& $this->get_objects_by_lid($lid);

            list($count, $total) = $this->calc_rating($objs);
            if ($count == 0) {
                return array(0, 0);
            }

            $rating = $total / $count;
            $rating = number_format($rating, $decimals);

            return array($count, $rating);
        }

        public function calc_rating_by_uid($uid, $decimals = 1)
        {
            $uid      = (int)$uid;
            $decimals = (int)$decimals;

            $objs =& $this->get_objects_by_uid($uid);

            list($count, $total) = $this->calc_rating($objs);
            if ($count == 0) {
                return array(0, 0);
            }

            $rating = $total / $count;
            $rating = number_format($rating, $decimals);

            return array($count, $rating);
        }

        // --- class end ---
    }

    // === class end ===
}
