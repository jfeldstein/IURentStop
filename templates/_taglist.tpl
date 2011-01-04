
			{foreach from=$tags item=tag name=am_loop}
				{if $smarty.foreach.am_loop.first}
				<table width=100%>
				{/if}
				
				<tr>
				<td width="6">
					<form action="delete_tag.php?on={$form.on}&id={$form.id}&tag_id={$tag.id}" onsubmit="return AjaxForm(this, $('tagList'))">
					<input type="image" src="images/delete.png">
					</form>
				</td><td>{$tag.text}</td></tr>
				
				{if $smarty.foreach.am_loop.last}
				</table>
				{/if}
			{foreachelse}
			<p>None, yet.</p>
			{/foreach}