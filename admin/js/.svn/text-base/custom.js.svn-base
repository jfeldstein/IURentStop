
function openOwner(id){
	document.location = "ownerDetails.php?id="+id;
}
function openLocation(id){
	document.location = "locationDetails.php?id="+id;
}
function openSpace(id){
	document.location = "spaceDetails.php?id="+id;
}

function pop_tags(URL) {
	day = new Date();
	id = day.getTime();
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=500,height=400,left = 262,top = 184');");
	return false;
}

function numbersonly(myfield, e, dec) {
  var key;
  var keychar;
  var curval = myfield.value;

  if (window.event)
    key = window.event.keyCode;
  else if (e)
    key = e.which;
  else
    return true;

  if(key==8)
	return true;
	
  keychar = String.fromCharCode(key);

  // control keys
  if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) )
    return true;

  else if (keychar=='.' && curval.length > 0 && curval.indexOf('.') == -1 && dec)
	return true;
	
  // numbers
  else if ((("0123456789").indexOf(keychar) > -1) && (curval.indexOf('.')==curval.length-1 || curval.indexOf('.')==-1))
    return true;

  else
    return false;
}

function activate_tag_cloud()
{
	$$('.tag').each( function(tag){
		Event.observe(tag, 'click', function(){
			tag.toggleClassName('selected');
			tag_id = tag.id.replace('tag_', '');
			if(tag.hasClassName('selected'))
			{
				var input = new Element('input', {'type': 'hidden', 'value': tag_id, 'name': 'selected_tags['+tag_id+']', 'id': 'tag_input_'+tag_id});
				$('search_form').appendChild(input);
			}
			 else
			{
				$('tag_input_'+tag_id).remove();
			}
		});
	});
}
function activate_buttons()
{
	$$('.imageBtn').each( function(item){
		Event.observe(item, 'click', function(){
			item_id = item.id.replace(managerType+'_', '');
			if(item.hasClassName('withheld') || item.hasClassName('visible'))
				action = 'deactivate'+managerType;	
			 else
				action = 'activate'+managerType;
				
			new Ajax.Request(managerType+'manager.php', {
				parameters: {
					'action': action,
					'item_id': item_id},
				onSuccess: function(t){
					if(t.responseText=='not_enough')
					{	
						if(confirm("You're already using all of your allotted photos. \n\n To show this photo, first disable another photo. \n\n To increase your allotment of photos, click OK."))
							pop_tags('morephotos.php?popup=1');
					}
					 else
					{
						update_manager();
					}
				}
			});
		});
	});
}
function getCaption() {
	filename   = $('item_data').value;
	curCaption = filename.substring(filename.lastIndexOf('\\')+1);
	newCaption = prompt("Currently, the caption is: '"+curCaption+"'. \tChange it to: (Optional)", "");
	if(newCaption!=null && newCaption!='' && newCaption!='undefined')
		$('caption').value = newCaption;
	
}
function completeCallback(response) {
	if(response!='success')
		alert(response);
	
	update_manager($('targeter'));
}
function update_manager()
{
	value = $('targeter').value;
	if(value=='#')
		new Ajax.Updater(
			$('theDiv'), 
			managerType+'manager.php?action=default');
	else {
		to=value.evalJSON(); 
		new Ajax.Updater(
			$('theDiv'), 
			managerType+'manager.php?action=showform',
			{ 
			  parameters: to,
			  evalScripts: true,
			  onComplete: activate_buttons
			});
	}
}

function delete_image(id)
{
	if(confirm("Are you sure you want to delete this item?"))
		new Ajax.Request(managerType+'manager.php', {
			parameters: {
				'action': 'deleteitem',
				'item_id': id},
			onSuccess: update_manager
		});
}

function recaption_image(id)
{
	newCaption = prompt("What should the new caption be?");
	if(newCaption != null && newCaption != '')
	new Ajax.Request(managerType+'manager.php', {
		parameters: {
			'action': 'recaptionitem',
			'caption': newCaption,
			'item_id': id},
		onSuccess: update_manager
	});
}

function update_photo_status(r)
{
	photo = r.responseText.evalJSON();
	$(photo.div_id).removeClassName('visible');
	$(photo.div_id).removeClassName('withheld');
	$(photo.div_id).removeClassName('off');
	$(photo.div_id).addClassName(photo.status);
}


/**
*
*  AJAX IFRAME METHOD (AIM)
*  http://www.webtoolkit.info/
*
**/

AIM = {

	frame : function(c) {

		var n = 'f' + Math.floor(Math.random() * 99999);
		var d = document.createElement('DIV');
		d.innerHTML = '<iframe style="display:none" src="about:blank" id="'+n+'" name="'+n+'" onload="AIM.loaded(\''+n+'\')"></iframe>';
		document.body.appendChild(d);

		var i = document.getElementById(n);
		
		if (c && typeof(c.onComplete) == 'function') {
			i.onComplete = c.onComplete;
		}

		return n;
	},

	form : function(f, name) {
		f.setAttribute('target', name);
	},

	submit : function(f, c) {
		AIM.form(f, AIM.frame(c));
		if (c && typeof(c.onStart) == 'function') {
			return c.onStart();
		} else {
			return true;
		}
	},

	loaded : function(id) {
		var i = document.getElementById(id);
		if (i.contentDocument) {
			var d = i.contentDocument;
		} else if (i.contentWindow) {
			var d = i.contentWindow.document;
		} else {
			var d = window.frames[id].document;
		}
		if (d.location.href == "about:blank") {
			return;
		}

		if (typeof(i.onComplete) == 'function') {
			i.onComplete(d.body.innerHTML);
		}
	}

}