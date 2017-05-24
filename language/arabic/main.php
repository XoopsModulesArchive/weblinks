<?php
// $Id: main.php,v 1.2 2008/02/24 12:53:04 ohwada Exp $

// 2007-11-01 K.OHWADA
// _WEBLINKS_ERROR_LENGTH
// remove _WEBLINKS_INIT_NOT

// 2007-09-01 K.OHWADA
// waiting list
// change _WLS_NOTIFYAPPROVE

// 2007-08-01 K.OHWADA
// _WEBLINKS_GM_CURRENT_ADDRESS
// <br> => <br />

// 2007-04-08 K.OHWADA
// _WEBLINKS_GM_TYPE

// 2007-03-25 K.OHWADA
// _WEBLINKS_ALBUM_ID

// 2007-02-20 K.OHWADA
// forum

// 2007-01-20 K.OHWADA
// _WEBLINKS_CAT_AUX_TEXT_1

// 2006-12-11 K.OHWADA
// google map: googleGeocode
// _WEBLINKS_TIME_PUBLISH

// 2006-11-26 K.OHWADA
// google map: JP Geocode

// 2006-11-04 K.OHWADA
// google map: JP inverse Geocoder
// google map: inline mode

// 2006-10-01 K.OHWADA
// conflict with rssc
// add _WEBLINKS_RSSC_LID
// google map

// 2006-05-15 K.OHWADA
// weblinks ver 1.1
// _WEBLINKS_MID, etc

// 2006-01-01 K.OHWADA
// weblinks ver 1.0
// module depulication

//=========================================================
// WebLinks Module
// language main
// 2004-10-24 K.OHWADA
//=========================================================

// --- define language begin ---
if (!defined('WEBLINKS_LANG_MB_LOADED')) {
    define('WEBLINKS_LANG_MB_LOADED', 1);

    //---------------------------------------------------------
    // same as mylinks
    //---------------------------------------------------------

    //======         singlelink.php        ======
    define('_WLS_CATEGORY', '«·ﬁ”„');
    define('_WLS_HITS', '«·“Ì«—« ');
    define('_WLS_RATING', '«· ﬁÌÌ„');
    define('_WLS_VOTE', '«· ’ÊÌ ');
    define('_WLS_ONEVOTE', '’Ê  Ê«Õœ');
    define('_WLS_NUMVOTES', '%s ’Ê ');
    define('_WLS_RATETHISSITE', 'ﬁÌÌ„ Â–« «·„Êﬁ⁄');
    define('_WLS_REPORTBROKEN', '«Œ»—‰« ⁄‰ Ê’·… ·«  ⁄„·');
    define('_WLS_TELLAFRIEND', '√Œ»— ’œÌﬁ');
    define('_WLS_EDITTHISLINK', ' ⁄œÌ· Â–« «·—«»ÿ');
    define('_WLS_MODIFY', ' ⁄œÌ·');

    //======        submit.php        ======
    define('_WLS_SUBMITLINKHEAD', '«—”«· —«»ÿ ÃœÌœ…');
    define('_WLS_SUBMITONCE', '√—”· „Êﬁ⁄ﬂ „—… Ê«Õœ…');
    define('_WLS_DONTABUSE', ' „ Õ›Ÿ «·«”„ „⁄ «·«Ì »Ì —Ã«¡ ·«  ‘€· «·‰Ÿ«„.');
    define('_WLS_TAKESHOT', '”Ê› ‰√Œ– ’Ê—… „’€—… ⁄‰ «·„Êﬁ⁄ Ê”Ê›  Õ «Ã «·Ì ⁄œ… «Ì«„ ·«÷«› Â« «·Ì ﬁ«⁄œ… «·»Ì«‰« .');
    define('_WLS_ALLPENDING', '”Ê› Ì „ «· ÕﬁÌﬁ „‰ «·—«»ÿ ﬁ»· «·‰‘— ');
    //define("_WLS_WHENAPPROVED","”Ê› ‰—”· ·ﬂ «„Ì· ›Ì Õ«·… «·„Ê«›ﬁ….");
    define('_WLS_RECEIVED', '·ﬁœ  ·ﬁÌ‰« „⁄·Ê„«  „Êﬁ⁄ﬂ ‘ﬂ—« ·ﬂ!');

    //======        modlink.php        ======
    define('_WLS_REQUESTMOD', 'ÿ·» ›Ì  ⁄œÌ· —«»ÿ');
    define('_WLS_THANKSFORINFO', '‘ﬂ—« ·Â–Ì «·„⁄·Ê„«  , ”Ê› ‰—Ï ÿ·»ﬂ ›Ì √ﬁ’— Êﬁ .');

    define('_WLS_THANKSFORHELP', '‘ﬂ—« ··„”«⁄œ… ·≈»ﬁ«¡ ”·«„… Â–« «·œ·Ì·.');
    define('_WLS_FORSECURITY', '·√”»«» √„‰Ì… «·«”„ Ê⁄‰Ê«‰ ¬Ì »Ì ·œÌﬂ ”Ì „  ”ÃÌ·Â« »‘ﬂ· „ƒﬁ .');

    define('_WLS_SEARCHFOR', '»ÕÀ ⁄‰'); //-no use
    define('_WLS_ANY', '√Ì');
    define('_WLS_SEARCH', '»ÕÀ');

    //define("_WLS_MAIN","Main");
    define('_WLS_SUBMITLINK', '√—”· —«»ÿ');
    define('_WLS_POPULAR', '«·„‘ÂÊ—');
    define('_WLS_TOPRATED', '√›÷·  ﬁÌÌ„');

    define('_WLS_NEWTHISWEEK', 'ÃœÌœ «·√”»Ê⁄');
    define('_WLS_UPTHISWEEK', 'ÕœÌÀ Â–« «·√”»Ê⁄');

    define('_WLS_POPULARITYLTOM', '«·√ﬂÀ— “Ì«—… (√ﬁ· ≈·Ï √ﬂÀ— “Ì«—« )');
    define('_WLS_POPULARITYMTOL', '«·√ﬂÀ— “Ì«—… (√ﬂÀ— ≈·Ï √ﬁ· “Ì«—« )');
    define('_WLS_TITLEATOZ', '«·⁄‰Ê«‰ (« «·Ï Ì)');
    define('_WLS_TITLEZTOA', '«·⁄‰Ê«‰ (Ì «·Ï «)');
    define('_WLS_DATEOLD', '«· «—ÌŒ («·—Ê«»ÿ «·ﬁœÌ„… √Ê·«)');
    define('_WLS_DATENEW', '«· «—ÌŒ («·—Ê«»ÿ «·ÃœÌœ… √Ê·«)');
    define('_WLS_RATINGLTOH', '«· ﬁÌ„ („‰ «·√ﬁ· ≈·Ï «·√⁄·Ï)');
    define('_WLS_RATINGHTOL', '«· ﬁÌÌ„ („‰ «·√⁄·Ï ≈·Ï «·√ﬁ·)');

    //define("_WLS_NOSHOTS","·« ÌÊÃœ ’Ê—… „ Ê›—…");
    //define("_WLS_DESCRIPTIONC","«·Ê’›: ");
    //define("_WLS_EMAILC","«·»—Ìœ: ");
    //define("_WLS_CATEGORYC","«·ﬁ”„: ");
    //define("_WLS_LASTUPDATEC","¬Œ—  ÕœÌÀ: ");
    //define("_WLS_HITSC","«·“Ì«—« : ");
    //define("_WLS_RATINGC","«· ﬁÌ„: ");

    define('_WLS_THEREARE', 'Â‰«ﬂ <b> %s </b> „Ê«ﬁ⁄ ›Ì ﬁ«⁄œ… «·»Ì«‰« ');
    define('_WLS_LATESTLIST', '¬Œ— «·‰ «∆Ã');

    //define("_WLS_LINKID","—ﬁ„ «·Ê’·…: ");
    //define("_WLS_SITETITLE","«”„ «·„Êﬁ⁄: ");
    //define("_WLS_SITEURL","⁄‰Ê«‰ «·„Êﬁ⁄: ");
    //define("_WLS_OPTIONS","ŒÌ«—« : ");
    define('_WLS_LINKID', '—ﬁ„ «·—«»ÿ');
    define('_WLS_SITETITLE', '≈”„ «·„Êﬁ⁄');
    define('_WLS_SITEURL', '⁄‰Ê«‰ «·„Êﬁ⁄');
    define('_WLS_OPTIONS', 'ŒÌ«—« ');

    define('_WLS_NOTIFYAPPROVE', ' »·Ì€Ì „ Ï Ì „ «·„Ê«›ﬁ… ⁄·Ï «·—«»ÿ');
    //define("_WLS_SHOTIMAGE","’Ê—… „’€—…: ");
    define('_WLS_SENDREQUEST', '√—”· ÿ·»');

    define('_WLS_VOTEAPPRE', '‘ﬂ—« ⁄·Ì «· ’ÊÌ ');
    define('_WLS_THANKURATE', '‘ﬂ—« ·ﬂ · ﬁÌ„ Â–« «·„Êﬁ⁄ %s.');
    define('_WLS_VOTEFROMYOU', '„”«Â„… «·«⁄÷«¡  ‰›”ﬂ «‰  ”Ê› ” ”«⁄œ «·“Ê«— ⁄·Ì  ﬁ—Ì— √Ì —«»ÿ ÌŒ «—Ê‰….');
    define('_WLS_VOTEONCE', '—Ã«¡ ·«  ﬁÌÌ„ «·„Êﬁ⁄ √ﬂÀ— „‰ „—…');
    define('_WLS_RATINGSCALE', '≈‰ „ﬁÌ«” «· ﬁÌÌ„«  „‰ 1 «·Ï 10° »‹1 ÌﬂÊ‰ ”Ì¯∆ Ê10 ÌﬂÊ‰ „„ «“.');
    define('_WLS_BEOBJECTIVE', '—Ã«¡ ﬂ‰ Âœ«›° ≈–« «” ·„ ﬂ· Ê«Õœ  1 √Ê  10° »⁄÷ «· ﬁÌÌ„«  ·Ì”  „›Ìœ… Ãœ«.');
    define('_WLS_DONOTVOTE', '·«  ’Ê¯  ·’«·Õﬂ «·‘Œ’Ì.');
    define('_WLS_RATEIT', 'ﬁÌÌ„…!');

    define('_WLS_INTRESTLINK', '—«»ÿ „Êﬁ⁄ „›Ìœ… ›Ì %s');  // %s is your site name
    define('_WLS_INTLINKFOUND', 'Â‰« —«»ÿ „Êﬁ⁄ ÊÌ» „›Ìœ ÊÃœ  ›Ì %s');  // %s is your site name

    define('_WLS_RANK', '«· — Ì»');
    define('_WLS_TOP10', '%s Top 10'); // %s is a link category title

    define('_WLS_SEARCHRESULTS', '‰ «∆Ã «·»ÕÀ ⁄‰ <b>%s</b>:'); // %s is search keywords
    define('_WLS_SORTBY', ' — Ì» Õ”»:');
    define('_WLS_TITLE', '«·⁄‰Ê«‰');
    define('_WLS_DATE', '«· «—ÌŒ');
    define('_WLS_POPULARITY', '«·√ﬂÀ— “Ì«—…');
    define('_WLS_CURSORTEDBY', '«·„Ê«ﬁ⁄ „— ¯»… Õ«·Ì« Õ”»: %s');
    define('_WLS_PREVIOUS', '«·”«»ﬁ');
    define('_WLS_NEXT', '«· «·Ì');
    define('_WLS_NOMATCH', '·« ÌÊÃœ «·ﬂÀÌ— ⁄‰ »ÕÀﬂ');

    define('_WLS_SUBMIT', '«—”«·');
    define('_WLS_CANCEL', '«·€«¡');

    define('_WLS_ALREADYREPORTED', '·ﬁœ ﬁœ„   ﬁ—Ì—« „”»ﬁ« ⁄‰ Â–« «·«„—');
    define('_WLS_MUSTREGFIRST', '¬”›° ·Ì” ·œÌﬂ  ’—ÌÕ ·≈œ«¡ Â–Â «·⁄„·Ì…. <br /> —Ã«¡ ”Ã¯· √Ê «œŒ· √Ê·«!');
    define('_WLS_NORATING', '·« ÌÊÃœ  ﬁÌ„ „Õœœ');
    define('_WLS_CANTVOTEOWN', ' ·« Ì„ﬂ‰ﬂ «· ’ÊÌ  ⁄·Ï „Êﬁ⁄ﬂ. <br /> ﬂ·¯ «·√’Ê«   ”Ã¯· Ê —«Ã⁄.');
    define('_WLS_VOTEONCE2', '’Ê¯  ·’«·Õ «·„Êﬁ⁄ „—… Ê«Õœ…. <br /> ﬂ·¯ «·√’Ê«   ”Ã¯· Ê —«Ã⁄.');

    //%%%%%%        Admin          %%%%%

    define('_WLS_WEBLINKSCONF', 'ŒÌ«—«  —Ê«»ÿ «·ÊÌ»');
    define('_WLS_GENERALSET', 'ŒÌ«—«  «·—Ê«»ÿ «·⁄«„…');
    //define("_WLS_ADDMODDELETE","Add, Modify, and Delete Categories/Links");
    define('_WLS_LINKSWAITING', '«·—Ê«»ÿ «·ÃœÌœ… «· Ì  ‰ Ÿ— «·„Ê«›ﬁ…');
    define('_WLS_MODREQUESTS', '«·—Ê«»ÿ «·„⁄œ·… «· Ì  ‰ Ÿ— «·„Ê«›ﬁ…');
    define('_WLS_BROKENREPORTS', ' ﬁ«—Ì— «·—Ê«»ÿ «· Ì ·«  ⁄„·');

    //define("_WLS_SUBMITTER","Submitter: ");
    define('_WLS_SUBMITTER', '«·„—”·');

    define('_WLS_VISIT', '“Ì«—…');

    //define("_WLS_SHOTMUST","Screenshot image must be a valid image file under %s directory (ex. shot.gif). Leave it blank if no image file.");
    define('_WLS_LINKIMAGEMUST', ' ≈œŒ· «”„ „·› Ê’·… «·’Ê—…  Õ  œ·Ì· %s . („À«· ⁄·Ï –·ﬂ: - shot.gif) « —ﬂ «·Õﬁ· ›«—€ ≈–« ·Ì” Â‰«ﬂ „·› ··’Ê—….');

    define('_WLS_APPROVE', '„Ê«›ﬁ…');
    define('_WLS_DELETE', 'Õ–›');
    define('_WLS_NOSUBMITTED', '·« ÌÊÃœ —Ê«»ÿ „—”·… ÃœÌœ….');
    define('_WLS_ADDMAIN', '√÷› ﬁ”„ —∆Ì”Ì');
    define('_WLS_TITLEC', '«·⁄‰Ê«‰: ');
    define('_WLS_IMGURL', '⁄‰Ê«‰ «·’Ê—… (≈— ›«⁄ «·’Ê—… ”Ê› Ì⁄«œ  ÕÃÌ„… «·Ì 50): ');
    define('_WLS_ADD', '√÷›');
    define('_WLS_ADDSUB', '«÷› ﬁ”„ ›—⁄Ì');
    define('_WLS_IN', '›Ì');
    define('_WLS_ADDNEWLINK', '≈÷«›… —«»ÿ ÃœÌœ…');
    define('_WLS_MODCAT', ' ⁄œÌ· ﬁ”„');
    define('_WLS_MODLINK', ' ⁄œÌ· „Êﬁ⁄');
    define('_WLS_TOTALVOTES', '√’Ê«  «·—Ê«»ÿ („Ã„Ê⁄ «· ’ÊÌ « : %s)');
    define('_WLS_USERTOTALVOTES', '√’Ê«  «·√⁄÷«¡ «·„”Ã·Ì‰ („Ã„Ê⁄ «· ’ÊÌ « : %s)');
    define('_WLS_ANONTOTALVOTES', '√’Ê«  «·“Ê«— („Ã„Ê⁄ «· ’ÊÌ « : %s)');
    define('_WLS_USER', '⁄÷Ê');
    define('_WLS_IP', '—ﬁ„ «·√Ì »Ì');
    define('_WLS_USERAVG', '„ Ê”ÿ «· ﬁÌ„');
    define('_WLS_TOTALRATE', '„Ã„Ê⁄ «· ﬁÌ„');
    define('_WLS_NOREGVOTES', '·« ÌÊÃœ √⁄÷« „’Ê Ì‰');
    define('_WLS_NOUNREGVOTES', '·« ÌÊÃœ “Ê«— „’Ê Ì‰');
    define('_WLS_VOTEDELETED', '»Ì«‰«  «· ’ÊÌ  Õ–› .');
    define('_WLS_NOBROKEN', '·« ÌÊÃœ  ﬁ«—Ì— ⁄‰ —Ê«»ÿ ·«  ⁄„·.');
    define('_WLS_IGNOREDESC', '√Â„· (√Â„«· «· ﬁ—Ì— ÊÕ–› ›ﬁÿ <b>  ﬁ—Ì— «·—Ê«»ÿ «· Ì ·«  ⁄„· </b>) ');
    define('_WLS_DELETEDESC', '≈Õ–› (Õ–› <b> »Ì«‰«  «·„Êﬁ⁄ «·„ı»·€ ⁄‰Â« </b> Ê<b>  ﬁ«—Ì— «·—Ê«»ÿ «· Ì ·«  ⁄„· </b> ··—«»ÿ.)');
    define('_WLS_REPORTER', ' ﬁ—Ì— „—”·');

    define('_WLS_IGNORE', '—›÷');
    define('_WLS_LINKDELETED', 'Õ–› «·—«»ÿ.');
    define('_WLS_BROKENDELETED', ' ﬁ—Ì— ⁄‰ «·—«»ÿ «·–Ì ·« Ì⁄„· Õ–›.');
    //define("_WLS_USERMODREQ","User Link Modification Requests");
    define('_WLS_ORIGINAL', '√’·Ì');
    define('_WLS_PROPOSED', 'Ìﬁ —Õ');
    define('_WLS_OWNER', '«·„«·ﬂ');
    define('_WLS_NOMODREQ', '·« ÌÊÃœ ÿ·»  ⁄œÌ· —«»ÿ.');
    define('_WLS_DBUPDATED', ' „  ÕœÌÀ ﬁ«⁄œ… «·»Ì«‰«  »‰Ã«Õ!');
    define('_WLS_MODREQDELETED', 'ÿ·»  ⁄œÌ· Õı–›.');
    define('_WLS_IMGURLMAIN', '⁄‰Ê«‰ «·’Ê—… ( ≈Œ Ì«—Ì…: Ê›ﬁÿ ··√ﬁ”«„ «·—∆Ì”Ì…. ≈— ›«⁄ ’Ê—… ”Ì⁄«œ  ÕÃÌ„… «·Ï 50):');
    define('_WLS_PARENT', '«·ﬁ”„ «·—∆Ì”Ì');
    define('_WLS_SAVE', 'Õ›Ÿ «· €Ì—« ');
    define('_WLS_CATDELETED', '«·ﬁ”„ Õ–›.');
    define('_WLS_WARNING', ' Õ–Ì—: Â· √‰  „ √ﬂœ »√‰  Õ–› Â–« «·ﬁ”„ Êﬂ· «·—Ê«»ÿ Ê ⁄·Ìﬁ« Â«ø');
    define('_WLS_YES', '‰⁄„');
    define('_WLS_NO', '·«');
    define('_WLS_NEWCATADDED', ' „ ≈÷«›… «·ﬁ”„ »‰Ã«Õ!');
    //define("_WLS_ERROREXIST","ERROR: The Link you provided is already in the database!");
    //define("_WLS_ERRORTITLE","ERROR: You need to enter a TITLE!");
    //define("_WLS_ERRORDESC","ERROR: You need to enter a DESCRIPTION!");
    define('_WLS_NEWLINKADDED', '≈÷«›  —«»ÿ ÃœÌœ… ≈·Ï ﬁ«⁄œ… «·»Ì«‰« .');
    define('_WLS_YOURLINK', '—«»ÿ „Êﬁ⁄ﬂ ›Ì %s');
    define('_WLS_YOUCANBROWSE', ' Ì„ﬂ‰ √‰   ’›Õ —Ê«»ÿ „Êﬁ⁄‰« ›Ì %s');
    define('_WLS_HELLO', 'Hello %s');
    define('_WLS_WEAPPROVED', '·ﬁœ  „  «·„Ê«›ﬁ… ⁄·Ì —«»ÿ «·„Êﬁ⁄');
    define('_WLS_THANKSSUBMIT', '‘ﬂ—« ·≈—”«·ﬂ!');
    define('_WLS_ISAPPROVED', '·ﬁœ  „  «·„Ê«›ﬁ… ⁄·Ì «·—«»ÿ');

    //---------------------------------------------------------
    // weblinks
    //---------------------------------------------------------

    //======        index.php        ======
    // guidance bar
    define('_WLS_SUBMIT_NEW_LINK', '√÷› „Êﬁ⁄ﬂ');
    define('_WLS_SITE_POPULAR', '«·„Ê«ﬁ⁄ «·√ﬂÀ— “Ì«—…');
    define('_WLS_SITE_HIGHRATE', '√›÷· «·„Ê«ﬁ⁄ «·„ﬁÌ„…');
    define('_WLS_SITE_NEW', '¬Œ— «·„Ê«ﬁ⁄');
    define('_WLS_SITE_UPDATE', ' ÕœÌœÀ «·„Êﬁ⁄');

    // corrected typo
    define('_WLS_SITE_RECOMMEND', '„Ê«ﬁ⁄ Ì‰’Õ ›ÌÂ«');

    // BUG 3032: "mutual site" is not suitable English
    define('_WLS_SITE_MUTUAL', '«·„Ê«ﬁ⁄ «·„ »«œ·…');

    define('_WLS_SITE_RANDOM', '„Êﬁ⁄ ⁄‘Ê«∆Ì');
    define('_WLS_NEW_SITELIST', '¬Œ— „Êﬁ⁄');
    define('_WLS_NEW_ATOMFEED', 'Latest RSS/ATOM Feed');
    define('_WLS_SITE_RSS', 'RSS/ATOM Site');
    define('_WLS_ATOMFEED', 'RSS/ATOM Feed');

    define('_WLS_LASTUPDATE', '¬Œ—  ÕœÌœÀ');
    define('_WLS_MORE', '„“Ìœ „‰ «· ›«’Ì·');

    //======         singlelink.php        ======
    define('_WLS_DESCRIPTION', '«·Ê’›');
    define('_WLS_PROMOTER', '«·‰«‘—');
    define('_WLS_ZIP', '«·—„“ «·»—ÌœÌ');
    define('_WLS_ADDR', '«·⁄‰Ê«‰');
    define('_WLS_TEL', '—ﬁ„ «· ·›Ê‰');
    define('_WLS_FAX', '⁄œœ «·‰”Œ…');

    //======         submit.php        ======
    define('_WLS_BANNERURL', '⁄‰Ê«‰ «·»‰—');
    define('_WLS_NAME', '«·√”„');
    define('_WLS_EMAIL', '«·»—Ìœ');
    define('_WLS_COMPANY', '‘—ﬂ… / „‰Ÿ„…');
    define('_WLS_STATE', '«·Ê·«Ì…');
    define('_WLS_CITY', '«·„œÌ‰…');
    define('_WLS_ADDR2', '⁄‰Ê«‰ 2');
    define('_WLS_PUBLIC', '‰‘—');
    define('_WLS_NOTPUBLIC', '⁄œ„ ‰‘—');
    define('_WLS_NOTSELECT', '·Ì” „Õœ¯œ');
    define('_WLS_SUBMIT_INDISPENSABLE', "⁄·«„… «·‰Ã„… ' <b> * </b> ' Ì⁄‰Ì ≈Ã»«—Ì….");
    define('_WLS_SUBMIT_USER_COMMENT', '"≈—”«· ≈·Ï «·≈œ«—…  <br /> Â–« «·⁄„Êœ ·‰ Ì⁄—÷ ⁄·Ï «·ÊÌ». <br /> —Ã«¡ «ﬂ » ⁄‰Ê«‰ „Êﬁ⁄ﬂ ÕÌÀ ÌÊÃœ —«»ÿ „Êﬁ⁄‰«° «–« ﬂ‰    —Ìœ ⁄„· " »«œ· „Ê«ﬁ⁄".');
    define('_WLS_USER_COMMENT', ' ⁄·Ìﬁ ··√œ„‰');
    define('_WLS_NOT_DISPLAY', 'Â–« «·⁄„Êœ ·‰ Ì⁄—÷ ⁄·Ï «·ÊÌ».');

    //======        modlink.php        ======
    define('_WLS_MODIFYAPPROVED', ' „  «·„Ê«›ﬁ… ⁄·Ì  ⁄œÌ· „Êﬁ⁄ﬂ ');
    define('_WLS_MODIFY_NOT_OWNER', '—Ã«¡ ≈÷„‰ »√‰¯ﬂ «·‘Œ’ «·–Ì ﬁœ¯„ «·—«»ÿ «·√’·Ì.');
    define('_WLS_MODIFY_PENDING', ' ⁄œÌ· „Êﬁ⁄ „”Ã·. ”Ê› Ì „ «·‰‘— »⁄œ «· Õﬁﬁ „‰ «·—«»ÿ.');
    define('_WLS_LINKSUBMITTER', '—Ê«»ÿ „—”·…');

    //======        user.php        ======
    define('_WLS_PLEASEPASSWORD', '«œŒ· «·—ﬁ„ «·”—Ì');
    define('_WLS_REGSTERED', '⁄÷Ê „”Ã·');
    define('_WLS_REGSTERED_DSC', '√Ì ‘Œ’ Ì„ﬂ‰ √‰ Ì⁄œ· „⁄·Ê„«  —«»ÿ. <br /> „”ƒÊ· «·„Êﬁ⁄ ”Ìœﬁﬁ «· ⁄œÌ· ﬁ»· «·‰‘—.');
    define('_WLS_EMAILNOTFOUND', '«·—Ã«¡ «· √ﬂœ „‰ «·»—Ìœ');

    // error message
    define('_WLS_ERROR_FILL', 'Œÿ√: œŒÊ· %s');
    define('_WLS_ERROR_ILLEGAL', 'Œÿ√: «·’Ì€… Œ«ÿ∆… %s');
    define('_WLS_ERROR_CID', 'Œÿ√:  ÕœÌœ «·ﬁ”„');
    define('_WLS_ERROR_URL_EXIST', 'Œÿ√: «·„Êﬁ⁄ „”Ã·… „‰ ﬁÌ·. ');
    define('_WLS_WARNING_URL_EXIST', ' Õ–Ì—:  „  ”ÃÌ· „Êﬁ⁄ „‘«»… „‰ ﬁ»·. ');
    define('_WLS_ERRORNOLINK', 'Œÿ√: ·„ Ì „ «·⁄ÀÊ— ⁄·Ï «·„Êﬁ⁄');

    define('_WLS_CATLIST', 'ﬁ«∆„… «·√ﬁ”«„');
    define('_WLS_LINKIMAGE', 'Ê’·… «·’Ê—…: ');
    //define("_WLS_USERID","—ﬁ„ «·⁄÷Ê: ");
    define('_WLS_CATEGORYID', '—ﬁ„ «·ﬁ”„: ');
    //define("_WLS_CREATEC"," «—ÌŒ «· ”ÃÌ·: ");
    define('_WLS_TIMEUPDATE', ' ÕœÌÀ');
    define('_WLS_NOTTIMEUPDATE', '⁄œ„ «· ÕœÌÀ');
    define('_WLS_LINKFLAG', ' ”ÃÌ· „Ê«ﬁ⁄ ›Ì Â–« «·ﬁ”„');
    define('_WLS_NOTLINKFLAG', '⁄œ„  ”ÃÌ· „Ê«ﬁ⁄ ›Ì Â–« «·ﬁ”„');
    define('_WLS_GOTOADMIN', '«·–Â«» «·Ì ’›Õ… «·√œ„‰');

    // category delete
    define('_WLS_DELCAT', 'Õ–› «·ﬁ”„');
    define('_WLS_SUBCATEGORY', 'ﬁ”„ ›—⁄Ì');
    define('_WLS_SUBCATEGORY_NON', '·« ÌÊÃœ ﬁ”„ ›—⁄Ì');
    define('_WLS_LINK_BELONG', '„Êﬁ⁄ „ »«œ·…');
    define('_WLS_LINK_BELONG_NUMBER', '⁄œœ «·—Ê«»ÿ «·„ »«œ·…');
    define('_WLS_LINK_BELONG_NON', '·« ÌÊÃœ —Ê«»ÿ „ »«œ·…');
    define('_WLS_LINK_MAYBE_DELETE', '—Ê«»ÿ ” Õ–›');
    define('_WLS_LINK_MAYBE_DELETE_DSC', '‰ «∆Ã «·⁄„·Ì… ﬁœ  Œ ·› ≈–« Â‰«ﬂ √ﬁ”«„ ›—⁄Ì… . «·—Ê«»ÿ «·√Œ—Ï ﬁœ  Õ–›.');
    define('_WLS_LINK_DELETE_NON', '·« ÌÊÃœ —Ê«»ÿ ·Õ–›Â«');
    define('_WLS_CATEGORY_LINK_DELETE_EXCUTE', 'Õ–› «·ﬁ”„ „⁄ «·—Ê«»ÿ');
    define('_WLS_CATEGORY_LINK_DELETED', ' „ Õ–› «·ﬁ”„ „⁄ «·—Ê«»ÿ.');
    define('_WLS_CATEGORY_DELETED', '«·√ﬁ”«„ Õ–› ');
    define('_WLS_LINK_DELETED', '«·—Ê«»ÿ Õ–› ');

    define('_WLS_ERROR_CATEGORY', 'Œÿ√: ·„ Ì „  ÕœÌœ «·ﬁ”„');
    define('_WLS_ERROR_MAX_SUBCAT', 'Œÿ√: ⁄œœ «·√ﬁ”«„ «·„Õœœ…  Ã«Ê“ «·Õœ «·√⁄·Ï ·Ì „ Õ–›Â« ›Ì «·Êﬁ ');
    define('_WLS_ERROR_MAX_LINK_BELONG', 'Œÿ√: ⁄œœ «·—Ê«»ÿ «·„ »«œ·…  Ã«Ê“ «·Õœ «·√⁄·Ï ·Ì „ Õ–›Â« ›Ì «·Êﬁ ');
    define('_WLS_ERROR_MAX_LINK_DEL', 'Œÿ√: ⁄œœ «·—Ê«»ÿ «·„Õœœ…  Ã«Ê“ «·Õœ «·√⁄·Ï ·ﬂÌ ÌÕ–› ›Ì «·Êﬁ ');

    // recommend site, mutual site
    define('_WLS_MARK', '⁄·«„…');
    define('_WLS_ADMINCOMMENT', ' ⁄·Ìﬁ «·√œ„‰');

    // broken link check
    define('_WLS_BROKEN_COUNTER', '⁄œ«œ «·—«»ÿ ·« Ì⁄„·');

    // RSS/ATOM URL
    define('_WLS_RSS_URL', 'URL of RSS/ATOM');
    define('_WLS_RSS_URL_0', '⁄œ„ ≈” ⁄„«·');
    define('_WLS_RSS_URL_1', 'RSS type');
    define('_WLS_RSS_URL_2', 'ATOM type');
    define('_WLS_RSS_URL_3', '≈” ﬂ‘«› ¬·Ì');

    define('_WLS_ATOMFEED_DISTRIBUTE', 'Distributing RSS/ATOM feeds displayed here.');
    define('_WLS_ATOMFEED_FIREFOX', "If you use <a href='http://www.mozilla.org/products/firefox/' target='_blank'>Firefox</a>, bookmark this page, to browse our RSS/ATOM feed. ");

    // 2005-10-20
    define('_WLS_EMAIL_APPROVE', ' »·ÌﬁÌ ›Ì Õ«·… «·„Ê«›ﬁ…');
    define('_WLS_TOPTEN_TITLE', '%s Top %u');
    // %s is a link category title
    // %u is number of links
    define('_WLS_TOPTEN_ERROR', 'Â‰«ﬂ «·ﬂÀÌ— „‰ «·√ﬁ”«„ «·—∆Ì”Ì…. «‰Ÿ— Õ”» %u');
    // %u is munber of categories

    // 2006-04-02
    define('_WEBLINKS_MID', ' ⁄œÌ· —ﬁ„');
    define('_WEBLINKS_USERID', '—ﬁ„ «·⁄÷Ê');
    define('_WEBLINKS_CREATE', '«‰‘√ ');

    // conflict with rssc
    //define('_HOME',  'Home');
    //define('_SAVE',  'Save');
    //define('_SAVED', 'Saved');
    //define('_CREATE', 'Create');
    //define('_CREATED','Created');
    define('_FINISH', '«·‰Â«Ì…');
    define('_FINISHED', 'Ì‰ÂÌ');
    //define('_EXECUTE', 'Execute');
    //define('_EXECUTED','Executed');
    define('_PRINT', 'ÿ»«⁄…');
    define('_SAMPLE', '⁄Ì‰…');

    define('_NO_MATCH_RECORD', '·« ÌÃÊÃœ ”Ã·«  „ ‘«»…');
    define('_MANY_MATCH_RECORD', 'ÌÊÃœ ≈À‰«‰ √Ê √ﬂÀ— ”Ã·«  „ ‘«»… ');
    define('_NO_CATEGORY', '·« ÌÊÃœ ﬁ”„');
    define('_NO_LINK', '·« ÌÊÃœ —«»ÿ');
    define('_NO_TITLE', '·« ÌÊÃœ ⁄‰Ê«‰');
    define('_NO_URL', '·« ÌÊÃœ „Êﬁ⁄');
    define('_NO_DESCRIPTION', '·« ÌÊÃœ Ê’›');

    define('_GOTO_MAIN', '«·–Â«» «·Ì «·—∆Ì”Ì…');
    define('_GOTO_MODULE', '«·–Â«» «·Ì «·»—‰«„Ã');

    // config
    define('_WEBLINKS_INIT_NOT', '·„  ‘€· ŒÌ«—«  «·ÃœÊ·');
    define('_WEBLINKS_INIT_EXEC', 'ŒÌ«—«  «·ÃœÊ· ‘€· ');
    define('_WEBLINKS_VERSION_NOT', 'This module is not version  %s yet. Update now');
    define('_WEBLINKS_UPGRADE_EXEC', ' ÿÊÌ— ŒÌ«—«  «·ÃœÊ·');

    // html tag
    define('_WEBLINKS_OPTIONS', 'ŒÌ«—« ');
    define('_WEBLINKS_DOHTML', '  ›⁄Ì· √ﬂÊ«œ html ');
    define('_WEBLINKS_DOIMAGE', ' ›⁄Ì· «·’Ê—');
    define('_WEBLINKS_DOBREAK', '  ›⁄Ì· «·›ﬁ—…');
    define('_WEBLINKS_DOSMILEY', '  ›⁄Ì· «·√» ”«„« ');
    define('_WEBLINKS_DOXCODE', ' ›⁄Ì· √ﬂÊ«œ xoops');

    define('_WEBLINKS_PASSWORD_INCORRECT', '«·—ﬁ„ «·”—Ì Œÿ√');
    define('_WEBLINKS_ETC', 'etc');
    define('_WEBLINKS_AUTH_UID', 'User ID Match');
    define('_WEBLINKS_AUTH_PASSWD', 'Password Match');
    define('_WEBLINKS_BANNER_SIZE', '„ﬁ«” «·»‰—');

    // === 2006-10-01 ===
    // conflict with rssc
    //if( !defined('_SAVE') )
    //{
    //  define('_HOME',  'Home');
    //  define('_SAVE',  'Save');
    //  define('_SAVED', 'Saved');
    //  define('_CREATE', 'Create');
    //  define('_CREATED','Created');
    //  define('_EXECUTE', 'Execute');
    //  define('_EXECUTED','Executed');
    //}

    define('_WEBLINKS_MAP_USE', '≈” ⁄„«· «ÌﬁÊ‰… «·Œ—Ìÿ…');

    // rssc
    define('_WEBLINKS_RSSC_LID', 'RSSC Lid');
    define('_WEBLINKS_RSS_MODE', 'RSS Mode');
    define('_WEBLINKS_RSSC_NOT_INSTALLED', 'RSSC module ( %s ) is not installed');
    define('_WEBLINKS_RSSC_INSTALLED', 'RSSC module ( %s ) ver %s is installed');
    define('_WEBLINKS_RSSC_REQUIRE', 'Requires RSSC module ver %s or later');
    define('_WEBLINKS_GOTO_SINGLELINK', '«·–Â«» «·Ï „⁄·Ê„«  «·—«»ÿ');

    // warnig
    define('_WEBLINKS_WARN_NOT_READ_URL', ' Õ–Ì—: €Ì— ﬁ«œ— ⁄·Ï ﬁ—«¡… «·⁄‰Ê«‰');
    define('_WEBLINKS_WARN_BANNER_NOT_GET_SIZE', ' Õ–Ì—: €Ì— ﬁ«œ— ⁄·Ï Ã·» „ﬁ«”«  «·»‰—');

    // google map: hacked by wye <http://never-ever.info/>
    define('_WEBLINKS_GM_LATITUDE', 'Œÿ «·⁄—÷');
    define('_WEBLINKS_GM_LONGITUDE', 'Œÿ «·ÿÊ·');
    define('_WEBLINKS_GM_ZOOM', '„” ÊÏ «· ﬁ—Ì»');
    define('_WEBLINKS_GM_GET_LOCATION', '≈‰ „⁄·Ê„«  «·„Êﬁ⁄ „ﬂ ”»… „⁄ Œ—«∆ÿ ÃÊÃ·');
    //define('_WEBLINKS_GM_GET_BUTTON', 'Get Latitude/Longitude/Zoom');
    define('_WEBLINKS_GM_DEFAULT_LOCATION', '«·„Êﬁ⁄ «·√› —«÷Ì');
    define('_WEBLINKS_GM_CURRENT_LOCATION', '«·„Êﬁ⁄ «·Õ«·Ì');

    // === 2006-11-04 ===
    // google map inline mode
    define('_WEBLINKS_GOOGLE_MAPS', 'Œ—«∆ÿ ÃÊÃ·');
    define('_WEBLINKS_JAVASCRIPT_INVALID', '„ ’›Õﬂ ·« Ìœ⁄„ Ã«›« ”ﬂ—Ì ');
    define('_WEBLINKS_GM_NOT_COMPATIBLE', '„ ’›Õﬂ ·« Ì„ﬂ‰Â «” Œœ«„ «Ê ·« Ìœ⁄„ Œ—Ìÿ… ÃÊÃ·');
    define('_WEBLINKS_GM_NEW_WINDOW', '⁄—÷ ›Ì ‰«›–Â ÃœÌœ…');
    define('_WEBLINKS_GM_INLINE', '⁄—÷ ›Ì ‰›” «·’›Õ…');
    define('_WEBLINKS_GM_DISP_OFF', ' ⁄ÿÌ· «·⁄—÷');

    // google map: inverse Geocoder
    define('_WEBLINKS_GM_GET_LATITUDE', 'Get Latitude/Longitude/Zoom');
    define('_WEBLINKS_GM_GET_ADDR', '«Õ÷— «·⁄‰Ê«‰');

    // === 2006-12-11 ===
    // google map: Geocode
    define('_WEBLINKS_GM_SEARCH_MAP_FROM_ADDRESS', '»ÕÀ «·Œ—Ìÿ… „‰ «·⁄‰Ê«‰');
    define('_WEBLINKS_GM_NO_MATCH_PLACE', '·Ì” Â‰«ﬂ „ﬂ«‰ ·„Ã«—«… «·⁄‰Ê«‰');
    define('_WEBLINKS_GM_JP_SEARCH_MAP_FROM_ADDRESS', 'Search Map from the address in Japan');
    define('_WEBLINKS_GM_JP_TOKYO_AC_GEOCODE', 'Japan Tokyo University');
    define('_WEBLINKS_GM_JP_MLIT_ISJ', 'Japan Ministry of Land Infrastructure and Transport');

    // link item
    define('_WEBLINKS_TIME_PUBLISH', ' «—ÌŒ «·‰‘—');
    define('_WEBLINKS_TIME_EXPIRE', ' «—ÌŒ «·√‰ Â«¡');
    define('_WEBLINKS_TEXTAREA', 'ﬂ «»… ‰’');

    define('_WEBLINKS_WARN_TIME_PUBLISH', '·„ ÌÕ‰ Êﬁ  «·«‰ Â«¡');
    define('_WEBLINKS_WARN_TIME_EXPIRE', '«‰ﬁ÷«¡ «·Êﬁ  «·„‰ ÂÌ');
    define('_WEBLINKS_WARN_BROKEN', '„„ﬂ‰ «·—«»ÿ ·« Ì⁄„·');

    // === 2007-02-20 ===
    // forum
    define('_WEBLINKS_LATEST_FORUM', 'Leatest Forum');
    define('_WEBLINKS_FORUM', '«·„‰ œÏ');
    define('_WEBLINKS_THREAD', 'Thead');
    define('_WEBLINKS_POST', 'Post');
    define('_WEBLINKS_FORUM_ID', '—ﬁ„ «·„‰ œÏ');
    define('_WEBLINKS_FORUM_SEL', ' ÕœÌœ «·„‰ œÏ');
    define('_WEBLINKS_COMMENT_USE', '«” ⁄„«·  ⁄·Ìﬁ xoops');

    // aux
    define('_WEBLINKS_CAT_AUX_TEXT_1', 'aux_text_1');
    define('_WEBLINKS_CAT_AUX_TEXT_2', 'aux_text_2');
    define('_WEBLINKS_CAT_AUX_INT_1', 'aux_int_1');
    define('_WEBLINKS_CAT_AUX_INT_2', 'aux_int_2');

    // captcha
    define('_WEBLINKS_CAPTCHA', 'Captcha');
    define('_WEBLINKS_CAPTCHA_DESC', 'Anti-Spam');
    define('_WEBLINKS_ERROR_CAPTCHA', 'Error: Unmtach Captcha');
    define('_WEBLINKS_ERROR', 'Error');

    // hack for multi site
    define('_WEBLINKS_CAT_TITLE_JP', 'Japanse Title');
    define('_WEBLINKS_DISABLE_FEATURE', 'Disbale this feature');
    define('_WEBLINKS_REDIRECT_JP_SITE', 'Jump to Japanese Site');

    // === 2007-03-25 ===
    define('_WEBLINKS_ALBUM_ID', '—ﬁ„ «·√·»Ê„');
    define('_WEBLINKS_ALBUM_SEL', ' ÕœÌœ «·√·»Ê„');

    // === 2007-04-08 ===
    define('_WEBLINKS_GM_TYPE', '‰Ê⁄ Œ—Ìÿ… ÃÊÃ·');
    define('_WEBLINKS_GM_TYPE_MAP', 'Œ—Ìÿ…');
    define('_WEBLINKS_GM_TYPE_SATELLITE', '” ·«Ì ');
    define('_WEBLINKS_GM_TYPE_HYBRID', 'Hybrid');

    // === 2007-08-01 ===
    define('_WEBLINKS_GM_CURRENT_ADDRESS', '«·⁄‰Ê«‰ «·Õ«·Ì');
    define('_WEBLINKS_GM_SEARCH_LIST', 'ﬁ«∆„… ‰ ÌÃ… «·»ÕÀ');

    // === 2007-09-01 ===
    // waiting list
    define('_WEBLINKS_ADMIN_WAITING_LIST', 'ﬁ«∆„… ≈‰ Ÿ«— «·√œ„‰');
    define('_WEBLINKS_USER_WAITING_LIST', 'ﬁ«∆„… ≈‰ Ÿ«—ﬂ');
    define('_WEBLINKS_USER_OWNER_LIST', 'ﬁ«∆„… „Ê«ﬁ⁄ﬂ');

    // submit form
    define('_WEBLINKS_TIME_PUBLISH_SET', 'Õœœ Êﬁ  «·‰‘—');
    define('_WEBLINKS_TIME_PUBLISH_DESC', '«–« ·„  Õœœ Êﬁ  «·‰‘— , ”Ê›  ‰‘— ⁄·Ì «·›Ê—');
    define('_WEBLINKS_TIME_EXPIRE_SET', 'Õœœ «‰ Â«¡ «·‰‘—');
    define('_WEBLINKS_TIME_EXPIRE_DESC', '«–« ·„  Õœœ «‰ Â«¡ «·‰‘— , ”Ê› ·‰  ‰ ÂÌ');
    define('_WEBLINKS_DEL_LINK_CONFIRM', ' √ﬂÌœ «·Õ–›');
    define('_WEBLINKS_DEL_LINK_REASON', '”»» «·Õ–›');

    // === 2007-11-01 ===
    define('_WEBLINKS_ERROR_LENGTH', 'Error: %s must be less than %s characters');
}// --- define language end ---
;
