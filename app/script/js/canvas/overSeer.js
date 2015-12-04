OverSeer = function(){

        dataPuller = new dataConverter();        
        mouseHover = new rayCaster(marbleCamera.camera);

        path = new mainControlPath(dataPuller.bddNodes);

        mapTree = new makeAMap( dataPuller.pullTree(userId), 360);
        
        marbleTree = new makeATree(marbleScene, marbleCamera, 160, dataPuller.pullTree(userId));
        sliceViewer = new makeASlice();

        marbleTree.createUserTree();
        mapTree.addToScene(mapScene);  




    this.goTo = function(nodeId){

        marbleTree.camera.slidingGo(marbleTree.nodes[nodeId].mesh);
        path.jumpTo(nodeId);

    }

    this.live = function(){
        mouseHover.live();
    	marbleTree.live();
    }

}

