
if ( ! Detector.webgl ) Detector.addGetWebGLMessage();


htmlMarbleContainer = document.getElementById( 'marbleContainer' );
htmlMapContainer = document.getElementById( 'mapContainer' );
htmlSliceContainer = document.getElementById( 'sliceContainer' );


var marbleCamera, marbleScene, marbleRenderer;
var mapCamera, mapScene, mapRenderer;
var sliceCamera, sliceScene, sliceRenderer;

var stats;

rayCaster = function(camera){
        mouse = new THREE.Vector2();

    document.addEventListener( 'mousemove', onDocumentMouseMove, false );

    this.camera = camera;
    raycaster = new THREE.Raycaster();

    this.live = function (){
        raycaster.setFromCamera( mouse, marbleCamera.camera );
    }

    this.check= function(obj){
        var intersect = raycaster.intersectObject( obj );
        if ( intersect.length > 0 ) {
        //  console.log(intersect);
            return true;
        }else{
            return false;
        }
    }
}



function init() {


        //
        //--------------marbleScene
        //

        marbleScene = new THREE.Scene();
        marbleScene.fog = new THREE.Fog( 0x242424, 1000, 5000 );

        mapScene = new THREE.Scene();
        mapScene.fog = new THREE.Fog( 0x242424, 5000, 100000 );

        sliceScene = new THREE.Scene();
        sliceScene.fog = new THREE.Fog( 0x242424, 5000, 10000 );

        //
        //--------------DEVMODE
        //

        if(enable_dev_mod){

            //FPS
            stats = new Stats();
            stats.domElement.style.position = 'absolute';
            stats.domElement.style.top = '0px';
            htmlMarbleContainer.appendChild( stats.domElement );

            //Axis X Y Z
            var axisHelper = new THREE.AxisHelper( 1000 );
            marbleScene.add( axisHelper );

            //Grid
            var size = 5000;
            var step = 100;
            var marbleGridHelper = new THREE.GridHelper( size*4, 100 );
            var mapGridHelper = new THREE.GridHelper( size, step );
            var sliceGridHelper = new THREE.GridHelper( size, step );
            marbleGridHelper.material.transparent = true;
            marbleGridHelper.material.opacity = 0.2;
            marbleScene.add( marbleGridHelper );
            console.log(marbleGridHelper);

            mapScene.add( mapGridHelper );
            sliceScene.add( sliceGridHelper );

        }


        //
        //--------------RENDERER
        //

        marbleRenderer = new THREE.WebGLRenderer( { antialias: true } );
        marbleRenderer.setClearColor( marbleScene.fog.color, 1 ); 
        marbleRenderer.gammaInput = true;
        marbleRenderer.gammaOutput = true;
        htmlMarbleContainer.appendChild( marbleRenderer.domElement );
        
        //
        
        mapRenderer = new THREE.WebGLRenderer( { antialias: true } );
        mapRenderer.setClearColor( mapScene.fog.color, 1 ); 
        mapRenderer.gammaInput = true;
        mapRenderer.gammaOutput = true;
        htmlMapContainer.appendChild( mapRenderer.domElement );

        //

        sliceRenderer = new THREE.WebGLRenderer( { antialias: true } );
        sliceRenderer.setClearColor( sliceScene.fog.color, 1 ); 
        sliceRenderer.gammaInput = true;
        sliceRenderer.gammaOutput = true;
        htmlSliceContainer.appendChild( sliceRenderer.domElement );

        //
        //--------------CAMERA
        //

        marbleCamera = new CameraController( 90, htmlMarbleContainer, marbleRenderer, 1, 10000 );
        marbleCamera.camera.position.y = 200;    
        marbleCamera.camera.position.z = 500;    
        marbleCamera.camera.lookAt(new THREE.Vector3(0, 0, -300));
        marbleCamera.camera.rotation.z = 0;

        mapCamera = new CameraController( 90, htmlMapContainer, mapRenderer, 1, 10000 );
        mapCamera.camera.position.y = 1200;
        mapCamera.camera.rotation.x = -(90 * Math.PI / 180);

        sliceCamera = new CameraController( 10, htmlSliceContainer, sliceRenderer, 1, 10000 );
        sliceCamera.camera.position.z = 1500;


        //
        //--------------LIGHT
        //

        Light(marbleScene);
        Light(mapScene);
        Light(sliceScene);
 

        overSeer = new OverSeer();

        animate();
}

      //

      function animate() {
        timeNow = new Date().getTime();

        overSeer.live();

        marbleCamera.dolly.anime(timeNow);

        requestAnimationFrame( animate );
        render();
        stats.update();
    }

      //

      function render() {
        marbleRenderer.render( marbleScene, marbleCamera.camera );
        mapRenderer.render( mapScene, mapCamera.camera );
        sliceRenderer.render( sliceScene, sliceCamera.camera );
    }

    init();


