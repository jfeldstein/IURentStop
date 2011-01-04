<?php /* Smarty version 2.6.18, created on 2009-03-12 00:49:12
         compiled from addlisting_choose_type.tpl */ ?>
<form action="addlisting.php">

<input type="hidden" name="space_bedrooms" value="<?php echo $this->_tpl_vars['form']['space_bedrooms']; ?>
">
<input type="hidden" name="space_bathrooms" value="<?php echo $this->_tpl_vars['form']['space_bathrooms']; ?>
">
<input type="hidden" name="space_rent" value="<?php echo $this->_tpl_vars['form']['space_rent']; ?>
">
<input type="hidden" name="location_address" value="<?php echo $this->_tpl_vars['form']['location_address']; ?>
">
<input type="hidden" name="save" value="<?php echo $this->_tpl_vars['form']['save']; ?>
">


<table class=displayTable cellspacing=0>
<thead>
	<td colspan=2>Create a Listing for a:</td>
</thead>
<tr>
	<td style="padding:2mm;">
		<div style="text-align:center;">
			<input type="submit" value="house" name="location_type">
		</div>
		<p>One building, one lease</p>
	</td>
	<td style="padding:2mm;">
		<div style="text-align:center;">
			<input type="submit" value="apartment"  name="location_type">

		</div>
		<p>Many leases for this one address</p>
	</td>
</tr>
</table>

</form>