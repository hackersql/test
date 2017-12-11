<?php  ?>
<div class="page-title">Installation</div><br /><br />
<ol>
	<li><u><font color="#FF0000">Do NOT&nbsp; run this code on a production network</font></u>. Either run it on a 
	private network, or restrict your web server software to only use the local 
	loopback address. By default Mutillidae only allows access from localhost 
	(127.*.*.*). Edit the .htaccess file to change this behavior (not recommended on a public network). 
	If for some reason .htaccess is not parsed you can 
	restrict the IP by finding the &quot;Listen&quot; line in the http.conf file and changing 
	it to read: <font color="#008080">Listen 127.0.0.1:80</font>
	</li>
</ol>

<p style="white-space: pre;">
	<span style="font-weight: bold;">Options to run Mutillidae</span>
	
		<span style="font-weight: bold;">a.	Samurai Web Testing Framework</span>
		
			i.	Samurai WTF 0.95 is a Linux “Live” DVD to which the users machine boots. 
			Within Samurai is several vulnerable web applications pre-configured to test for 
			vulnerabilities. One of the available applications is Mutillidae version 1. 
			Samurai is preparing to release version 1.0 which will include Mutillidae 2.x .
		
		<span style="font-weight: bold;">b.	XAMPP (Windows , Linux , Mac OS X )</span>
		
			i.	XAMPP is a single installation package which bundles Apache web server, 
				PHP application server, and MySQL database. XAMPP installs Apache and 
				MySQL as either executable or services and can optionally start these 
				services automatically. XAMPP provides an “htdocs” directory. The 
				Mutillidae package can be unzipped into htdocs to install Mutillidae. 
				Assuming Apache and MySQL are running, the user can open a browser and 
				immediately begin using Mutillidae at http://localhost/mutillidae. 

			ii.	Download XAMPP Lite for Windows or Linux

			iii.	Download Mutillidae

			iv.	Unzip Mutillidae. Note the mutillidae project is in a folder called “mutillidae”

			v.	Place the entire “mutillidae” directory into XAMPP’s “ htdocs” directory

			vi.	Browse to mutillidae at http://localhost/mutillidae

			vii.	Click the "Setup/reset the DB" link in the main menu.

			viii.	Get rid of PHP "strict" errors. They are not compatible with the OWASP ESAPI 
			classes in use in Mutillidae 2.0. The error modifies headers disrupting functionality 
			so this is not simply an annoyance issue. To do this, go to the PHP.INI file  and change the line that reads 
			"error_reporting = E_ALL | E_STRICT" to "error_reporting = E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECIATED". 
			Once the modification is complete, restart the Apache service. If you are not sure how to restart 
			the service, reboot.
			
			Important note: If you use XAMPP Lite or various version of XAMPP on various operating systems, the path for your 
			php.ini file may vary. You may even have multiple php.ini files in which case try to modify the one in the Apache
			directory first, then the one in the PHP file if that doesnt do the trick.
			
			Windows possible default location C:\xampp\php\php.ini, C:\XamppLite\PHP\php.ini, others
			Linux possible default locations: /XamppLite/PHP/php.ini, /XamppLite/apache/bin/php.ini, others 
			
			ix.	By default, Mutillidae tries to connect to MySQL on the localhost with the username 
			"root" and a blank password. To change this, edit "config.inc" with the correct 
			information for your environment.

			x.	NOTE: Once PHP 6.0 arrives in XAMPP, E_ALL will include E_STRICT so the line 
			to change will probably read "error_reporting = E_ALL". In any case, change 
			the error_reporting line to 
			"error_reporting = E_ALL & ~E_NOTICE & ~E_DEPRECIATED".
		
		<span style="font-weight: bold;">c.	Custom Linux ISO</span>
		
			i.	Using the Samurai Web Testing Framework as the base operating system, any version of Mutillidae 
			can be installed in addition to the version which comes standard with Samurai. From this custom set-up, 
			a custom ISO can be generated using the Remastersys  package.
		
			With Samurai 0.95, Mutillidae is installed into the /srv/mutillidae directory. To install different 
			versions of Mutillidae and make a custom Linux ISO, the following recipe can be followed:
		
				1.	Locate the default installation of Mutillidae in the /srv/mutillidae directory.
				2.	Rename the current installation. For example rename the “mutillidae” folder to “mutillidae-1.5”.
				3.	Download the latest version from www.irongeek.com
				4.	Unzip the “mutillidae” folder from the latest version to the /srv directory.
				5.	Test that mutillidae is updated by browsing to http://localhost/mutillidae
				6.	Test that the original version of mutillidae still works browsing to http://localhost/mutillidae-1.5 
				7.	Make any changes to Linux, Firefox, or other software desired. For example, the lab environment 
					created for the U of L information security course used an updated version of Firefox with several add-ons.
				8.	Ensure the current Remastersys installation is clean by running the command “sudo remastersys clean”
				9.	When ready to create the new ISO, run the command “sudo remastersys backup”
				10.	The custom ISO will be found in the /home/remastersys/remastersys directory
			
		<span style="font-weight: bold;">d.	Virtual Machine</span>
		
			i.	Mutillidae has been tested in a Virtual Box  and VMware Workstation  virtual machines running 
			Windows XP SP3 and Ubuntu. Additionally, Virtual Box virtual machines have been booted from the 
			Samurai 0.95 WTF DVD and the Samurai 0.95/Mutillidae 2.x Custom ISO. The Windows XP SP3 
			installation ran Mutillidae 2.x in the XAMPP environment. The Ubuntu installation was 
			created by installing the Samurai 0.95 WTF to a Linux virtual machine. Basically any of the 
			previously mentioned installation options work equally well in virtual environments.
</p>