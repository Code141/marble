function xhrObject(target, request, asynchrone) {
	if(target == 'messagebox'){
		elmt = document.getElementById('messageboxmasque');
		elmt.style.display = "inline-block";
		elmt.style.opacity = 1;
	}


	var xhr_object = null;
	if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest();
	else if(window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP");
	else {alert("Ton navigateur ne supporte pas les objets XMLHTTPRequest...");return;}

	xhr_object.open("POST", <?php echo SITE_ROOT;?>+"ajax/"+request, asynchrone);

	xhr_object.onreadystatechange = function() {
		if(xhr_object.readyState == 4 && this.status == 200 && target != '') {
			var myLockTarget = document.getElementById(target);
			myLockTarget.innerHTML = xhr_object.responseText;
			var scripts = myLockTarget.getElementsByTagName('script');
			for(var i=0; i < scripts.length;i++)
			{
				/*Sous IE il faut faire un execScript pour que les fonctions soient définie en globale*/
				if (window.execScript){
					/*On replace les éventuels com' html car IE n'aime pas ça*/
					window.execScript(scripts[i].text.replace('<!--',''));
				}else{
					window.eval(scripts[i].text);
				}
			}
		}
	}

	xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr_object.send();
}



//---RECUPERE DONNES POST D'UN FORMULAIRE DYNAMIQUEMENT PUIS CONSTITUE REQUETE POST
/*
function nextpageform(var_div, var_page, var_form) {	
	var mydiv = document.getElementById(var_div);
	var params = getParameters(var_form);

	var xhr_object = null;

	if(window.XMLHttpRequest) xhr_object = new XMLHttpRequest();
	else if(window.ActiveXObject) xhr_object = new ActiveXObject("Microsoft.XMLHTTP");
	else {
		alert("Ton navigateur ne supporte pas les objets XMLHTTPRequest...");
		return;
	}
	xhr_object.open("POST", var_page, true);
	xhr_object.onreadystatechange = function() {
		if(xhr_object.readyState == 4) {			
			mydiv.innerHTML = xhr_object.responseText;
		}
	}
	xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr_object.send(params);
}





function getParameters(var_form){
	var params = "";
	var elements = document.forms[var_form].elements;
	for(var i=0; i<elements.length; i++){
		if(i>0){
			params += "&";
		}
		params+= elements[i].name+"="+elements[i].value;
	}
	return params;
}

*/