/* 
Author: Steve Ambielli
Notes: Admin scripts
*/

document.addEventListener('click', function (event) {

	// If the clicked element doesn't have the right selector, bail
	if (!event.target.matches('#show-settings-link')) return;

	// Don't follow the link
	event.preventDefault();

	// Log the clicked element in the console
	console.log(event.target);
	elem = document.getElementById('screen-options-wrap');
	//document.getElementById('screen-options-wrap').style.display = 'block';
	//elem.setAttribute( 'style', 'display: block !important' );
	//elem.setAttribute( 'style', 'visibility: visible !important' );
	elem.style.setProperty('display', 'block', 'important');
	elem.style.setProperty('visibility', 'visible', 'important');

}, false);