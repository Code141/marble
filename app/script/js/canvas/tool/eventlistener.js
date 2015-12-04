function onDocumentMouseMove( event ) {

	event.preventDefault();

	canvasTop = event.clientX - htmlMarbleContainer.getBoundingClientRect().left;
	canvasLeft = event.clientY - htmlMarbleContainer.getBoundingClientRect().top;

	mouse.x = ( canvasTop / htmlMarbleContainer.clientWidth ) * 2 - 1;
	mouse.y = - ( canvasLeft / htmlMarbleContainer.clientHeight ) * 2 + 1;

}
