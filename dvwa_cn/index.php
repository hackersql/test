<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '' );

require_once DVWA_WEB_PAGE_TO_ROOT.'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();

$page[ 'title' ] .= $page[ 'title_separator' ].'��ӭʹ��!';

$page[ 'page_id' ] = 'home';

$page[ 'body' ] .= "

<div class=\"body_padded\">

<h1>��ӭʹ�ð��Ż�Web�������ϵͳ-2013</h1>

<p>���Ż�Web������ʾϵͳ�ǻ���PHP/MySQL��������װ���㣬����ά��������ҪĿ����Ϊ��ȫר���ṩһ��web���Ի����������������ǵļ����Լ�����ʹ��ˮƽ��ͬʱ����Web������Ա���õ����web�������̣�ʹ�����ڿ����о������������Щ©����</p>

<h2> ����! </h2>

<p>���Ż�Web������ʾϵͳ��Ϊ�˰�ȫ����ʹ�ã���˰����ܶ����ص�Web��ȫ©�������𽫴����ϴ������web��������������⹫�������������վ�����ܵ����⹥���ĵ����֣����ǽ����Դ˳е��κ����Ρ� ���������� ".dvwaExternalLinkUrlGet( 'http://www.apachefriends.org/en/xampp.html','XAMPP' )." Ȼ��װ�ڱ������������û�ʹ�á��˺����汾�Ѿ���<a href=\"http://www.ayhacker.net\" target=\"_blank\">ay��Ӱ</a>ʹ�ù��߷�װ����װ��ɼ���ʹ�á�</p>
<br />
<br />
<h2> ˵�� </h2>

<p>�����Ե��ÿ��©�����½ǵİ������鿴Դ���밴ť����ȡ������</p>
<p>Ϊ�����Ҳ��ԣ�������ƽ̨Ĭ�ϰ�ȫ��������Ϊ�ͣ������Ѿ��ṩ��ÿ����Ŀ�Ĳ��Է�����(��<a href=\"http://www.waitaloen.cn\" target=\"_blank\">���Եȴ�</a>��<a href=\"http://www.ayhacker.net\" target=\"_blank\">ay��Ӱ</a>�����ṩ)�����ṩ�˰�ȫ����Ϊ�͵Ĳ��Է������м����߼������Լ��о����߿������ĵ��������������ڶ��Եȴ�������ay��Ӱ�������ԡ�</p>
<br />
<br />
<h2> ����֧�֣�</h2>

<a href=\"http://www.anchiva.com/\" target=\"_blank\"><font color=\"red\" size=3>���Ż��Ƽ�</font></a><br /><br />

<a href=\"http://www.waitalone.cn/\" target=\"_blank\"><font color=\"blue\" size=3>���Եȴ�����</font></a><br /><br />

<a href=\"http://www.ayhacker.net/\" target=\"_blank\"><font color=\"green\" size=3>ay��Ӱ����</font></a><br /><br />

</div>";


dvwaHtmlEcho( $page );

?>
