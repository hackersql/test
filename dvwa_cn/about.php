<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '' );
require_once DVWA_WEB_PAGE_TO_ROOT.'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'About';
$page[ 'page_id' ] = 'about';

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>����</h1>

	<p>
	���Ż�Web������ʾϵͳ ".dvwaVersionGet()." (����ʱ��: ".dvwaReleaseDateGet().") </p>
	
	<p>���Ż�Web������ʾϵͳ��Ҫ���ڰ��Ż��ͻ��о�����ʹ�ã�����������ҵ��;��</p>
	<p>�������Ż��Ƽ����޹�˾��Anchiva Systems Ltd.,��������2006�꣬��һ�������缰���ݰ�ȫ����ӵ���������²�Ʒ�ĸ��¼�����ҵ����˾�㼯�˴������簲ȫ����������˲ţ������˺͸߹�������˼�ơ�Netscreen�������š����������ȹ�����������ȫ�豸�����е�����Ҫְ�񡣹�˾����ͨ�����밲ȫ����վ��ȫ��������Ϊ�����Ϳͻ��ṩ������Internet���ݡ��ܲ������ڱ�������������ȫʵ����λ�ں��ݣ����ڹ��ݡ��Ϻ������ݡ��Ͼ���֣�����а��´�����Ʒ������鼰������������</p>

	<h2>����</h2>

	<ul>
		<li>���Ż�: ".dvwaExternalLinkUrlGet( 'http://www.anchiva.com/' )."</li><br />
	</ul>

	<h2>��������</h2>

	<ul>
		<li>���Ż�: ".dvwaExternalLinkUrlGet( 'http://www.anchiva.com/' )."</li><br />
		<li>���Եȴ�: ".dvwaExternalLinkUrlGet( 'http://www.waitalone.cn/' )."</li><br />
		<li>ay��Ӱ: ".dvwaExternalLinkUrlGet( 'http://www.ayhacker.net/' )."</li><br />
		<li>PHPIDS - Copyright (c) 2007 ".dvwaExternalLinkUrlGet( 'http://php-ids.org/', 'PHPIDS group' )."</li>
	</ul>

	<h2>��ȨЭ��</h2>

	<p>���Ż�Web������ʾϵͳ��Ҫ���ڰ��Ż��ͻ��о�����ʹ�ã�����������ҵ��;��</p>

	<p>������ʹ��PHP_IDS <a href=\"".DVWA_WEB_PAGE_TO_ROOT."instructions.php?doc=PHPIDS-license\">����鿴</a> ������</p>


</div>
";


dvwaHtmlEcho( $page );
exit;

?>
