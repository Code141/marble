makeAMap = function(tree, angle){

	this.addToScene = function(scene){
		scene.add(this.root);
	}

	this.setPositionX = function(pos){
		this.root.position.x = pos;
	}

	this.setPositionY = function(pos){
		this.root.position.y = pos;
	}

	this.setPositionZ = function(pos){
		this.root.position.z = pos;
	}

	this.depthVisibility = function(depth){

	}

	this.hover = function(camera, scene){

		vector.set( mouse.x, mouse.y, 0.1 );
		projector.unprojectVector( vector, camera, raycaster);

		raycaster.ray.set( camera.position, vector.sub( camera.position ).normalize() );
		var intersects = raycaster.intersectObjects( this.root.children, true);

		if ( intersects.length > 0 ) {
			if ( intersected != intersects[ 0 ].object ) {

				if ( intersected ){
					intersected.material.emissive.setHex( intersected.currentHex );
					intersected.parent.children[0].position.y = 30;
				}

				intersected = intersects[ 0 ].object;

				if(intersected == intersected.parent.children[1]){
					intersected.parent.children[0].position.y = 40;
					intersected.currentHex = intersected.material.emissive.getHex();
					intersected.material.emissive.setHex( 0x444444 );
					document.body.style.cursor = 'pointer';
					//ShowSlice
					overSeer.showSlice(intersected.parent.userData.id);
				}

			}

		} else {
			if ( intersected ){
				intersected.material.emissive.setHex( intersected.currentHex );
				intersected.parent.children[0].position.y = 30;
			}

			intersected = null;
			document.body.style.cursor = 'auto';

		}

	}

	this.createChild = function(tree, parent, lvl, angle){
		lvl++;
		var thisAngle = angle/tree.length;

		for(var i=0; i<tree.length; i++){

			var node = new THREE.Object3D();
			var linked = true;

			nodeId = tree[i].value.id;
			nodeColore = customColor('cyan');
			thisNodeColor = nodeColore.getHSL();
			nodeColore.setHSL(thisNodeColor.h, thisNodeColor.s/lvl, thisNodeColor.l);
			
			node = this.drawNode(tree[i].value.nodeName, linked, nodeColore, lvl, nodeId);
			incrementation = ((thisAngle*i)-(thisAngle*((tree.length*0.5)-0.5)));

			node.rotation.y = -( ( incrementation ) * Math.PI / 180);

			node.position.z = -brancheLength;

			if(tree[i].children != null){
				var child = new THREE.Object3D()
				child = this.createChild(tree[i].children, node, lvl, thisAngle);			
			}
			

			parent.add(node);

		}
		lvl--;
		return node;
	}

	this.drawNode = function(nodeName, linked, color, lvl, nodeId){
		brancheLength = brancheLength;
		nodeSize = brancheLength/10;

		var node = new THREE.Object3D()

    	//
    	//--------------NODE
    	//

    	var material = new THREE.MeshPhongMaterial({color : color});

    	var geometry = new THREE.SphereGeometry( nodeSize/2, 16, 16 );
    	var sphere = new THREE.Mesh( geometry, material );
    	sphere.position.z = -brancheLength;
    	sphere.name = 'sphereNode';

    	//
    	//--------------NODE NAME
    	//

    	geometry = new THREE.TextGeometry( nodeName, {size: brancheLength/10, height: 10, curveSegments: 4, font: "din 1451 std", weight: 'normal', style: 'normal', bevelThickness: 2, bevelSize: 1.5, bevelSegments: 1, bevelEnabled: false, material: 0, extrudeMaterial: 1});
    	text = new THREE.Mesh(geometry, material);

    	geometry.computeBoundingBox();
    	var centerOffset = -0.5 * ( geometry.boundingBox.max.x - geometry.boundingBox.min.x );

    	text.position.x = centerOffset;
    	text.position.z = -brancheLength;
    	text.position.y = nodeSize;
    	text.name = 'textNode';
    	text.rotation.x = -1.57;

    	//
    	//--------------LINK
    	//
    	node.add( text, sphere );
    	node.name = 'NODE';
    	node.userData = { id: nodeId };

    	if(linked){
    		var material = new THREE.MeshPhongMaterial({color : customColor('black')});
    		var geometry = new THREE.CylinderGeometry( nodeSize/8, nodeSize/8, brancheLength, 16 );
    		var link = new THREE.Mesh( geometry, material );
    		link.rotation.x = 1.57;
    		link.position.z = -(brancheLength/2);
    		link.name = 'nodeLink';
    		node.add(link);
    	}

    	return node;

    }

    brancheLength = 300;
    var lvl = 0 ;
    
    this.root = new THREE.Object3D()
    this.root.position.z = brancheLength;

    this.root.add( this.drawNode(userFirstname, false, customColor('red'), lvl, 0 ) );	
    this.root.add( this.createChild(tree, this.root, lvl, angle) );

}

