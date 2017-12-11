<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '' );
require_once DVWA_WEB_PAGE_TO_ROOT.'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'About';
$page[ 'page_id' ] = 'about';

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>关于</h1>

	<p>
	安信华Web弱点演示系统 ".dvwaVersionGet()." (发布时间: ".dvwaReleaseDateGet().") </p>
	
	<p>安信华Web弱点演示系统主要用于安信华客户研究测试使用，请勿用于商业用途。</p>
	<p>北京安信华科技有限公司（Anchiva Systems Ltd.,）成立于2006年，是一家在网络及内容安全领域拥有自主创新产品的高新技术企业，公司汇集了大批网络安全领域的优秀人才，创办人和高管曾经在思科、Netscreen、天融信、联想网御等国内外著名安全设备厂商中担任重要职务。公司致力通过接入安全与网站安全两个领域为各类型客户提供更清洁的Internet内容。总部现设在北京，互联网安全实验室位于杭州，并在广州、上海、杭州、南京、郑州设有办事处，产品及服务遍及国内外多个区域。</p>

	<h2>链接</h2>

	<ul>
		<li>安信华: ".dvwaExternalLinkUrlGet( 'http://www.anchiva.com/' )."</li><br />
	</ul>

	<h2>程序制作</h2>

	<ul>
		<li>安信华: ".dvwaExternalLinkUrlGet( 'http://www.anchiva.com/' )."</li><br />
		<li>独自等待: ".dvwaExternalLinkUrlGet( 'http://www.waitalone.cn/' )."</li><br />
		<li>ay暗影: ".dvwaExternalLinkUrlGet( 'http://www.ayhacker.net/' )."</li><br />
		<li>PHPIDS - Copyright (c) 2007 ".dvwaExternalLinkUrlGet( 'http://php-ids.org/', 'PHPIDS group' )."</li>
	</ul>

	<h2>授权协议</h2>

	<p>安信华Web弱点演示系统主要用于安信华客户研究测试使用，请勿用于商业用途。</p>

	<p>本程序使用PHP_IDS <a href=\"".DVWA_WEB_PAGE_TO_ROOT."instructions.php?doc=PHPIDS-license\">点击查看</a> 保护。</p>


</div>
";


dvwaHtmlEcho( $page );
exit;

?>
