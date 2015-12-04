makeATree = function(scene, camera, angle, tree){
	this.scene = scene;
	this.camera = camera;
	this.tree = tree;

	this.nodes = new Array();
	this.mesh = new THREE.Object3D();

	this.createUserTree = function (){
		this.nodes[0] = new Node(0, "user", userFirstname, this.tree);
		this.mesh.add( this.nodes[0].mesh );
		this.nodes[0].createChildren(140, this.nodes);


		this.scene.add(this.mesh);

	}





	this.clickOnNode = function(node){
		marbleTree.camera.slidingGo(node.mesh);

		if(!node.open){
			node.createChildren(140, this.nodes);
		}else{
			node.destroyChildren(this.nodes);
		}


		path.jumpTo(node.nodeId);

		console.log(this.nodes);


        sliceId = node.nodeId;
        slice = dataPuller.pullSlice(sliceId);
        mapSlice = makeASlice(slice);
        mapSlice.rotation.x = -( 20 * Math.PI / 180);
        this.nodes[node.nodeId].mesh.add(mapSlice);
        
    }



    this.live = function(){
    	for(var key in this.nodes) {
    		this.nodes[key].live();
    	}
    }


}

