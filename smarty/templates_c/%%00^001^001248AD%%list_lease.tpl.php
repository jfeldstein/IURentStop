<?php /* Smarty version 2.6.18, created on 2009-03-12 00:49:52
         compiled from list_lease.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_radios', 'list_lease.tpl', 53, false),array('function', 'html_options', 'list_lease.tpl', 58, false),)), $this); ?>
		
		<form id="add_form" action="addlisting.php" >
		
		<table style="vertical-align: top; width: 330px;">
		<thead><td colspan="2">List an Available Lease:</td></thead>
		<tr>
			<td>
				<label for="space_bedrooms">Bedrooms:</label>
			</td>
			<td>
				<input type="text" name="space_bedrooms" onkeypress="return numbersonly(this, event);" size="4" value="<?php echo $this->_tpl_vars['form']['space_bedrooms']; ?>
">
			</td>
		</tr>
		<tr>
			<td>
				<label for="space_bathrooms">Bathrooms:</label>
			</td>
			<td>
				<input type="text" name="space_bathrooms" onkeypress="return numbersonly(this, event, true);" size="4" value="<?php echo $this->_tpl_vars['form']['space_bathrooms']; ?>
">
			</td>
		</tr>
		<tr>
			<td valign="top">
				<label>Rent:</label><br>
				<div style="font-size:80%;">(per lease)</div>
			</td>
			<td>
				
				<input type="text" name="space_rent" value="<?php echo $this->_tpl_vars['form']['space_rent']; ?>
" id="space_rent" class="money" onkeypress="return numbersonly(this, event);" size="5">
				
			</td>
		</tr>
		<tr>
			<td valign="top">
				<label>
					Address
				</label>
			</td>
			<td>
				<input type="text" name="location_address" id="location_address" size="30"  value="<?php echo $this->_tpl_vars['form']['location_address']; ?>
"> <br>
				
				Bloomington, IN
				
			</td>
		</tr>
		<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
		
		<tr><td colspan="2">
			
			<table width="100%">
			<tr>
			<td>Show this unit to students now</td>
			<td><?php echo smarty_function_html_radios(array('name' => 'space_available','options' => $this->_tpl_vars['yes_no_options'],'selected' => '1','separator' => "&nbsp;"), $this);?>
</td>
			</tr>
			<tr>
			<td>The building at this address is a: </td>
			<td>
					<?php echo smarty_function_html_options(array('name' => 'location_type','options' => $this->_tpl_vars['house_or_apartment'],'selected' => $this->_tpl_vars['form']['location_type'],'separator' => "&nbsp;"), $this);?>


			</td>
			</tr>
			</table>
			
		</td></tr>
		
		<?php if ($this->_tpl_vars['user']['email'] == '' && $this->_tpl_vars['form']['save'] == 'Add It'): ?>	
		</table>	
		
		<br>
		<table>
			<thead><td colspan=2>Account Information</td></thead>
			<tr><td>Email Address</td><td><input type="text" name="email" value="<?php echo $this->_tpl_vars['email']; ?>
"></td></tr>
			<tr><td>Password</td><td><input type="password" name="pass" value=""></td></tr>
			<tr><td colspan="2">&nbsp;</td></tr>
			<tr><td colspan="2"><i>If creating a new account...</i></td></tr>
			<tr><td>Confirm Password</td><td><input type="password" name="confirm_pass" value=""></td></tr>
			<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
			<tr><td></td><td>
			<input type="hidden" value="Add It" name="save">
			<input type="submit" value="Create Account & Add Lease" name="save_w_new_account"></td></tr>
		</table>
		
		<?php else: ?>
			
			<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
			<tr><td></td><td>
			<input type="submit" value="Add It" name="save"></td></tr>
		</table>
		
		<?php endif; ?>
		
				
		
		</form>