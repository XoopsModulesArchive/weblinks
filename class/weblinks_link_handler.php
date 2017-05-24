<?php
// $Id: weblinks_link_handler.php,v 1.3 2012/04/09 10:20:05 ohwada Exp $

// 2012-04-02 K.OHWADA
// gm_icon
// get_lid_array_by_title()

// 2010-03-31 K.OHWADA
// get_objects_broken()

// 2008-02-17 K.OHWADA
// pagerank, pagerank_update in link, modify

// 2007-11-01 K.OHWADA
// divid to weblinks_link_def_handler
// move get_count_non_url() to weblinks_link_basic_handler
// remove happy_linux_search

// 2007-09-01 K.OHWADA
// get_objects_usercomment_desc()

// 2007-08-01 K.OHWADA
// admin can add etc column

// 2007-05-06 K.OHWADA
// BUG 4565: cannot show user manage, when too many links or users
// BUG: dont work limit

// 2007-04-08 K.OHWADA
// gm_type

// 2007-03-25 K.OHWADA
// album_id

// 2007-03-01 K.OHWADA
// divid to weblinks_link_basic_handler
// hack for multi site
// add forum_id comment_use field
// add clean_rss_xml()

// 2006-12-17 K.OHWADA
// add time_publish textarea1
// add add_column_table_130()
// add build_sql_where_exclude()

// 2006-12-17 K.OHWADA
// BUG 4417: language singleton done not work correctly

// 2006-10-14 K.OHWADA
// add get_objects_by_where()

// 2006-10-05 K.OHWADA
// use happy_linux
// use rssc
// divided weblinks_link to weblinks_link_handler
// add get_objects_latest() isset_rss_flag()
// reomove rss_update()
// google map

// 2006-07-15 K.OHWADA
// BUG 4130: cannot show recommend mark

// 2006-06-10 K.OHWADA
// BUG 4030: cannot change recommend, mutual
//   add set_checkbox()

// 2006-05-15 K.OHWADA
// new handler
// not use weblinks_module_base
// NOT use other handler

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//=========================================================
// WebLinks Module
// 2004/01/14 K.OHWADA
//=========================================================

// === class begin ===
if (!class_exists('weblinks_link_handler')) {

    //=========================================================
    // class weblinks_link_handler
    // NOT use other handler
    //=========================================================
    class weblinks_link_handler extends happy_linux_object_handler
    {
        public $_link_basic_handler;

        public $_lid_array_with_email;

        // config
        public $_conf_use_ratelink = 0;   // not use
        public $_conf_broken       = WEBLINKS_LINK_BROKEN_DEFAULT;
        public $_conf_link_num_etc = WEBLINKS_LINK_NUM_ETC;

        //---------------------------------------------------------
        // constructor
        //---------------------------------------------------------
        public function __construct($dirname)
        {
            parent::__construct($dirname, 'link', 'lid', 'weblinks_link');

            $this->set_debug_db_sql(WEBLINKS_DEBUG_LINK_SQL);
            $this->set_debug_db_error(WEBLINKS_DEBUG_ERROR);
            $this->set_debug_print_time(WEBLINKS_DEBUG_TIME);
            $this->set_debug_db_max_sql(WEBLINKS_DEBUG_MAX_SQL);

            // hack for multi site
            if (WEBLINKS_FLAG_MULTI_SITE) {
                $this->renew_prefix(WEBLINKS_DB_PREFIX);
            }

            $config_handler            = weblinks_get_handler('config2_basic', $dirname);
            $this->_link_basic_handler = weblinks_get_handler('link_basic', $dirname);

            $conf = $config_handler->get_conf();
            if (is_array($conf) && (count($conf) > 0)) {
                $this->_conf_use_ratelink = $conf['use_ratelink'];
                $this->_conf_broken       = $conf['broken_threshold'];
                if (WEBLINKS_USE_LINK_NUM_ETC) {
                    $this->_conf_link_num_etc = $conf['link_num_etc'];
                }
            }
        }

        //---------------------------------------------------------
        // insert
        // $flag_lid : for import from mylinks
        //---------------------------------------------------------
        public function _build_insert_sql(&$obj, $flag_lid = false)
        {
            foreach ($obj->gets() as $k => $v) {
                ${$k} = $v;
            }

            $sql_lid_name  = '';
            $sql_lid_value = '';
            $sql_etc_name  = '';
            $sql_etc_value = '';

            if ($flag_lid) {
                $sql_lid_name  = 'lid, ';
                $sql_lid_value = (int)$lid . ', ';
            }

            // etc1 .. etci
            if ($this->_conf_link_num_etc > 0) {
                for ($i = 1; $i <= $this->_conf_link_num_etc; ++$i) {
                    $etc_name = 'etc' . $i;
                    $etc_val  = $obj->get($etc_name);
                    $sql_etc_name .= $etc_name . ', ';
                    $sql_etc_value .= $this->quote($etc_val) . ', ';
                }
            }

            $sql = 'INSERT INTO ' . $this->_table . ' (';

            $sql .= $sql_lid_name;

            $sql .= 'uid, ';
            $sql .= 'cids, ';
            $sql .= 'title, ';
            $sql .= 'url, ';
            $sql .= 'banner, ';
            $sql .= 'description, ';
            $sql .= 'name, ';
            $sql .= 'nameflag, ';
            $sql .= 'mail, ';
            $sql .= 'mailflag, ';
            $sql .= 'company, ';
            $sql .= 'addr, ';
            $sql .= 'tel, ';
            $sql .= 'search, ';
            $sql .= 'passwd, ';
            $sql .= 'admincomment, ';
            $sql .= 'mark, ';
            $sql .= 'time_create, ';
            $sql .= 'time_update, ';
            $sql .= 'hits, ';
            $sql .= 'rating, ';
            $sql .= 'votes, ';
            $sql .= 'comments, ';
            $sql .= 'width, ';
            $sql .= 'height, ';
            $sql .= 'recommend, ';
            $sql .= 'mutual, ';
            $sql .= 'broken, ';
            $sql .= 'rss_url, ';
            $sql .= 'rss_flag, ';
            $sql .= 'rss_xml, ';
            $sql .= 'rss_update, ';
            $sql .= 'usercomment, ';
            $sql .= 'zip, ';
            $sql .= 'state, ';
            $sql .= 'city, ';
            $sql .= 'addr2, ';
            $sql .= 'fax, ';

            // html
            $sql .= 'dohtml, ';
            $sql .= 'dosmiley, ';
            $sql .= 'doxcode, ';
            $sql .= 'doimage, ';
            $sql .= 'dobr, ';
            $sql .= 'map_use, ';

            // rssc
            $sql .= 'rssc_lid, ';

            // google map
            $sql .= 'gm_latitude, ';
            $sql .= 'gm_longitude, ';
            $sql .= 'gm_zoom, ';
            $sql .= 'gm_type, ';
            $sql .= 'gm_icon, ';

            // publish
            $sql .= 'time_publish, ';
            $sql .= 'time_expire, ';
            $sql .= 'textarea1, ';
            $sql .= 'textarea2, ';
            $sql .= 'dohtml1, ';
            $sql .= 'dosmiley1, ';
            $sql .= 'doxcode1, ';
            $sql .= 'doimage1, ';
            $sql .= 'dobr1, ';

            // forum
            $sql .= 'forum_id, ';
            $sql .= 'comment_use, ';

            //etc
            $sql .= $sql_etc_name;

            $sql .= 'album_id, ';

            // pagerank
            $sql .= 'pagerank, ';
            $sql .= 'pagerank_update, ';

            // aux
            $sql .= 'aux_int_1, ';
            $sql .= 'aux_int_2, ';
            $sql .= 'aux_text_1, ';
            $sql .= 'aux_text_2 ';

            $sql .= ') VALUES (';

            $sql .= $sql_lid_value;

            $sql .= (int)$uid . ', ';
            $sql .= $this->quote($cids) . ', ';
            $sql .= $this->quote($title) . ', ';
            $sql .= $this->quote($url) . ', ';
            $sql .= $this->quote($banner) . ', ';
            $sql .= $this->quote($description) . ', ';
            $sql .= $this->quote($name) . ', ';
            $sql .= (int)$nameflag . ', ';
            $sql .= $this->quote($mail) . ', ';
            $sql .= (int)$mailflag . ', ';
            $sql .= $this->quote($company) . ', ';
            $sql .= $this->quote($addr) . ', ';
            $sql .= $this->quote($tel) . ', ';
            $sql .= $this->quote($search) . ', ';
            $sql .= $this->quote($passwd) . ', ';
            $sql .= $this->quote($admincomment) . ', ';
            $sql .= $this->quote($mark) . ', ';
            $sql .= (int)$time_create . ', ';
            $sql .= (int)$time_update . ', ';
            $sql .= (int)$hits . ', ';
            $sql .= (float)$rating . ', ';
            $sql .= (int)$votes . ', ';
            $sql .= (int)$comments . ', ';
            $sql .= (int)$width . ', ';
            $sql .= (int)$height . ', ';
            $sql .= (int)$recommend . ', ';
            $sql .= (int)$mutual . ', ';
            $sql .= (int)$broken . ', ';
            $sql .= $this->quote($rss_url) . ', ';
            $sql .= (int)$rss_flag . ', ';
            $sql .= (int)$rss_xml . ', ';
            $sql .= (int)$rss_update . ', ';
            $sql .= $this->quote($usercomment) . ', ';
            $sql .= $this->quote($zip) . ', ';
            $sql .= $this->quote($state) . ', ';
            $sql .= $this->quote($city) . ',';
            $sql .= $this->quote($addr2) . ', ';
            $sql .= $this->quote($fax) . ', ';

            // html
            $sql .= (int)$dohtml . ', ';
            $sql .= (int)$dosmiley . ', ';
            $sql .= (int)$doxcode . ', ';
            $sql .= (int)$doimage . ', ';
            $sql .= (int)$dobr . ', ';
            $sql .= (int)$map_use . ', ';

            // rssc
            $sql .= (int)$rssc_lid . ', ';

            // google map
            $sql .= (float)$gm_latitude . ', ';
            $sql .= (float)$gm_longitude . ', ';
            $sql .= (int)$gm_zoom . ', ';
            $sql .= (int)$gm_type . ', ';
            $sql .= (int)$gm_icon . ', ';

            // publish
            $sql .= (int)$time_publish . ', ';
            $sql .= (int)$time_expire . ', ';
            $sql .= $this->quote($textarea1) . ', ';
            $sql .= $this->quote($textarea2) . ', ';
            $sql .= (int)$dohtml1 . ', ';
            $sql .= (int)$dosmiley1 . ', ';
            $sql .= (int)$doxcode1 . ', ';
            $sql .= (int)$doimage1 . ', ';
            $sql .= (int)$dobr1 . ', ';

            // forum
            $sql .= (int)$forum_id . ', ';
            $sql .= (int)$comment_use . ', ';

            // etc
            $sql .= $sql_etc_value;

            $sql .= (int)$album_id . ', ';

            // pagerank
            $sql .= (int)$pagerank . ', ';
            $sql .= (int)$pagerank_update . ', ';

            // aux
            $sql .= (int)$aux_int_1 . ', ';
            $sql .= (int)$aux_int_2 . ', ';
            $sql .= $this->quote($aux_text_1) . ', ';
            $sql .= $this->quote($aux_text_2) . ' ';

            $sql .= ')';

            return $sql;
        }

        //---------------------------------------------------------
        // update
        //---------------------------------------------------------
        public function _build_update_sql(&$obj)
        {
            foreach ($obj->gets() as $k => $v) {
                ${$k} = $v;
            }

            $sql_etc_set = '';

            // etc1 .. etci
            if ($this->_conf_link_num_etc > 0) {
                for ($i = 1; $i <= $this->_conf_link_num_etc; ++$i) {
                    $etc_name = 'etc' . $i;
                    $etc_val  = $obj->get($etc_name);
                    $sql_etc_set .= $etc_name . '=' . $this->quote($etc_val) . ', ';
                }
            }

            $sql = 'UPDATE ' . $this->_table . ' SET ';

            $sql .= 'uid=' . (int)$uid . ', ';
            $sql .= 'cids=' . $this->quote($cids) . ', ';
            $sql .= 'title=' . $this->quote($title) . ', ';
            $sql .= 'url=' . $this->quote($url) . ', ';
            $sql .= 'banner=' . $this->quote($banner) . ', ';
            $sql .= 'description=' . $this->quote($description) . ', ';
            $sql .= 'name=' . $this->quote($name) . ', ';
            $sql .= 'nameflag=' . (int)$nameflag . ', ';
            $sql .= 'mail=' . $this->quote($mail) . ', ';
            $sql .= 'mailflag=' . (int)$mailflag . ', ';
            $sql .= 'company=' . $this->quote($company) . ', ';
            $sql .= 'addr=' . $this->quote($addr) . ', ';
            $sql .= 'tel=' . $this->quote($tel) . ', ';
            $sql .= 'search=' . $this->quote($search) . ', ';
            $sql .= 'passwd=' . $this->quote($passwd) . ', ';
            $sql .= 'admincomment=' . $this->quote($admincomment) . ', ';
            $sql .= 'mark=' . $this->quote($mark) . ', ';
            $sql .= 'time_create=' . (int)$time_create . ', ';
            $sql .= 'time_update=' . (int)$time_update . ', ';
            $sql .= 'hits=' . (int)$hits . ', ';
            $sql .= 'rating=' . (float)$rating . ', ';
            $sql .= 'votes=' . (int)$votes . ', ';
            $sql .= 'comments=' . (int)$comments . ', ';
            $sql .= 'width=' . (int)$width . ', ';
            $sql .= 'height=' . (int)$height . ', ';
            $sql .= 'recommend=' . (int)$recommend . ', ';
            $sql .= 'mutual=' . (int)$mutual . ', ';
            $sql .= 'broken=' . (int)$broken . ', ';
            $sql .= 'rss_url=' . $this->quote($rss_url) . ', ';
            $sql .= 'rss_flag=' . (int)$rss_flag . ', ';
            $sql .= 'rss_update=' . (int)$rss_update . ', ';
            $sql .= 'rss_xml=' . $this->quote($rss_xml) . ', ';
            $sql .= 'usercomment=' . $this->quote($usercomment) . ', ';
            $sql .= 'zip=' . $this->quote($zip) . ', ';
            $sql .= 'state=' . $this->quote($state) . ', ';
            $sql .= 'city=' . $this->quote($city) . ', ';
            $sql .= 'addr2=' . $this->quote($addr2) . ', ';
            $sql .= 'fax=' . $this->quote($fax) . ', ';

            // html
            $sql .= 'dohtml=' . (int)$dohtml . ', ';
            $sql .= 'dosmiley=' . (int)$dosmiley . ', ';
            $sql .= 'doxcode=' . (int)$doxcode . ', ';
            $sql .= 'doimage=' . (int)$doimage . ', ';
            $sql .= 'dobr=' . (int)$dobr . ', ';
            $sql .= 'map_use=' . (int)$map_use . ', ';

            // rssc
            $sql .= 'rssc_lid=' . (int)$rssc_lid . ', ';

            // google map
            $sql .= 'gm_latitude=' . (float)$gm_latitude . ', ';
            $sql .= 'gm_longitude=' . (float)$gm_longitude . ', ';
            $sql .= 'gm_zoom=' . (int)$gm_zoom . ', ';
            $sql .= 'gm_type=' . (int)$gm_type . ', ';
            $sql .= 'gm_icon=' . (int)$gm_icon . ', ';

            // publish
            $sql .= 'time_publish=' . (int)$time_publish . ', ';
            $sql .= 'time_expire=' . (int)$time_expire . ', ';
            $sql .= 'textarea1=' . $this->quote($textarea1) . ', ';
            $sql .= 'textarea2=' . $this->quote($textarea2) . ', ';
            $sql .= 'dohtml1=' . (int)$dohtml1 . ', ';
            $sql .= 'dosmiley1=' . (int)$dosmiley1 . ', ';
            $sql .= 'doxcode1=' . (int)$doxcode1 . ', ';
            $sql .= 'doimage1=' . (int)$doimage1 . ', ';
            $sql .= 'dobr1=' . (int)$dobr1 . ', ';

            // forum
            $sql .= 'forum_id=' . (int)$forum_id . ', ';
            $sql .= 'comment_use=' . (int)$comment_use . ', ';

            // etc
            $sql .= $sql_etc_set;

            $sql .= 'album_id=' . (int)$album_id . ', ';

            // pagerank
            $sql .= 'pagerank=' . (int)$pagerank . ', ';
            $sql .= 'pagerank_update=' . (int)$pagerank_update . ', ';

            // aux
            $sql .= 'aux_int_1=' . (int)$aux_int_1 . ', ';
            $sql .= 'aux_int_2=' . (int)$aux_int_2 . ', ';
            $sql .= 'aux_text_1=' . $this->quote($aux_text_1) . ', ';
            $sql .= 'aux_text_2=' . $this->quote($aux_text_2) . ' ';

            $sql .= ' WHERE lid=' . (int)$lid;

            return $sql;
        }

        //---------------------------------------------------------
        // update
        //---------------------------------------------------------
        // for link_check.php
        public function countup_broken($lid)
        {
            $sql = 'UPDATE ' . $this->_table . ' SET broken = broken+1 WHERE lid=' . (int)$lid;
            $ret = $this->queryF($sql);
            return $ret;
        }

        // for admin/link_check.php
        public function clean_rss_xml()
        {
            $sql = 'UPDATE ' . $this->_table . " SET rss_xml = '' ";
            $ret = $this->query($sql);
            return $ret;
        }

        // for ratelink.php, admin/votedate.php
        public function update_rating($lid, $rating, $votes)
        {
            if (!$this->_conf_use_ratelink) {
                return true;    // no action
            }

            $lid = (int)$lid;

            $obj =& $this->get($lid);
            if (!is_object($obj)) {
                return true;    // no action
            }

            $obj->setVar('rating', $rating);
            $obj->setVar('votes', $votes);
            $ret = $this->update($obj);
            return $ret;
        }

        public function update_rssc_lid($lid, $rssc_lid)
        {
            $obj =& $this->get($lid);
            if (!is_object($obj)) {
                return true;    // no action
            }

            $obj->setVar('rssc_lid', $rssc_lid);
            $ret = $this->update($obj);
            return $ret;
        }

        //---------------------------------------------------------
        // delete
        //---------------------------------------------------------
        public function delete_by_lid($lid)
        {
            $obj = $this->get($lid);
            if (is_object($obj)) {
                $ret = $this->delete($obj);
                return $ret;
            }

            return true;    // no action
        }

        //---------------------------------------------------------
        // get count for admin link list
        //---------------------------------------------------------
        public function get_count_time_publish_before()
        {
            $time  = time();
            $where = '( time_publish <> 0 AND time_publish > ' . $time . ' ) ';
            $count = $this->get_count_by_where($where);
            return $count;
        }

        public function get_count_time_expire_after()
        {
            $time  = time();
            $where = '( time_expire <> 0 AND time_expire < ' . $time . ' ) ';
            $count = $this->get_count_by_where($where);
            return $count;
        }

        public function get_count_usercomment()
        {
            $where = "(usercomment <> '')";
            $count = $this->get_count_by_where($where);
            return $count;
        }

        //---------------------------------------------------------
        // get count for other
        //---------------------------------------------------------
        // for admin user manage
        public function get_count_by_uid($uid)
        {
            $uid      = (int)$uid;
            $criteria = new CriteriaCompo();
            $criteria->add(new criteria('uid', $uid, '='));
            $count = $this->getCount($criteria);
            return $count;
        }

        // for admin user manage
        public function get_count_with_email()
        {
            $sql = 'SELECT COUNT(DISTINCT mail) FROM ' . $this->_table . ' ';
            $sql .= "WHERE mail <> '' ";
            $count = $this->get_count_by_sql($sql);
            return $count;
        }

        // --- previous version 1.10 ---
        // for admin export to rssc
        public function get_count_rss_flag_prev_ver()
        {
            $sql = 'SELECT COUNT(*) FROM ' . $this->_table . ' ';
            $sql .= "WHERE ( rss_url != '' AND rss_flag != 0 AND broken < " . $this->_conf_broken . ' ) ';
            $count = $this->get_count_by_sql($sql);
            return $count;
        }

        //---------------------------------------------------------
        // get object for admin link list
        //---------------------------------------------------------
        public function &get_objects_all($limit = 0, $start = 0)
        {
            $criteria = new CriteriaCompo();
            $criteria->setStart($start);
            $criteria->setLimit($limit);
            $objs = $this->getObjects($criteria);
            return $objs;
        }

        public function &get_objects_desc($limit = 0, $start = 0)
        {
            $criteria = new CriteriaCompo();
            $criteria->setSort('lid DESC');
            $criteria->setStart($start);
            $criteria->setLimit($limit);
            $objs = $this->getObjects($criteria);
            return $objs;
        }

        public function &get_objects_non_url($limit = 0, $start = 0)
        {
            // XOOPS 2.2.3 dont accept value = ''
            // BUG: dont work limit
            $where = "url = ''";
            $objs  =& $this->get_objects_orderby_lid_by_where($where, $limit, $start);
            return $objs;
        }

        public function &get_objects_broken($limit = 0, $start = 0)
        {
            // broken DESC
            $criteria = new CriteriaCompo();
            $criteria->add(new criteria('broken', '0', '>'));
            $criteria->setSort('broken DESC');
            $criteria->setStart($start);
            $criteria->setLimit($limit);
            $objs = $this->getObjects($criteria);
            return $objs;
        }

        public function &get_objects_broken_lid($limit = 0, $start = 0)
        {
            // BUG: dont work limit
            $where = 'broken > 0';
            $objs  =& $this->get_objects_orderby_lid_by_where($where, $limit, $start);
            return $objs;
        }

        public function &get_objects_rss_flag($limit = 0, $start = 0)
        {
            $criteria = new CriteriaCompo();
            $criteria->add(new criteria('rssc_lid', 0, '<>'));
            $criteria->setStart($start);
            $criteria->setLimit($limit);
            $objs = $this->getObjects($criteria);
            return $objs;
        }

        public function &get_objects_rssc_lid($lid, $rssc_lid, $limit = 0, $start = 0)
        {
            if ($rssc_lid == 0) {
                $false = false;
                return $false;
            }

            $criteria = new CriteriaCompo();
            $criteria->add(new criteria('lid', $lid, '<>'));
            $criteria->add(new criteria('rssc_lid', $rssc_lid, '='));
            $criteria->setStart($start);
            $criteria->setLimit($limit);
            $objs = $this->getObjects($criteria);
            return $objs;
        }

        public function &get_objects_time_publish_before($limit = 0, $start = 0)
        {
            // BUG: dont work limit
            $time  = time();
            $where = '( time_publish <> 0 AND time_publish > ' . $time . ' ) ';
            $objs  =& $this->get_objects_orderby_lid_by_where($where, $limit, $start);
            return $objs;
        }

        public function &get_objects_time_expire_after($limit = 0, $start = 0)
        {
            // BUG: dont work limit
            $time  = time();
            $where = '( time_expire <> 0 AND time_expire < ' . $time . ' ) ';
            $objs  =& $this->get_objects_orderby_lid_by_where($where, $limit, $start);
            return $objs;
        }

        public function &get_objects_usercomment_desc($limit = 0, $start = 0)
        {
            $criteria = new CriteriaCompo();
            $criteria->add(new criteria('usercomment', '', '<>'));
            $criteria->setSort('lid DESC');
            $criteria->setStart($start);
            $criteria->setLimit($limit);
            $objs = $this->getObjects($criteria);
            return $objs;
        }

        public function &get_objects_orderby_lid_by_where($where, $limit = 0, $start = 0)
        {
            $sql  = 'SELECT * FROM ' . $this->_table . ' WHERE ' . $where . ' ORDER BY lid';
            $objs =& $this->get_objects_by_sql($sql, $limit, $start);
            return $objs;
        }

        //---------------------------------------------------------
        // get objects for other
        //---------------------------------------------------------
        // for admin user manage
        public function &get_objects_by_uid($uid, $limit = 0, $start = 0)
        {
            $uid      = (int)$uid;
            $criteria = new CriteriaCompo();
            $criteria->add(new criteria('uid', $uid, '='));
            $criteria->setStart($start);
            $criteria->setLimit($limit);
            $objs = $this->getObjects($criteria);
            return $objs;
        }

        // for admin user manage
        public function &get_objects_with_email($limit = 0, $start = 0)
        {
            $sql = 'SELECT * FROM ' . $this->_table . ' ';
            $sql .= "WHERE mail <> '' ";
            $sql .= 'GROUP BY mail ';
            $sql .= 'ORDER BY lid';
            $objs =& $this->get_objects_by_sql($sql, $limit, $start);
            return $objs;
        }

        // --- previous version 1.10 ---
        // for admin export to rssc
        public function &get_objects_rss_flag_prev_ver($limit = 0, $start = 0)
        {
            $sql = 'SELECT * FROM ' . $this->_table . ' ';
            $sql .= "WHERE ( rss_url != '' AND rss_flag != 0 AND broken < " . $this->_conf_broken . ' ) ';
            $sql .= 'ORDER BY lid';
            $objs =& $this->get_objects_by_sql($sql, $limit, $start);
            return $objs;
        }

        //---------------------------------------------------------
        // get objects for bulk manage
        //---------------------------------------------------------
        public function &get_objects_by_title($title)
        {
            $title    = addslashes($title);
            $criteria = new CriteriaCompo();
            $criteria->add(new criteria('title', $title, '='));
            $objs = $this->getObjects($criteria);
            return $objs;
        }

        public function &get_objects_by_title_like($title)
        {
            $title    = addslashes($title);
            $criteria = new CriteriaCompo();
            $criteria->add(new criteria('title', '%' . $title . '%', 'LIKE'));
            $objs = $this->getObjects($criteria);
            return $objs;
        }

        //---------------------------------------------------------
        // get lid list
        //---------------------------------------------------------
        // for randum jump
        public function &get_lid_array_by_random($limit = 0, $start = 0)
        {
            // XOOPS 2.2.3 dont accept value = ''
            $sql = 'SELECT lid FROM ' . $this->_table . ' WHERE ';
            $sql .= $this->build_sql_where_exclude();
            $sql .= "AND url <> '' ";
            $sql .= 'ORDER BY rand()';
            $arr =& $this->get_first_rows_by_sql($sql, $limit, $start);
            return $arr;
        }

        // for link_check
        public function &get_lid_array($limit = 0, $start = 0)
        {
            $limit    = (int)$limit;
            $start    = (int)$start;
            $criteria = new CriteriaCompo();
            $criteria->setStart($start);
            $criteria->setLimit($limit);
            $arr =& $this->getList($criteria);
            return $arr;
        }

        //---------------------------------------------------------
        // this function dont work well, when too much links
        //---------------------------------------------------------
        // for admin user manage
        public function &get_lid_array_with_email($limit = 0, $start = 0)
        {
            $user_list            = array();
            $lid_array_with_email = array();
            $email_store          = array();

            $objs =& $this->get_objects_all($limit, $start);
            foreach ($objs as $obj) {
                $lid             = $obj->get('lid');
                $user_list[$lid] = $obj->user_mail('n');
            }

            foreach ($user_list as $lid => $email) {
                // check duplication
                if (empty($email)) {
                    continue;
                }

                if (in_array($email, $email_store)) {
                    //          echo "omit $lid $email <br />\n";
                    continue;
                }

                $email_store[]          = $email;
                $lid_array_with_email[] = $lid;
            }

            return $lid_array_with_email;
        }

        //---------------------------------------------------------
        // field
        //---------------------------------------------------------
        public function &get_field_name_etc_array()
        {
            $arr_name = array();

            $arr_meta =& $this->get_field_meta_name_array();
            if (!is_array($arr_meta) || (count($arr_meta) == 0)) {
                return $arr_name;
            }

            foreach ($this->get_field_name_array() as $name) {
                if (preg_match('/^etc/', $name)) {
                    $arr_name[] = $name;
                }
            }

            return $arr_name;
        }

        //---------------------------------------------------------
        // add_column_table
        //---------------------------------------------------------
        public function add_column_table_etc($start, $end)
        {
            if ($end < $start) {
                $end = $start;
            }

            $comma = ' ';
            if ($start != $end) {
                $comma = ', ';
            }

            $sql = 'ALTER TABLE ' . $this->_table . ' ADD COLUMN (';

            // etci .. etcj
            for ($i = $start; $i <= $end; ++$i) {
                $etc_name = 'etc' . $i;
                $sql .= $etc_name . ' varchar(255) default NULL' . $comma;
            }

            $sql .= ')';

            $ret = $this->query($sql);
            return $ret;
        }

        //---------------------------------------------------------
        // get lid_array for bulk manage
        //---------------------------------------------------------
        public function get_lid_by_title($title)
        {
            $lid_arr = $this->get_lid_array_by_title($title);
            $count   = count($lid_arr);

            if (is_array($lid_arr) && ($count == 1)) {
                return $lid_arr[0];
            } elseif ($count > 1) {
                return -2;  // too many
            }

            if (!is_array($lid_arr) || ($count == 0)) {
                $lid_arr2 =& $this->get_lid_array_by_title_like($title);
                $count2   = count($lid_arr2);

                if (is_array($lid_arr2) && ($count2 == 1)) {
                    return $lid_arr2[0];
                } elseif ($count2 > 1) {
                    return -3;  // too many
                }
            }

            return -1;  // no match
        }

        public function get_lid_array_by_title($title)
        {
            $lid_arr = array();

            $objs =& $this->get_objects_by_title($title);

            if (count($objs) > 0) {
                foreach ($objs as $obj) {
                    $lid_arr[] = $obj->get('lid');
                }
            }

            return $lid_arr;
        }

        public function get_lid_array_by_title_like($title)
        {
            $lid_arr = array();

            $objs =& $this->get_objects_by_title_like($title);

            if (count($objs) > 0) {
                foreach ($objs as $obj) {
                    $lid_arr[] = $obj->get('lid');
                }
            }

            return $cid_arr;
        }

        //=========================================================
        // link_basic_handler
        //=========================================================
        public function get_count_rss_flag($flag_exclude = true)
        {
            return $this->_link_basic_handler->get_count_rss_flag($flag_exclude);
        }

        public function get_count_non_url()
        {
            return $this->_link_basic_handler->get_count_non_url();
        }

        public function get_count_broken()
        {
            return $this->_link_basic_handler->get_count_broken();
        }

        public function get_count_gmap()
        {
            return $this->_link_basic_handler->get_count_gmap();
        }

        public function get_count_by_where($where)
        {
            return $this->_link_basic_handler->get_count_by_where($where);
        }

        public function build_sql_where_exclude()
        {
            return $this->_link_basic_handler->build_sql_where_exclude();
        }

        public function get_title($lid, $format = 'n')
        {
            return $this->_link_basic_handler->get_title($lid, $format);
        }

        // --- class end ---
    }

    // === class end ===
}
