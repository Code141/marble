makeASlice = function(){

	this.sliceView = new THREE.Object3D();
	sliceScene.add(this.sliceView);

	this.showSlice = function(idSlice){


		sliceArray = dataPuller.pullSlice(idSlice);

		var slice = new THREE.Object3D()

		for (i=0; i<sliceArray.length;i++){
			
			var slicePortion = new THREE.Object3D();
			var material = new THREE.MeshPhongMaterial({color : customColor('magenta')});

			geometry = new THREE.TextGeometry( dataPuller.pullObjetName(sliceArray[i].idAdjectif), {size: brancheLength/15, height: 10, curveSegments: 4, font: "din 1451 std"});
			text = new THREE.Mesh(geometry, material);

			geometry.computeBoundingBox();
			centerOffset = -0.5 * ( geometry.boundingBox.max.x - geometry.boundingBox.min.x );
			//text.position.x = centerOffset;
			text.position.y = 100;
			text.rotation.z = -( ( ( 360/sliceArray.length ) *i ) * Math.PI / 180);

			//CenterOffset foir le repositionement....
			//text.rotation.z = -( ( ( 360/arraySlice.length ) *i ) * Math.PI / 180);

			var material = new THREE.MeshPhongMaterial({color : customColor('violet')});
			var geometry = new THREE.CylinderGeometry( 2, 2, 100, 16 );
			var cylinder = new THREE.Mesh( geometry, material );
			cylinder.position.y = 50;    	

			var material = new THREE.MeshPhongMaterial({color : customColor('orange')});
			var geometry = new THREE.CylinderGeometry( 4, 4, (sliceArray[i].score*10), 16 );
			var cylinderNote = new THREE.Mesh( geometry, material );
			cylinderNote.position.y = (sliceArray[i].score*10)/2;    	

			slicePortion.add(cylinderNote, cylinder, text);
			slicePortion.rotation.z = ( ( ( 360/sliceArray.length ) *i ) * Math.PI / 180);

			slice.add(slicePortion);
		}

		sliceScene.remove(this.sliceView);
		this.sliceView = new THREE.Object3D();
		sliceScene.add(this.sliceView);
		this.sliceView.add(slice);
	}

}
