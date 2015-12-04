CameraController = function( fov, container, renderer, near, far ){
	this.container = container;
	this.renderer = renderer;
	this.camera = new THREE.PerspectiveCamera( fov, container.clientWidth / container.clientHeight, near, far );
	this.dolly = new CameraDolly(this.camera);

	this.cameraorbitControls = new THREE.OrbitControls( this.camera, renderer.domElement );


	this.slidingGo = function(intersected) {
		var position = new THREE.Vector3();
		var quaternion = new THREE.Quaternion();
		var scale = new THREE.Vector3();
		intersected.matrixWorld.decompose( position, quaternion, scale );

		this.dolly.newTravelling(position, quaternion, 500, "linear");
	}



	this.windowSetSize = function() {
		this.camera.aspect = this.container.clientWidth / this.container.clientHeight;
		this.camera.updateProjectionMatrix();
		this.renderer.setSize( this.container.clientWidth, this.container.clientHeight );
	}

	function bind( scope, fn ) {
		return function () {
			fn.apply( scope, arguments );
		};
	};

	window.addEventListener( 'resize', bind( this, this.windowSetSize ), false );
	this.windowSetSize();
}




CameraDolly = function(camera){
	this.camera = camera;

	this.positionCible = new THREE.Vector3(0,0,0);
	this.quaternionCible = new THREE.Quaternion();

	this.timeSet = 0;
	this.timeStart = 0;
	this.timeEnd = 0;

	this.type = null;

	this.pas = 0;

	this.padding = new THREE.Vector3();
	

	this.newTravelling = function(position, quaternion, time, type){

		this.positionCible = position;
		this.quaternionCible = quaternion;

		this.timeStart = new Date().getTime();
		this.timeSet = time;
		this.timeEnd = this.timeStart+time;
		
		this.type = type;
	
		this.padding = new THREE.Vector3(0, 400, 1000);


		prochaineRotation = new THREE.Quaternion();
		prochaineRotation.copy(this.quaternionCible)
		this.camera.quaternion.copy(prochaineRotation);
		this.padding.applyQuaternion(prochaineRotation);

	}

	this.linearRun = function(timeNow){
		if(this.timeEnd >= timeNow){

			y = timeNow-this.timeStart;
			x = this.timeSet;

			//---------- ROTATION

			lookAtCam = new THREE.Vector3(0, 0, -300);
			lookAtCam.applyQuaternion(prochaineRotation);
			lookAtCam.add(this.positionCible);

// LOOKAT est une méthode, elle ne peut renvoiet de coordonées
// utiliser le quaternion initial de la camera
// puis regle de 3 avec le quaternionCible et X(ime) pour atteindre la cible de maniere fluide
// elle possede une coorelation avec le quaternion de la caméra

			this.camera.lookAt(lookAtCam);

			//---------- POSITION
			prochainePosition = new THREE.Vector3(0,0,0);
			//On prends la cible absolue
			prochainePosition.copy(this.positionCible);
			//ajoute le padding
			prochainePosition.add(this.padding);
			//On y soustrait la position de la caméra pour optenir le vecteur séparant les 2
			prochainePosition.sub(this.camera.position);
			//Produit en croix pour convertire le temps écoulé en distance effectuée
			// multiplie distance totale par temps écoulé depuis départ
			prochainePosition.multiplyScalar(y);
			// la diviser par le temps total
			prochainePosition.divideScalar(x);

			

			//Ajoute vecteur calculé a position actuelle
			this.camera.position.add(prochainePosition);


		}else{
			this.type = null;
		}
	}

	this.anime = function(timeNow){
		if(this.type == "linear"){
			this.linearRun(timeNow);
		}else{
			//console.log('dolly\'s sleeping');
		}
	}
}

