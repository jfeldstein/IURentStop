{if $form.ajax!=''}
{$body}
{else}

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/2001/REC-xhtml11-20010531/DTD/xhtml11-flat.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Language" content="en-gb" />
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
        <link rel="stylesheet" type="text/css" href="style.css" />
		<script src="js/prototype.js" language="javascript"></script> 
		<script src="js/custom.js" language="javascript"></script>
		<script src="js/scriptaculous.js" language="javascript"></script>

        <title>IURentStop{if $pageTitle} - {$pageTitle}{/if}</title>

    </head>
    <body>
    
        <div id="content">
			
            <div id="header">
            <div id="search">
					
				{if $logged_in_as!=''}
					<a href="search.php">Search</a>
					<a href="search.php"><img src="images/zoom.jpg" alt="Search" title="Search" /></a> - 
					<a href="logout.php" onclick="return confirm('Are you sure you want to log out?');">Log Out</a> - 
					<a href="help.php">Help</a>
					<br>Logged in as <a href="editaccount.php"><i>{$logged_in_as}</i>Account</a>
				{else}
					<a href="search.php">Search</a>
					<a href="search.php"><img src="images/zoom.jpg" alt="Search" title="Search" /></a> - 
					<a href="login.php"> Login</a> - 
					<a href="help.php">Help</a>
					
				{/if}
					
	            </div>
	            <h1><a href="./">IURentStop</a></h1>
	            <p>One Stop Spot for Renting in Bloomington</p>
            </div>
			
            <div id="body">
	                {if $logged_in_as!=''}
						{include file='member_nav.tpl'}
					{/if}
					
					{if 0}
						<div style="position: absolute; top: 120px; left: 20px;filter:alpha(opacity=60);-moz-opacity:.60;opacity:.60;">
						<script type="text/javascript"><!--
						google_ad_client = "pub-9976860813408214";
						/* Tall IURS */
						google_ad_slot = "1059934482";
						google_ad_width = 120;
						google_ad_height = 600;
						//-->
						</script>
						<script type="text/javascript"
						src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
						</script>
						</div>
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
        </div>
		
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-6206513-1");
pageTracker._trackPageview();
</script>
		
		<!-- <script src="js/lightbox.js" language="javascript"></script> -->
    </body>
</html>

{/if}