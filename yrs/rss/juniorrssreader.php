<?php

// RSSアドレス設定他
$rss_url= array(
    "http://6217.teacup.com/yrs2015/bbs/rss15.xml",
);

$interval= 10; // RSSを読みにいく間隔　単位[分]
$jcode= "UTF-8"; // 掲載サイトの文字コードに合わせる
$max_text= 20; // 表示させる文字数（２連続の半角文字は１文字扱い）
$tempfile= "jrssdata.tmp";
$width= 300; // 単位[px]
$bgcolor1= "white";
$bgcolor2= "#fff0c0";


// ＲＳＳキャッシュ読み込み
$cache= array();
if (file_exists($tempfile) and $fp= fopen($tempfile, "rb")){
    while (!feof($fp)){

        $tmp= rtrim(fgets($fp));
        if (empty($tmp)) continue;
        list($atime, $rss, $sitename, $title, $link, $date)= explode("<>", $tmp, 6);
        if (array_search($rss, $rss_url) === false) continue;
        $cache[ 'ATIME'][$rss]= $atime;
        $cache[ 'RSS'][$rss]= $rss;
        $cache['SITENAME'][$rss]= $sitename;
        $cache[ 'TITLE'][$rss]= $title;
        $cache[ 'LINK'][$rss]= $link;
        $cache[ 'DATE'][$rss]= $date;
    }
    fclose($fp);
}


// ＲＳＳキャッシュ期限切れまたはキャッシュのないＲＳＳを読みに行く
$interval*= 60;
$now= time();
foreach ($rss_url as $rss){

    // キャッシュ期限内ならスキップ
    if (isset($cache['ATIME'][$rss]) && $cache['ATIME'][$rss] + $interval > $now) continue;

    // 読みに行く
    $xml= request($rss);

    // 切り分け
    list($sitename, $title, $link, $date)= _xml_parse($xml);

    // セット
    $cache[ 'ATIME'][$rss]= $now;
    $cache[ 'RSS'][$rss]= $rss;
    $cache['SITENAME'][$rss]= entity($sitename);
    $cache[ 'TITLE'][$rss]= entity($title);
    $cache[ 'LINK'][$rss]= $link;
    $cache[ 'DATE'][$rss]= $date;
}


// 表作成
$view= "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"border:1px solid black;width:{$width}px\">";
arsort($cache['DATE']);
$i= 0;
foreach ($cache['DATE'] as $rss=>$date){

    // データ取得失敗？ならスキップ
    if (empty($date)) continue;

    // 背景色を変える
    $bgcolor= ++$i % 2 ? $bgcolor2 : $bgcolor1;

    // 冗長なタイトルなら詰める
    $sitename= preg_replace("/((?:[\x81-\x9f\xe0-\xfc][\x40-\x7e\x80-\xfc]|(?:(?:&amp;|&lt;|&gt;|&nbsp;|&quot;|&#x?[a-f\d]+;|[\x09\x0a\x0d\x20-\x7e\xa1-\xdf]){1,2})){1,$max_text}).*$/i", '$1', $cache['SITENAME'][$rss]);
    if ($sitename !== $cache['SITENAME'][$rss]) $sitename.= "...";

    $view.= "<tr><td nowrap style=\"text-indent:6px;background-color:{$bgcolor};border-bottom:1px dashed black;font-size:14px;text-align:left\"><a href=\"{$cache['LINK'][$rss]}\" title=\"{$cache['TITLE'][$rss]}\" style=\"display:block;text-decoration:none\" target=\"_blank\">{$sitename}</a></td><td nowrap style=\"background-color:{$bgcolor};border-bottom:1px dashed black;font-size:12px\">(" . date("n/j G:i", $date) . ")</td></tr>";
}
$view.= "</table>";


// JavaScriptコードを返す
header("Content-Type: text/javascript");
$view= str_replace('"', '\"', mb_convert_encoding($view, jcode($jcode), "SJIS-win"));
echo <<<EOT
document.open();
document.write("{$view}");
document.close();
EOT;


// ＲＳＳキャッシュ保存
if ($fp= fopen($tempfile . ".tmp", "wb")){
    foreach ($cache['ATIME'] as $rss=>$atime)
        fputs($fp, implode('<>',
            array($atime, $rss,
            $cache['SITENAME'][$rss],
            $cache[ 'TITLE'][$rss],
            $cache[ 'LINK'][$rss],
        $cache[ 'DATE'][$rss],
        )) . "\n");
    fclose($fp) and rename($tempfile . ".tmp", $tempfile);
}


function entity($s)
{
    return strtr($s, array("<"=>"&lt;", ">"=>"&gt;", '"'=>"&quot;"));
}
function jcode($s)
{
    if (preg_match('/^utf-?8/i', $s)) return "UTF-8";
    else if (preg_match('/^(?:x-)?euc[_\-]?(?:jp)?/i', $s)) return "CP51932";
    else if (preg_match('/^(?:jis|iso-2022)/i', $s)) return "JIS";
    else return "SJIS-win";
}
function request($url)
{
    $_url= parse_url($url); empty($_url['port']) and $_url['port']= 80;
    $nl= "\x0d\x0a";
    $res= '';
    empty($_url['query']) or $_url['path'].= '?' . $_url['query'];

    if (!$fp=fsockopen($_url['host'], $_url['port'], $errno, $errstr, 10)) return '';
    $senddata= "GET {$_url['path']} HTTP/1.1{$nl}";
    $senddata.="User-Agent: RSS-READER/" . phpversion() . $nl;
    $senddata.="Host: {$_url['host']}{$nl}";
    $senddata.="Referer: http://" . $_url['host'] . $nl;
    $senddata.="Accept: */*{$nl}";
    $senddata.="Accept-Language: ja,en-us{$nl}";
    $senddata.="Content-Type: application/x-www-form-urlencoded{$nl}";
    $senddata.="Connection: close{$nl}";
    $senddata.="{$nl}";

    fputs($fp, $senddata);
    while (!feof($fp)) $res.= fgets($fp, 4096);
    fclose($fp);

    $res= mb_convert_encoding($res, "SJIS-win", "SJIS-win,UTF-8,CP51932,JIS");
    list(,$res)= explode($nl . $nl, $res, 2);

    return $res;
}
function _xml_parse($xml)
{
    if (preg_match('/<title>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/title>.*?(<item\b.*?<\/item>)/is', $xml, $match)){
        $sitename= $match[1];
        preg_match('/<title>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/title>/is', $match[2], $submatch);
        $title= $submatch[1];
        preg_match('/<link>.*?(http[^\]<"\s]+)/is', $match[2], $submatch);
        $link= $submatch[1];
        preg_match('/(?:<dc:date>|<pubDate>)(.*?)</is', $match[2], $submatch);
        $date= strtotime($submatch[1]);
    } else if (preg_match('/<title>(.*?)<\/title>.*?(<entry\b.*?<\/entry>)/is', $xml, $match)){
        $sitename= $match[1];
        preg_match('/<title>(.*?)<\/title>/is', $match[2], $submatch);
        $title= $submatch[1];
        preg_match('/<link\b[^>]*?href="?(http[^"\s>]+)/is', $match[2], $submatch);
        $link= $submatch[1];
        preg_match('/(?:<modified>|<updated>)(.*?)</is', $match[2], $submatch);
        $date= strtotime($submatch[1]);
    } else return array();

    return array($sitename, $title, $link, $date);
}


?>
