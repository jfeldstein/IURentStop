<?php /* Smarty version 2.6.18, created on 2009-03-16 15:19:09
         compiled from update_notice.tpl */ ?>
<h1>Thanks for searching IURentStop!</h1>
<br>


<table style="margin: auto; width: 90%;" cellspacing=0 cellpadding=0 border=0>
<tr>
	<td>
		<p>
			Here are some improvements we're adding for next year:
		</p>
		<ul>
			<li><b>Searching</b> by rent and amenities</li>
			<li>Listing every apartment and <b>every house</b>!</li>
			<li>Photos and floorplans</li>
			<li>Inquire by email with one click (no calling)</li>
			<li><b>Only see listings that we know are still available</b></li>
		</ul>
		<br>
		<p style="font-size: 110%">
			<b>Beat the rush: get the best houses. </b><br>
			Give us your email, and we'll email you once at the beginning of next year. And we don't spam.
		</p>
		<form action="signup_to_list.php" method="POST">
			<input type="text" name="email" size="20"> <input type="submit" value="Remind me">
			<input type='hidden' name='forward' value='<?php echo $this->_tpl_vars['form']['forward']; ?>
'>
		</form>
	</td>
	<td style="text-align: center; width: 50%;" valign="middle">
		No, thanks<br>
		<div style="text-align: center; font-weight:bold;">Just <a href="<?php echo $this->_tpl_vars['form']['forward']; ?>
">show me the phone number</a></div>
	</td>
</tr>
</table>