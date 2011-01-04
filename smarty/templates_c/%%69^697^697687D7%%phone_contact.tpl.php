<?php /* Smarty version 2.6.18, created on 2010-06-06 18:49:20
         compiled from phone_contact.tpl */ ?>
<table>
	<tr><td style="font-weight:bold; font-size: 120%;" width=80>Call:</td><td><?php echo $this->_tpl_vars['properphone']; ?>
</td></tr>
	<?php if ($this->_tpl_vars['owner']['first_name'] != ''): ?><tr><td style="font-weight:bold; font-size: 120%;">Ask For:</td><td><?php echo $this->_tpl_vars['owner']['full_name']; ?>
</td></tr><?php endif; ?>
	<tr><td colspan=2 style="font-weight:bold; font-size: 120%;">Tell them:</td></tr>
	<tr><td colspan=2>
		<blockquote style="line-height: 15pt;">
			<?php if ($this->_tpl_vars['location']['type'] == 'house'): ?>
				<div style="">
					I saw you have a house
					at <span style='white-space:nowrap; font-weight:bold;'>'<?php echo $this->_tpl_vars['location']['address']; ?>
'</span> listed on <b>IURentStop.com</b>.
					I'd like to know more about it, and maybe see it.
				</div>
			<?php else: ?>
				<div style="">
					I saw your <?php echo $this->_tpl_vars['space']['br_string']; ?>
 apartment 
					
					at <span style='white-space:nowrap; font-weight:bold;'>'<?php echo $this->_tpl_vars['location']['address']; ?>
' </span>
					
					listed on <b>IURentStop.com</b>. I'd like to know more about it, and maybe see it.
				</div>
			<?php endif; ?>
		</blockquote>
	</td></tr>
</table>