/*
Created By: Chris Campbell
Website: http://particletree.com
Date: 2/1/2006

Inspired by the lightbox implementation found at http://www.huddletogether.com/projects/lightbox/
*/

/*-------------------------------GLOBAL VARIABLES------------------------------------*/

var detect = navigator.userAgent.toLowerCase();
var OS,browser,version,total,thestring;

/*-----------------------------------------------------------------------------------------------*/

//Browser detect script origionally created by Peter Paul Koch at http://www.quirksmode.org/

function getBrowserInfo() {
	if (checkIt('konqueror')) {
		browser = "Konqueror";
		OS = "Linux";
	}
	else if (checkIt('safari')) browser 	= "Safari"
	else if (checkIt('omniweb')) browser 	= "OmniWeb"
	else if (checkIt('opera')) browser 		= "Opera"
	else if (checkIt('webtv')) browser 		= "WebTV";
	else if (checkIt('icab')) browser 		= "iCab"
	else if (checkIt('msie')) browser 		= "Internet Explorer"
	else if (!checkIt('compatible')) {
		browser = "Netscape Navigator"
		version = detect.charAt(8);
	}
	else browser = "An unknown browser";

	if (!version) version = detect.charAt(place + thestring.length);

	if (!OS) {
		if (checkIt('linux')) OS 		= "Linux";
		else if (checkIt('x11')) OS 	= "Unix";
		else if (checkIt('mac')) OS 	= "Mac"
		else if (checkIt('win')) OS 	= "Windows"
		else OS 								= "an unknown operating system";
	}
}

function checkIt(string) {
	place = detect.indexOf(string) + 1;
	thestring = string;
	return place;
}

/*-----------------------------------------------------------------------------------------------*/

Event.observe(window, 'load', initialize, false);
Event.observe(window, 'load', getBrowserInfo, false);
Event.observe(window, 'unload', Event.unloadCache, false);

var lightbox = Class.create();

lightbox.prototype = {

	yPos : 0,
	xPos : 0,
	initialize: function(ctrl) {
		this.content = ctrl.href;
		Event.observe(ctrl, 'click', this.activate.bindAsEventListener(this), false);
		ctrl.onclick = function(){return false;};
	},
	
	// Turn everything on - mainly the IE fixes
	activate: function(){
		if (browser == 'Internet Explorer'){
			this.getScroll();
			this.prepareIE('100%', 'hidden');
			this.setScroll(0,0);
			this.hideSelects('hidden');
		}
		this.displayLightbox("block");
	},
	
	// Ie requires height to 100% and overflow hidden or else you can scroll down past the lightbox
	prepareIE: function(height, overflow){
		bod = document.getElementsByTagName('body')[0];
		bod.style.height = height;
		bod.style.overflow = overflow;
  
		htm = document.getElementsByTagName('html')[0];
		htm.style.height = height;
		htm.style.overflow = overflow; 
	},
	
	// In IE, select elements hover on top of the lightbox
	hideSelects: function(visibility){
		selects = document.getElementsByTagName('select');
		for(i = 0; i < selects.length; i++) {
			selects[i].style.visibility = visibility;
		}
	},
	
	// Taken from lightbox implementation found at http://www.huddletogether.com/projects/lightbox/
	getScroll: function(){
		if (self.pageYOffset) {
			this.yPos = self.pageYOffset;
		} else if (document.documentElement && document.documentElement.scrollTop){
			this.yPos = document.documentElement.scrollTop; 
		} else if (document.body) {
			this.yPos = document.body.scrollTop;
		}
	},
	
	setScroll: function(x, y){
		window.scrollTo(x, y); 
	},
	
	displayLightbox: function(display){
		$('overlay').style.display = display;
		$('lightbox').style.display = display;
		if(display != 'none') this.loadInfo();
	},
	
	// Begin Ajax request based off of the href of the clicked linked
	loadInfo: function() {
		var myAjax = new Ajax.Request(
		this.content,
		{method: 'post', parameters: {ajax: 1}, onComplete: this.processInfo.bindAsEventListener(this)}
		);
		
	},
	
	// Display Ajax response
	processInfo: function(response){
	
		if(response.responseText.substring(0,3)=='GOTO')
			document.location = response.responseText.substring(5); 
			
		if(response.responseText.substring(0,4)=='CLOSE')
			return this.deactivate();
	
	
		info = "<div id='lbContent'><a href='#' class='lbAction' rel='deactivate' style='text-align: right;'><img src='images/closelabel.gif' alt='Close' align='right' style='margin-bottom:2mm;'></a><br style='clear:both;'>" + response.responseText + "</div>";
		new Insertion.Before($('lbLoadMessage'), info)
		$('lightbox').className = "done";	
		this.actions();			
	},
	
	// Search through new links within the lightbox, and attach click event
	actions: function(){
		lbActions = document.getElementsByClassName('lbAction');

		for(i = 0; i < lbActions.length; i++) {
			Event.observe(lbActions[i], 'click', this[lbActions[i].rel].bindAsEventListener(this), false);
			lbActions[i].onclick = function(){return false;};
		}

	},
	
	// Example of creating your own functionality once lightbox is initiated
	insert: function(e){
	   link = Event.element(e).parentNode;
	   Element.remove($('lbContent'));
	   
	   var myAjax = new Ajax.Request(
			  link.href,
			  {method: 'post', parameters: "", onComplete: this.processInfo.bindAsEventListener(this)}
	   );
	 
	},
	
	// Example of creating your own functionality once lightbox is initiated
	deactivate: function(){
		Element.remove($('lbContent'));
		
		if (browser == "Internet Explorer"){
			this.setScroll(0,this.yPos);
			this.prepareIE("auto", "auto");
			this.hideSelects("visible");
		}
		
		this.displayLightbox("none");
	}
}

/*-----------------------------------------------------------------------------------------------*/

// Onload, make all links that need to trigger a lightbox active
function initialize(){
	addLightboxMarkup();
	lbox = document.getElementsByClassName('lbOn');
	for(i = 0; i < lbox.length; i++) {
		valid = new lightbox(lbox[i]);
	}
}

// Add in markup necessary to make this work. Basically two divs:
// Overlay holds the shadow
// Lightbox is the centered square that the content is put into.
function addLightboxMarkup() {
	bod 				= document.getElementsByTagName('body')[0];
	overlay 			= document.createElement('div');
	overlay.id		= 'overlay';
	lb					= document.createElement('div');
	lb.id				= 'lightbox';
	lb.className 	= 'loading';
	lb.innerHTML	= '<div id="lbLoadMessage">' +
						  '<p>Loading</p>' +
						  '</div>';
	bod.appendChild(overlay);
	bod.appendChild(lb);
}
/*
	Lightbox JS: Fullsize Image Overlays 
	by Lokesh Dhakar - http://www.huddletogether.com

	For more information on this script, visit:
	http://huddletogether.com/projects/lightbox/

	Licensed under the Creative Commons Attribution 2.5 License - http://creativecommons.org/licenses/by/2.5/
	(basically, do anything you want, just leave my name and link)
	
	Table of Contents
	-----------------
	Configuration
	
	Functions
	- getPageScroll()
	- getPageSize()
	- pause()
	- getKey()
	- listenKey()
	- showLightbox()
	- hideLightbox()
	- initLightbox()
	- addLoadEvent()
	
	Function Calls
	- addLoadEvent(initLightbox)

*/



//
// Configuration
//

// If you would like to use a custom loading image or close button reference them in the next two lines.
var loadingImage = 'images/loading.gif';		
var closeButton = 'images/close.gif';		





//
// getPageScroll()
// Returns array with x,y page scroll values.
// Core code from - quirksmode.org
//
function getPageScroll(){

	var yScroll;

	if (self.pageYOffset) {
		yScroll = self.pageYOffset;
	} else if (document.documentElement && document.documentElement.scrollTop){	 // Explorer 6 Strict
		yScroll = document.documentElement.scrollTop;
	} else if (document.body) {// all other Explorers
		yScroll = document.body.scrollTop;
	}

	arrayPageScroll = new Array('',yScroll) 
	return arrayPageScroll;
}



//
// getPageSize()
// Returns array with page width, height and window width, height
// Core code from - quirksmode.org
// Edit for Firefox by pHaez
//
function getPageSize(){
	
	var xScroll, yScroll;
	
	if (window.innerHeight && window.scrollMaxY) {	
		xScroll = document.body.scrollWidth;
		yScroll = window.innerHeight + window.scrollMaxY;
	} else if (document.body.scrollHeight > document.body.offsetHeight){ // all but Explorer Mac
		xScroll = document.body.scrollWidth;
		yScroll = document.body.scrollHeight;
	} else { // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari
		xScroll = document.body.offsetWidth;
		yScroll = document.body.offsetHeight;
	}
	
	var windowWidth, windowHeight;
	if (self.innerHeight) {	// all except Explorer
		windowWidth = self.innerWidth;
		windowHeight = self.innerHeight;
	} else if (document.documentElement && document.documentElement.clientHeight) { // Explorer 6 Strict Mode
		windowWidth = document.documentElement.clientWidth;
		windowHeight = document.documentElement.clientHeight;
	} else if (document.body) { // other Explorers
		windowWidth = document.body.clientWidth;
		windowHeight = document.body.clientHeight;
	}	
	
	// for small pages with total height less then height of the viewport
	if(yScroll < windowHeight){
		pageHeight = windowHeight;
	} else { 
		pageHeight = yScroll;
	}

	// for small pages with total width less then width of the viewport
	if(xScroll < windowWidth){	
		pageWidth = windowWidth;
	} else {
		pageWidth = xScroll;
	}


	arrayPageSize = new Array(pageWidth,pageHeight,windowWidth,windowHeight) 
	return arrayPageSize;
}


//
// pause(numberMillis)
// Pauses code execution for specified time. Uses busy code, not good.
// Code from http://www.faqts.com/knowledge_base/view.phtml/aid/1602
//
function pause(numberMillis) {
	var now = new Date();
	var exitTime = now.getTime() + numberMillis;
	while (true) {
		now = new Date();
		if (now.getTime() > exitTime)
			return;
	}
}

//
// getKey(key)
// Gets keycode. If 'x' is pressed then it hides the lightbox.
//

function getKey(e){
	if (e == null) { // ie
		keycode = event.keyCode;
	} else { // mozilla
		keycode = e.which;
	}
	key = String.fromCharCode(keycode).toLowerCase();
	
	if(key == 'x'){ hideLightbox(); }
}


//
// listenKey()
//
function listenKey () {	document.onkeypress = getKey; }
	

//
// showLightbox()
// Preloads images. Pleaces new image in lightbox then centers and displays.
//
function showLightbox(objLink)
{
	// prep objects
	var objOverlay = document.getElementById('realoverlay');
	var objLightbox = document.getElementById('reallightbox');
	var objCaption = document.getElementById('reallightboxCaption');
	var objImage = document.getElementById('lightboxImage');
	var objLoadingImage = document.getElementById('loadingImage');
	var objLightboxDetails = document.getElementById('reallightboxDetails');

	
	var arrayPageSize = getPageSize();
	var arrayPageScroll = getPageScroll();

	// center loadingImage if it exists
	if (objLoadingImage) {
		objLoadingImage.style.top = (arrayPageScroll[1] + ((arrayPageSize[3] - 35 - objLoadingImage.height) / 2) + 'px');
		objLoadingImage.style.left = (((arrayPageSize[0] - 20 - objLoadingImage.width) / 2) + 'px');
		objLoadingImage.style.display = 'block';
	}

	// set height of Overlay to take up whole page and show
	objOverlay.style.height = (arrayPageSize[1] + 'px');
	objOverlay.style.display = 'block';

	// preload image
	imgPreload = new Image();

	imgPreload.onload=function(){
		objImage.src = objLink.href;

		// center lightbox and make sure that the top and left values are not negative
		// and the image placed outside the viewport
		var lightboxTop = arrayPageScroll[1] + ((arrayPageSize[3] - 35 - imgPreload.height) / 2);
		var lightboxLeft = ((arrayPageSize[0] - 20 - imgPreload.width) / 2);
		
		objLightbox.style.top = (lightboxTop < 0) ? "0px" : lightboxTop + "px";
		objLightbox.style.left = (lightboxLeft < 0) ? "0px" : lightboxLeft + "px";


		objLightboxDetails.style.width = imgPreload.width + 'px';
		
		if(objLink.getAttribute('title')){
			objCaption.style.display = 'block';
			//objCaption.style.width = imgPreload.width + 'px';
			objCaption.innerHTML = objLink.getAttribute('title');
		} else {
			objCaption.style.display = 'none';
		}
		
		// A small pause between the image loading and displaying is required with IE,
		// this prevents the previous image displaying for a short burst causing flicker.
		if (navigator.appVersion.indexOf("MSIE")!=-1){
			pause(250);
		} 

		if (objLoadingImage) {	objLoadingImage.style.display = 'none'; }

		// Hide select boxes as they will 'peek' through the image in IE
		selects = document.getElementsByTagName("select");
        for (i = 0; i != selects.length; i++) {
                selects[i].style.visibility = "hidden";
        }

	
		objLightbox.style.display = 'block';

		// After image is loaded, update the overlay height as the new image might have
		// increased the overall page height.
		arrayPageSize = getPageSize();
		objOverlay.style.height = (arrayPageSize[1] + 'px');
		
		// Check for 'x' keypress
		listenKey();

		return false;
	}

	imgPreload.src = objLink.href;
	
}





//
// hideLightbox()
//
function hideLightbox()
{
	// get objects
	objOverlay = document.getElementById('realoverlay');
	objLightbox = document.getElementById('reallightbox');

	// hide lightbox and overlay
	objOverlay.style.display = 'none';
	objLightbox.style.display = 'none';

	// make select boxes visible
	selects = document.getElementsByTagName("select");
    for (i = 0; i != selects.length; i++) {
		selects[i].style.visibility = "visible";
	}

	// disable keypress listener
	document.onkeypress = '';
}




//
// initLightbox()
// Function runs on window load, going through link tags looking for rel="lightbox".
// These links receive onclick events that enable the lightbox display for their targets.
// The function also inserts html markup at the top of the page which will be used as a
// container for the overlay pattern and the inline image.
//
function initLightbox()
{
	
	if (!document.getElementsByTagName){ return; }
	var anchors = document.getElementsByClassName("lightbox");

	// loop through all anchor tags
	anchors.each( function(obj){
		obj.onclick = function () {showLightbox(this); return false;}
	});

	// the rest of this code inserts html at the top of the page that looks like this:
	//
	// <div id="overlay">
	//		<a href="#" onclick="hideLightbox(); return false;"><img id="loadingImage" /></a>
	//	</div>
	// <div id="lightbox">
	//		<a href="#" onclick="hideLightbox(); return false;" title="Click anywhere to close image">
	//			<img id="closeButton" />		
	//			<img id="lightboxImage" />
	//		</a>
	//		<div id="lightboxDetails">
	//			<div id="lightboxCaption"></div>
	//			<div id="keyboardMsg"></div>
	//		</div>
	// </div>
	
	var objBody = document.getElementsByTagName("body").item(0);
	
	// create overlay div and hardcode some functional styles (aesthetic styles are in CSS file)
	var objOverlay = document.createElement("div");
	objOverlay.setAttribute('id','realoverlay');
	objOverlay.onclick = function () {hideLightbox(); return false;}
	objOverlay.style.display = 'none';
	objOverlay.style.position = 'absolute';
	objOverlay.style.top = '0';
	objOverlay.style.left = '0';
	objOverlay.style.zIndex = '90';
 	objOverlay.style.width = '100%';
	objBody.insertBefore(objOverlay, objBody.firstChild);
	
	var arrayPageSize = getPageSize();
	var arrayPageScroll = getPageScroll();

	// preload and create loader image
	var imgPreloader = new Image();
	
	// if loader image found, create link to hide lightbox and create loadingimage
	imgPreloader.onload=function(){

		var objLoadingImageLink = document.createElement("a");
		objLoadingImageLink.setAttribute('href','#');
		objLoadingImageLink.onclick = function () {hideLightbox(); return false;}
		objOverlay.appendChild(objLoadingImageLink);
		
		var objLoadingImage = document.createElement("img");
		objLoadingImage.src = loadingImage;
		objLoadingImage.setAttribute('id','loadingImage');
		objLoadingImage.style.position = 'absolute';
		objLoadingImage.style.zIndex = '150';
		objLoadingImageLink.appendChild(objLoadingImage);

		imgPreloader.onload=function(){};	//	clear onLoad, as IE will flip out w/animated gifs

		return false;
	}

	imgPreloader.src = loadingImage;

	// create lightbox div, same note about styles as above
	var objLightbox = document.createElement("div");
	objLightbox.setAttribute('id','reallightbox');
	objLightbox.style.display = 'none';
	objLightbox.style.position = 'absolute';
	objLightbox.style.zIndex = '100';	
	objBody.insertBefore(objLightbox, objOverlay.nextSibling);
	
	// create link
	var objLink = document.createElement("a");
	objLink.setAttribute('href','#');
	objLink.setAttribute('title','Click to close');
	objLink.onclick = function () {hideLightbox(); return false;}
	objLightbox.appendChild(objLink);

	// preload and create close button image
	var imgPreloadCloseButton = new Image();

	// if close button image found, 
	imgPreloadCloseButton.onload=function(){

		var objCloseButton = document.createElement("img");
		objCloseButton.src = closeButton;
		objCloseButton.setAttribute('id','closeButton');
		objCloseButton.style.position = 'absolute';
		objCloseButton.style.zIndex = '200';
		objLink.appendChild(objCloseButton);

		return false;
	}

	imgPreloadCloseButton.src = closeButton;

	// create image
	var objImage = document.createElement("img");
	objImage.setAttribute('id','lightboxImage');
	objLink.appendChild(objImage);
	
	// create details div, a container for the caption and keyboard message
	var objLightboxDetails = document.createElement("div");
	objLightboxDetails.setAttribute('id','reallightboxDetails');
	objLightbox.appendChild(objLightboxDetails);

	// create caption
	var objCaption = document.createElement("div");
	objCaption.setAttribute('id','reallightboxCaption');
	objCaption.style.display = 'none';
	objLightboxDetails.appendChild(objCaption);

	// create keyboard message
	var objKeyboardMsg = document.createElement("div");
	objKeyboardMsg.setAttribute('id','realkeyboardMsg');
	objKeyboardMsg.innerHTML = '<a href="#" onclick="hideLightbox(); return false;">close</a>';
	objLightboxDetails.appendChild(objKeyboardMsg);
	
}

Event.observe(window, 'load', initLightbox);	// run initLightbox onLoad