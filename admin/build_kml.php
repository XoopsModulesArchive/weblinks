<?php
// $Id: build_kml.php,v 1.1 2008/02/26 16:06:47 ohwada Exp $

//=========================================================
// WebLinks Module
// 2008-02-17 K.OHWADA
//=========================================================

include 'admin_header.php';
include_once WEBLINKS_ROOT_PATH.'/api/build_kml.php';

$builder =& weblinks_get_handler( 'build_kml', WEBLINKS_DIRNAME );
$builder->view();

exit();
// --- main end ---

?>