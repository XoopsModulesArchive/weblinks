$Id: readme_jp.txt,v 1.1 2008/02/26 16:05:20 ohwada Exp $

=================================================
HTML?o—Íƒvƒ‰ƒOƒCƒ“‚Ì?ì‚è•û
=================================================

ƒvƒ‰ƒOƒCƒ“–¼‚ð "foobar" ‚Æ‚µ‚Ü‚·

1. ƒvƒ‰ƒOƒCƒ“‚Ì‹L?q—á

htmlout/foobar.php
------
if( !class_exists('weblinks_htmlout_foobar') )
{

class weblinks_htmlout_foobar extends weblinks_htmlout_base
{

function weblinks_htmlout_foobar( $dirname )
{
    $this->weblinks_htmlout_base( $dirname );
}

function description()
{
    // ‚±‚±‚Í‰pŒê‚Ì?à–¾•¶
    return "this is foobar description";
}

function execute_plugin()
{
    $content = $this->get_item_by_key( 'content' );
    $converted = xxx;   // ‚±‚±‚É•ÏŠ·?ˆ—?‚ð?‘‚­
    $this->set_item_by_key( 'content', $converted );
    return true;
}

} // class ‚Ì?I‚í‚è
} // class_exists ‚Ì?I‚í‚è
-----

2. “ú–{Œê‚Ì?à–¾•¶‚Ì‹L?q—á

htmlout/language/japanese/foobar.php
-----
$PLUGIN_DESCRIPTION = "‚±‚ê‚Í foobar ‚Ì?à–¾•¶‚Å‚·";
-----
