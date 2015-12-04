var divlisttiers = function(element){
console.log(element);
	divlist = document.getElementsByClassName('asideliste');

	for(i=0;i<divlist.length;i++){
		divlist[i].style.height='10%';
		element.style.height='80%';
	}
}

var divlisttiersclear = function(element){
	divlist = document.getElementsByClassName('asideliste');

	for(i=0;i<divlist.length;i++){
		divlist[i].style.height=100/divlist.length+'%';
	}
}

/*
	resizeElement = function(element){
		element.style.height='10px';

		clearInterval(myResizeInterval);
	}	

	setTimeout(function(){
		myResizeInterval = setInterval(function(){resizeElement(element)}, 10);
	},0);
*/



/*
fadeOut = function(element, wait, time){
	opacity = 1;
	element = document.getElementById(element);

	fadeopacity = function(element){
		opacity -= 1/time;

		element.style.opacity = opacity;

		if(opacity <= 0 ){
			element.style.display = 'none';
			clearInterval(myFadeOutinterval);
		}

	}

	setTimeout(function(){
		myFadeOutinterval = setInterval(function(){fadeopacity(element)}, 10);
	},wait);


}

*/