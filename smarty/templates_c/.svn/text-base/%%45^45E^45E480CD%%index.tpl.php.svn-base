<?php /* Smarty version 2.6.18, created on 2009-04-15 17:35:53
         compiled from index.tpl */ ?>
<?php if ($this->_tpl_vars['form']['ajax'] != ''): ?>
<?php echo $this->_tpl_vars['body']; ?>

<?php else: ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/2001/REC-xhtml11-20010531/DTD/xhtml11-flat.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Language" content="en-gb" />
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
        <link rel="stylesheet" type="text/css" href="style.css" />
		<script src="js/prototype.js" language="javascript"></script> 
		<script src="js/custom.js" language="javascript"></script>
		<script src="js/scriptaculous.js" language="javascript"></script>

        <title>IURentStop<?php if ($this->_tpl_vars['pageTitle']): ?> - <?php echo $this->_tpl_vars['pageTitle']; ?>
<?php endif; ?></title>

    </head>
    <body>
    
        <div id="content">
			
            <div id="header">
            <div id="search">
					
				<?php if ($this->_tpl_vars['logged_in_as'] != ''): ?>
					<a href="search.php">Search</a>
					<a href="search.php"><img src="images/zoom.jpg" alt="Search" title="Search" /></a> - 
					<a href="logout.php" onclick="return confirm('Are you sure you want to log out?');">Log Out</a> - 
					<a href="help.php">Help</a>
					<br>Logged in as <a href="editaccount.php"><i><?php echo $this->_tpl_vars['logged_in_as']; ?>
</i>Account</a>
				<?php else: ?>
					<a href="search.php">Search</a>
					<a href="search.php"><img src="images/zoom.jpg" alt="Search" title="Search" /></a> - 
					<a href="login.php"> Login</a> - 
					<a href="help.php">Help</a>
					
				<?php endif; ?>
					
	            </div>
	            <h1><a href="./">IURentStop</a></h1>
	            <p>One Stop Spot for Renting in Bloomington</p>
            </div>
			
            <div id="body">
	                <?php if ($this->_tpl_vars['logged_in_as'] != ''): ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'member_nav.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php endif; ?>
					
					<?php if (0): ?>
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
					<?php endif; ?>
					
                <div id="main">
					<?php $_from = $this->_tpl_vars['messages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['msg_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['msg_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['message']):
        $this->_foreach['msg_loop']['iteration']++;
?>
						<?php if (($this->_foreach['msg_loop']['iteration'] <= 1)): ?><div class="message"><ul><?php endif; ?>
							<li><?php echo $this->_tpl_vars['message']; ?>
</li>
						<?php if (($this->_foreach['msg_loop']['iteration'] == $this->_foreach['msg_loop']['total'])): ?></div></ul><?php endif; ?>
					<?php endforeach; endif; unset($_from); ?>
                    
					<?php echo $this->_tpl_vars['body']; ?>

					
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

<?php endif; ?>