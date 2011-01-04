<table>
	<tr><td style="font-weight:bold; font-size: 120%;" width=80>Call:</td><td>{$properphone}</td></tr>
	{if $owner.first_name!=''}<tr><td style="font-weight:bold; font-size: 120%;">Ask For:</td><td>{$owner.full_name}</td></tr>{/if}
	<tr><td colspan=2 style="font-weight:bold; font-size: 120%;">Tell them:</td></tr>
	<tr><td colspan=2>
		<blockquote style="line-height: 15pt;">
			{if $location.type=='house'}
				<div style="">
					I saw you have a house
					at <span style='white-space:nowrap; font-weight:bold;'>'{$location.address}'</span> listed on <b>IURentStop.com</b>.
					I'd like to know more about it, and maybe see it.
				</div>
			{else}
				<div style="">
					I saw your {$space.br_string} apartment 
					
					at <span style='white-space:nowrap; font-weight:bold;'>'{$location.address}' </span>
					
					listed on <b>IURentStop.com</b>. I'd like to know more about it, and maybe see it.
				</div>
			{/if}
		</blockquote>
	</td></tr>
</table>