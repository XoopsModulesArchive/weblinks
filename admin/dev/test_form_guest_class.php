<?php
// $Id: test_form_guest_class.php,v 1.1 2007/11/02 11:36:29 ohwada Exp $

// 2007-10-30 K.OHWADA
// divid from test_form_class.php
// change request from int to text

//=========================================================
// WebLinks Module
// 2006-09-20 K.OHWADA
//=========================================================

//=========================================================
// class weblinks_test_form_guest
//=========================================================
class weblinks_test_form_guest extends weblinks_test_form
{

    //---------------------------------------------------------
    // constructor
    //---------------------------------------------------------
    public function __construct()
    {
        parent::__construct();
    }

    public static function getInstance()
    {
        static $instance;
        if (!isset($instance)) {
            $instance = new weblinks_test_form_guest();
        }
        return $instance;
    }

    //---------------------------------------------------------
    // guest modify
    //---------------------------------------------------------
    public function guest_modify_password(&$param)
    {
        $lid = isset($param['lid']) ? $param['lid'] : 0;

        $this->_lid = $lid;

        $link_form_url = $this->_user_modify_url . '?lid=' . $lid;
        $ret           = $this->fetch_form($link_form_url);
        if (!$ret) {
            return false;
        }

        $form = $this->build_form_password($param);

        $ret = $this->submit_form($this->_user_modify_url, $form);
        if (!$ret) {
            return false;
        }

        $form = $this->build_link_form($param);

        $ret = $this->submit_form($this->_user_modify_url, $form);
        if (!$ret) {
            return false;
        }

        return true;
    }

    //---------------------------------------------------------
    // guest delete
    //---------------------------------------------------------
    public function guest_delete_password(&$param)
    {
        $lid = isset($param['lid']) ? $param['lid'] : 0;

        $this->_lid = $lid;

        $link_form_url = $this->_user_modify_url . '?lid=' . $lid;
        $ret           = $this->fetch_form($link_form_url);
        if (!$ret) {
            return false;
        }

        $form = $this->build_form_password($param);

        $ret = $this->submit_form($this->_user_modify_url, $form);
        if (!$ret) {
            return false;
        }

        // post op=delete
        $form = $this->build_form_del_password($param);

        $ret = $this->submit_form($this->_user_modify_url, $form);
        if (!$ret) {
            return false;
        }

        return true;
    }

    //---------------------------------------------------------
    // build_link_form
    //---------------------------------------------------------
    public function &build_form_password(&$param)
    {
        $lid     = isset($param['lid']) ? $param['lid'] : 0;
        $passwd  = isset($param['passwd']) ? $param['passwd'] : null;
        $request = isset($param['request']) ? $param['request'] : null;

        $arr = array(
            'lid'        => $lid,
            'passwd_old' => $passwd,
            'request'    => $request,
        );

        return $arr;
    }

    public function &build_form_del_password(&$param)
    {
        $lid     = isset($param['lid']) ? $param['lid'] : 0;
        $passwd  = isset($param['passwd']) ? $param['passwd'] : null;
        $request = isset($param['request']) ? $param['request'] : null;

        $arr = array(
            'XOOPS_G_TICKET' => $this->get_ticket(),
            'delete'         => 'delete',
            'lid'            => $lid,
            'passwd_old'     => $passwd,
            'request'        => $request,
            'notify'         => 0,
        );

        return $arr;
    }

    //---------------------------------------------------------
    // permission
    //---------------------------------------------------------
    public function has_guest_perm()
    {
        global $xoopsModule;
        $mid = $xoopsModule->getVar('mid');

        $groups_guest = array(XOOPS_GROUP_ANONYMOUS);

        $groupperm_handler = xoops_getHandler('groupperm');
        if ($groupperm_handler->checkRight('module_read', $mid, $groups_guest)) {
            return true;
        }
        return false;
    }

    // --- class end ---
}
