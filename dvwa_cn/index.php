<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '' );

require_once DVWA_WEB_PAGE_TO_ROOT.'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();

$page[ 'title' ] .= $page[ 'title_separator' ].'欢迎使用!';

$page[ 'page_id' ] = 'home';

$page[ 'body' ] .= "

<div class=\"body_padded\">

<h1>欢迎使用安信华Web弱点测试系统-2013</h1>

<p>安信华Web弱点演示系统是基于PHP/MySQL构建，安装方便，易于维护，其主要目标是为安全专家提供一个web测试环境，用来测试他们的技术以及工具使用水平，同时帮助Web开发人员更好的理解web攻击流程，使其能在开发中尽量避免出现这些漏洞。</p>

<h2> 警告! </h2>

<p>安信华Web弱点演示系统是为了安全测试使用，因此包含很多严重的Web安全漏洞，请勿将代码上传到你的web虚拟主机上面对外公开，否则你的网站将会受到恶意攻击的的入侵，我们将不对此承担任何责任。 建议您下载 ".dvwaExternalLinkUrlGet( 'http://www.apachefriends.org/en/xampp.html','XAMPP' )." 然后安装在本机供局域网用户使用。此汉化版本已经由<a href=\"http://www.ayhacker.net\" target=\"_blank\">ay暗影</a>使用工具封装，安装完成即可使用。</p>
<br />
<br />
<h2> 说明 </h2>

<p>您可以点击每个漏洞右下角的帮助及查看源代码按钮来获取帮助。</p>
<p>为方便大家测试，本测试平台默认安全级别设置为低，并且已经提供了每个项目的测试方法，(由<a href=\"http://www.waitaloen.cn\" target=\"_blank\">独自等待</a>及<a href=\"http://www.ayhacker.net\" target=\"_blank\">ay暗影</a>联合提供)，仅提供了安全级别为低的测试方法，中级及高级请大家自己研究或者看帮助文档，如有问题请在独自等待或者是ay暗影博客留言。</p>
<br />
<br />
<h2> 技术支持：</h2>

<a href=\"http://www.anchiva.com/\" target=\"_blank\"><font color=\"red\" size=3>安信华科技</font></a><br /><br />

<a href=\"http://www.waitalone.cn/\" target=\"_blank\"><font color=\"blue\" size=3>独自等待博客</font></a><br /><br />

<a href=\"http://www.ayhacker.net/\" target=\"_blank\"><font color=\"green\" size=3>ay暗影博客</font></a><br /><br />

</div>";


dvwaHtmlEcho( $page );

?>
