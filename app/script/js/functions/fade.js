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

