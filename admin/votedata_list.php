<?php
// $Id: votedata_list.php,v 1.2 2007/11/11 03:22:59 ohwada Exp $

// 2007-11-01 K.OHWADA
// weblinks_admin_print_footer()

// 2006-09-20 K.OHWADA
// this new file

//================================================================
// WebLinks Module
// 2006-09-20 K.OHWADA
//================================================================

include 'admin_header.php';
include 'admin_header_list.php';
include_once WEBLINKS_ROOT_PATH . '/admin/votedata_list_class.php';

//=========================================================
// main
//=========================================================
xoops_cp_header();
weblinks_admin_print_header();
weblinks_admin_print_menu();

$list = admin_votedata_list::getInstance();
$list->_show();

weblinks_admin_print_footer();
xoops_cp_footer();
exit();// --- end of main ---
;
