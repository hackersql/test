<?php
$url=dvwaGetCurrentUrl();
$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>©��: �ļ�����</h1>

	<div class=\"vulnerable_code_area\">

		��༭?page=include.php�е���ز������鿴�ĸ��ļ��������ˡ�

	</div>
	<h3><font color=\"red\">���Է�����</font></h3>
	<font color=\"blue\">������\"Cannot modify header ����\"��������php.ini�а�output_buffering����ΪOn������apache���ɡ�</font><br /><br />
���磺��վ��Ŀ¼�µ�<a href={$url}../../phpinfo.php>phpinfo.php</a>�ļ�<br /><br />
<div class=\"vulnerable_code_area\">
{$url}?page=../../phpinfo.php

<a href=\"{$url}?page=../../phpinfo.php\"><font color=\"blue\">����鿴Ч��</font></a><br />

</div>
���磺<a href={$url}../../include.txt>include.txt</a><br /><br />
<div class=\"vulnerable_code_area\">
{$url}?page=../../include.txt

<a href=\"{$url}?page=../../include.txt\"><font color=\"blue\">����鿴Ч��</font></a>

</div>
<br /><br />
	<h2>������Ϣ</h2>
	<ul>
		<li>".dvwaExternalLinkUrlGet( 'http://en.wikipedia.org/wiki/Remote_File_Inclusion')."</li>
		<li>".dvwaExternalLinkUrlGet( 'http://www.owasp.org/index.php/Top_10_2007-A3')."</li>
	</ul>
</div>
";

?>
