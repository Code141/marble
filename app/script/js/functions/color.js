customColor = function(wichColor){
	
	this.colorListe = {
		cyan : {
			rgb : {
				red : 85, 
				green : 210,
				blue : 239
			}
		},
		magenta : {
			rgb : {
				red : 249,
				green : 38,
				blue : 114
			}
		},
		orange : {
			rgb : {
				red : 253,
				green : 151,
				blue : 32
			}
		},
		green : {
			rgb : {
				red : 166,
				green : 226,
				blue : 46
			}
		},
		violet : {
			rgb : {
				red :  174,
				green : 129,
				blue : 225
			}
		},
		red : {
			rgb : {
				red : 255,
				green : 51,
				blue : 51
			}
		},
		white : {
			rgb : {
				red : 255,
				green : 255,
				blue : 255
			}
		},
		black : {
			rgb : {
				red : 0,
				green : 0,
				blue : 0
			}
		}
	};

	switch ( wichColor ) { 

		case "cyan" : 
		var color = new THREE.Color("rgb(85,210,239)");
		break ;

		case "magenta" : 
		var color = new THREE.Color("rgb(249,38,114)");
		break ;

		case "orange" : 
		var color = new THREE.Color("rgb(253,151,32)");
		break ;

		case "green" : 
		var color = new THREE.Color("rgb(166,226,46)");
		break ;

		case "violet" : 
		var color = new THREE.Color("rgb(174,129,225)");
		break ;

		case "red" : 
		var color = new THREE.Color("rgb(225,51,51)");
		break ;

		case "black" : 
		var color = new THREE.Color("rgb(0,0,0)");
		break ;

		case "white" : 
		var color = new THREE.Color("rgb(255,255,255)");
		break ;

		default : 
		var color = new THREE.Color("rgb(255,0,255)");

	}
return color;
}


