Node = function(nodeId, type, nodeName, tree){

    this.nodeId = nodeId;
    this.type = type;
    this.nodeName = nodeName;
    this.tree = tree;

    this.hoverState = false;
    this.brancheLength = 0;

    this.mesh = new THREE.Object3D();
    this.text = null;
    this.sphere = null;
    this.hoverZone = null;
    this.open = false;

    this.createNode = function(){

        if(this.type == "user"){
            color = customColor('red');
            linked = false;
        }else if(this.type == "lambda"){
            color = customColor('cyan');
            linked = true;
            this.brancheLength = 600;
        }

        nodeSize = 40;

        //NODE

        var material = new THREE.MeshPhongMaterial({color : color});
        var geometry = new THREE.SphereGeometry( nodeSize/2, 16, 16 );
        this.sphere = new THREE.Mesh( geometry, material );


        var materialWire = new THREE.MeshNormalMaterial({wireframe : true, transparent : true, opacity : 0.2});
        var geometry = new THREE.SphereGeometry( nodeSize/2+(nodeSize/10), 16, 16 );
        this.hoverZone = new THREE.Mesh( geometry, materialWire );

        //NODE NAME

        geometry = new THREE.TextGeometry( nodeName, {
            size: nodeSize,
            height: 2,
            curveSegments: 8,
            font: "din 1451 std",
            weight: 'normal',
            style: 'normal',
            bevelThickness: 1,
            bevelSize: 1,
            bevelSegments: 4,
            bevelEnabled: true,
            material: 0,
            extrudeMaterial: 1
        });

        this.text = new THREE.Mesh(geometry, material);

        geometry.computeBoundingBox();
        var centerOffset = -0.5 * ( geometry.boundingBox.max.x - geometry.boundingBox.min.x );

        this.text.position.x = centerOffset;
        this.text.position.y = nodeSize;

        //LINK

        this.mesh.add( this.text, this.sphere, this.hoverZone);
        this.mesh.name = 'NODE';

        if(linked){
            var material = new THREE.MeshPhongMaterial({color : customColor('black')});
            var geometry = new THREE.CylinderGeometry( nodeSize/16, nodeSize/16, this.brancheLength, 16 );
            var link = new THREE.Mesh( geometry, material );
            link.rotation.x = 1.57;
           
            link.position.z = (this.brancheLength/2);

            link.name = 'nodeLink';
            this.mesh.add(link);
        }
    }


    this.createChildren = function(angle, nodes){
        this.open = true;
      
        var thisAngle = angle/this.tree.length;

        for(var i=0; i<this.tree.length; i++){

            nodeId = this.tree[i].value.id;
            nodes[nodeId] = new Node(nodeId, "lambda", this.tree[i].value.nodeName, this.tree[i].children);

            incrementation = ((thisAngle*i)-(thisAngle*((this.tree.length*0.5)-0.5)));

            nodes[nodeId].mesh.position.z = -nodes[nodeId].brancheLength;

            var quaternionY = new THREE.Quaternion();
            quaternionY.setFromAxisAngle( new THREE.Vector3(0,1,0), -(incrementation*Math.PI/180));
            nodes[nodeId].mesh.position.applyQuaternion(quaternionY);

            nodes[nodeId].mesh.rotation.y = -( ( incrementation ) * Math.PI / 180);
                    
            this.mesh.add(nodes[nodeId].mesh);
        }
    }

    this.destroyChildren = function(nodes){
        this.open = false;

        for(var i=0; i<this.tree.length; i++){
            this.mesh.remove(nodes[this.tree[i].value.id].mesh);

delete nodes[this.tree[i].value.id];
        }

    }

    this.live = function(){
        this.hover(mouseHover.check(this.hoverZone))
    }

    this.hover = function(state){
        if(state == true){
            this.hoverState = true;
            this.text.position.y = 60;
            sliceViewer.showSlice(this.nodeId);

        }else{
            this.hoverState = false;
            this.text.position.y = 40;
        }
    }

    this.click = function(){
        if(this.hoverState){
           marbleTree.clickOnNode(this);
        }
    }

   function bind( scope, fn ) {
        return function () {
            fn.apply( scope, arguments );
        };
    };

document.addEventListener( 'mousedown', bind( this, this.click ), false );

this.createNode();

}

