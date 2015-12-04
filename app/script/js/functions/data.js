dataConverter = function(){
	this.bddObjets = new Array();
	this.bddSlices = new Array();
	this.bddTrees = new Array();
	this.bddNodes = new Array();

	this.pullTree = function(idUser){
		//DOES IT EXIST ?
		if(this.bddTrees[idUser] === undefined){
			this.bddTrees[idUser] = new Array();
			xhrObject('dataConverter', 'pullTree/'+idUser+'/', false);
			this.bddTrees[idUser] = buildHierarchy( this.bddTrees[idUser] );
		}
		return this.bddTrees[idUser];
	}

	this.getTree = function(idUser, id, parent, idObjet){
		nodeName = this.pullObjetName(idObjet);
		this.bddTrees[idUser].push({"id": id, "parent": parent, "idObjet": idObjet, "nodeName": nodeName});
		this.bddNodes[id] = {"id": id, "parent": parent, "idObjet": idObjet, "nodeName": nodeName, "idUser": idUser};
	}

	this.pullSlice = function(idSlice){
		if(this.bddSlices[idSlice] === undefined){
			this.bddSlices[idSlice] = new Array();
			xhrObject('dataConverter', 'pullSlice/'+idSlice+'/', false);
		}
		return this.bddSlices[idSlice];
	}

	this.getSlice = function(idSlice, id, idAdjectif, score){
		this.bddSlices[idSlice].push({"id": id, "idAdjectif": idAdjectif, "score": score});
	}


	this.pullObjetName = function(idObjet){
		if(this.bddObjets[idObjet] === undefined){
			xhrObject('dataConverter', 'pullObjet/'+idObjet+'/', false);
		}
		return this.bddObjets[idObjet];
	}
	
	this.getObjetName = function(id, name){
		this.bddObjets[id] = name;
	}

}






function buildHierarchy(arry) {
    var roots = [], children = {};
    // find the top level nodes and hash the children based on parent
    for (var i = 0, len = arry.length; i < len; ++i) {
        var item = arry[i],
            p = item.parent,
            target = !p ? roots : (children[p] || (children[p] = []));

        target.push({ value: item });
    }

    // function to recursively build the tree
    var findChildren = function(parent) {
        if (children[parent.value.id]) {
            parent.children = children[parent.value.id];
            for (var i = 0, len = parent.children.length; i < len; ++i) {
                findChildren(parent.children[i]);
            }
        }
    };

    // enumerate through to handle the case where there are multiple roots
    for (var i = 0, len = roots.length; i < len; ++i) {
        findChildren(roots[i]);
    }

    return roots;
}
