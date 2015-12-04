/*----------------PATH------------------*/
//this.path : ARRAY Id Name Type CSSStyle;
// [0]: ID : '58';
//		TYPE : 'Title';
//		NAME : 'Musique';
//		CSSSTYLE : red(255,28,10);

mainControlPath = function(nodes){

	this.nodes = nodes;

	this.div_path = document.getElementById('search_path');

	this.addElement = function(path_element){
		this.div_path.innerHTML += '<div class="search_path_element" id="'+path_element.id+'" onClick="overSeer.goTo('+path_element.id+');">'+path_element.nodeName+'</div>';
	}


	this.removeElement = function(path_element){
		var old = document.getElementById(path_element);
		this.div_path.removeChild(old);
	}

	this.clearAllElement = function(){
		while (this.div_path.firstChild) {
			this.div_path.removeChild(this.div_path.firstChild);
		}
	}

	this.rootPath = function(sliceId){
			if(this.nodes[sliceId].parent != '0'){
				this.rootPath(this.nodes[sliceId].parent);
			}else{
				arrayPath.push({"id": "0", "nodeName": "USER"});
			}

		arrayPath.push({"id": sliceId, "nodeName": this.nodes[sliceId].nodeName});

		return arrayPath;
	}

	this.jumpTo = function(sliceId){
		arrayPath = new Array();
		arrayPath = this.rootPath(sliceId);
		this.clearAllElement();

		for(key in arrayPath){
			this.addElement(arrayPath[key]);
		}
	}
}

