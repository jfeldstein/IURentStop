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
            <div id="body">
					{foreach from=$messages item=message name=msg_loop}
						{if $smarty.foreach.msg_loop.first}<div class="message"><ul>{/if}
							<li>{$message}</li>
						{if $smarty.foreach.msg_loop.last}</div></ul>{/if}
					{/foreach}
                    {$body}
            </div>
		<script type="text/javascript">
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
		</script>
		<script type="text/javascript">
		var pageTracker = _gat._getTracker("UA-251852-5");
		pageTracker._initData();
		pageTracker._trackPageview();
		</script>
    </body>
</html>