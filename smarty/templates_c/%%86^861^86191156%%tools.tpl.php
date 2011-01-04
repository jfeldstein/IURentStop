<?php /* Smarty version 2.6.18, created on 2009-03-17 14:10:45
         compiled from tools.tpl */ ?>
	<table  class="spaceTable" cellspacing=0>
		<thead>
			<td colspan="2">Promotional Tools</td>
		</thead>
	<tr onclick="document.location='setup_tool.php?tool=google';">
		<td>
			<?php if ($this->_tpl_vars['user']['tools']['google']): ?>
				<div style="color: green; font-weight: bold;">Enabled</div>
			<?php else: ?>
				<div style="color: red; font-weight: bold;">Disabled</div>
			<?php endif; ?>
		</td>
		<td><a href="setup_tool.php?tool=google">Publish</a> to Google rental search</td>
	</tr>
	<tr onclick="document.location='setup_tool.php?tool=facebook';">
		<td>
			<?php if ($this->_tpl_vars['user']['tools']['facebook']): ?>
				<div style="color: green; font-weight: bold;">Enabled</div>
			<?php else: ?>
				<div style="color: red; font-weight: bold;">Disabled</div>
			<?php endif; ?>
		</td>
		<td><a href="setup_tool.php?tool=facebook">List</a> directly in the Facebook Marketplace</td>
	</tr>
	</table>