<?php /* Smarty version 2.6.18, created on 2009-03-12 00:29:51
         compiled from popup.tpl */ ?>
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
            <div id="body">
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