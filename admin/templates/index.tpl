<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/2001/REC-xhtml11-20010531/DTD/xhtml11-flat.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Language" content="en-gb" />
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
        <link rel="stylesheet" type="text/css" href="style.css" />
		<script src="js/prototype.js" language="javascript"></script> 
		<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key={$google_key}" type="text/javascript"></script>
		<script src="js/custom.js" language="javascript"></script> 
		<script src="js/scriptaculous.js" language="javascript"></script>

        <title>IURentStop{if $pageTitle} - {$pageTitle}{/if}</title>

    	<script type="text/javascript">
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
		</script>	
		<script type="text/javascript">
		var pageTracker = _gat._getTracker("UA-251852-5");
		pageTracker._initData();
		pageTracker._trackPageview();
		</script>
    </head>
    <body  onunload="GUnload()">
    
        <div id="content">
			
            <div id="header">
            <div id="search">
					
				{if $logged_in_as!=''}
					<a href="search.php">Search</a>
					<a href="search.php"><img src="images/zoom.jpg" alt="Search" title="Search" /></a> - 
					<a href="welcome.php">Manage</a> - 
					<a href="logout.php" onclick="return confirm('Are you sure you want to log out?');">Log Out</a>
					<br>Logged in as <i>{$logged_in_as}</i>
				{else}
					<a href="search.php">Search</a>
					<a href="search.php"><img src="images/zoom.jpg" alt="Search" title="Search" /></a> - 
					<a href="welcome.php">Owners</a>
				{/if}
					
            </div>
                <h1><a href="./">IURentStop</a></h1>
                <p>One Stop Spot for Renting in Bloomington</p>
            </div>
			
            <div id="body">
				{if $show_nav}
	                {if $logged_in_as!=''}
						{include file='member_nav.tpl'}
					{else}
						{include file='guest_nav.tpl'}
					{/if}
				{/if}
                <div id="main">
					{foreach from=$messages item=message name=msg_loop}
						{if $smarty.foreach.msg_loop.first}<div class="message"><ul>{/if}
							<li>{$message}</li>
						{if $smarty.foreach.msg_loop.last}</div></ul>{/if}
					{/foreach}
                    {$body}
                </div>
            </div>
            <div id="footer">
                <a href="about.php">About</a> - 
				<a href="mailto:jordan@iurentstop.com">Contact</a> - 
				Copyright © 2008 Jordan Feldstein.
            </div>
        </div>
    </body>

</html>