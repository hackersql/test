<?php
$url=dvwaGetCurrentUrl();
$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>漏洞: 文件包含</h1>

	<div class=\"vulnerable_code_area\">

		请编辑?page=include.php中的相关参数，查看哪个文件被包含了。

	</div>
	<h3><font color=\"red\">测试方法：</font></h3>
	<font color=\"blue\">若出现\"Cannot modify header ……\"错误，请在php.ini中把output_buffering设置为On，重启apache即可。</font><br /><br />
比如：网站根目录下的<a href={$url}../../phpinfo.php>phpinfo.php</a>文件<br /><br />
<div class=\"vulnerable_code_area\">
{$url}?page=../../phpinfo.php

<a href=\"{$url}?page=../../phpinfo.php\"><font color=\"blue\">点击查看效果</font></a><br />

</div>
比如：<a href={$url}../../include.txt>include.txt</a><br /><br />
<div class=\"vulnerable_code_area\">
{$url}?page=../../include.txt

<a href=\"{$url}?page=../../include.txt\"><font color=\"blue\">点击查看效果</font></a>

</div>
<br /><br />
	<h2>更多信息</h2>
	<ul>
		<li>".dvwaExternalLinkUrlGet( 'http://en.wikipedia.org/wiki/Remote_File_Inclusion')."</li>
		<li>".dvwaExternalLinkUrlGet( 'http://www.owasp.org/index.php/Top_10_2007-A3')."</li>
	</ul>
</div>
";

?>
