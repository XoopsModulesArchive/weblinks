$Id: readme_jp.txt,v 1.1 2008/02/26 16:05:20 ohwada Exp $

=================================================
HTML?o力プラグインの?�り方
=================================================

プラグイン名を "foobar" とします

1. プラグインの記?q例

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
    // ここは英語の?燒ｾ文
    return "this is foobar description";
}

function execute_plugin()
{
    $content = $this->get_item_by_key( 'content' );
    $converted = xxx;   // ここに変換?��?を?曹ｭ
    $this->set_item_by_key( 'content', $converted );
    return true;
}

} // class の?Iわり
} // class_exists の?Iわり
-----

2. 日本語の?燒ｾ文の記?q例

htmlout/language/japanese/foobar.php
-----
$PLUGIN_DESCRIPTION = "これは foobar の?燒ｾ文です";
-----
