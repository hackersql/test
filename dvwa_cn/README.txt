=安信华Web弱点测试系统=

安信华Web弱点演示系统基于知名WEB弱点测试系统DVWA1.0.7，由独自等待汉化，ay暗影提供软件封装，在原版的基础上增加了不安全的验证码及webservice命令执行功能，修正了原版程序中的部分错误，并且提供了低安全级别下的各个项目的测试方法，希望能为web安全初学者提供一点帮助；相对于更加知名的WebGoat，我们认为dvwa更便于初学者学习，为了国内的web安全测试人员学习方便，我们已经利用业余时间对界面进行汉化，汉化界面达到95%以上，部分未汉化的部分不影响使用，由于是个人完成，可能部分汉化不理想，大家可以给我反馈。邮箱：xliang@vip.qq.com 网站：http://www.waitalone.cn/

==警告!==

安信华Web弱点演示系统是为了安全测试使用，因此包含很多严重的Web安全漏洞，请勿将代码上传到你的web虚拟主机上面对外公开，否则你的网站将会受到恶意攻击者的入侵，我们将不对此负责。 建议您下载 XAMPP 然后安装在本机供局域网用户使用。 此汉化版本已经由ay暗影使用工具封装，安装完成即可使用。

==授权==

本系统由安信华提供，您可以永久免费使用，未经安信华科技同意，请勿用于商业用途。


==安装方法==

默认用户名 = admin

默认密码 = password

安装视频: 暂未提供

本系统基于PHP/MySQL构建，请自行搭建PHP环境，由于部分弱点演示需要较高权限，请使用wampserver,phpnow或者xampp套件安装测试环境，如需要使用IIS+MySQL请将单独新建一管理员用户，并更改IIS运行用户为此管理员。

安装好配置环境以后，请将dvwa.zip解压到web目录下面，然后使用浏览器打开http://127.0.0.1/dvwa/index.php即可访问

==数据库安装==

默认情况下系统未导入数据库，请单击主菜单左边的安装按键，然后点击创建/重置数据库按键，程序会自动导入数据到数据库中。

如果程序报错，请确认/config/config.inc.php中的设置是否正确。

默认情况下程序设置如下： root密码为空，请更改为自己正确的root密码。

{{{
$_DVWA[ 'db_user' ] = 'root';

$_DVWA[ 'db_password' ] = '';

$_DVWA[ 'db_database' ] = 'dvwa';
}}}

==问题反馈==

如果使用过程中遇到问题，请咨询安信华工程师，我们会尽快帮你解决。

+Q. 我使用的是php 5.2.6, SQL注入测试无效，如何解决？

-A. 请更改如下配置解决注入及其它弱点无法使用的问题.

更改 .htaccess:

	把下面的设置:

	{{{
    <IfModule mod_php5.c>
	php_flag magic_quotes_gpc off
	#php_flag allow_url_fopen on
	#php_flag allow_url_include on
	</IfModule>
        }}}

	替换为:

	{{{
    <IfModule mod_php5.c>
	magic_quotes_gpc = Off
	allow_url_fopen = On
	allow_url_include = On
	</IfModule>
    }}}

+Q. 代码执行无法工作？

-A. 你的Apache或者IIS未以最高权限运行，如果你使用linux配置请使用root权限运行apache，如果你使用IIS运行，请更改运行用户为administrator即可。

+Q. 我的XSS攻击载荷无法在IE中使用？

-A. 如果你使用IE8或者是更高版本的IE，请在IE选项中禁用XSS筛选器。

==链接==

安信华科技: http://www.anchiva.com/

独自等待博客：http://www.waitalone.cn/

ay暗影博客: http://www.ayhacker.net/
