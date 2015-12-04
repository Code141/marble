<aside class="left" id="left">
	
	<div id="arbo">		
		<p class="title">My Arborescance</p>

				<form class="add_slice" method="post" onsubmit="
				xhrObject('ajaxtest', 'addSlice/'+this.elements[0].value, true);
				xhrObject('ajaxtest', 'refreshtree', false);
				return false;
				">
					<input id="add_slice" type="text" value=" + Add new slice" name="add_slice" onFocus="this.value='';" onBlur="if(this.value==''){this.value=' + Add new slice';}">
				</form>
				
				<?php
				while ($data_array = $data['marble']['mytree']->fetch()){
					$bddBranches[$data_array['id']]['id'] = $data_array['id'];
					$bddBranches[$data_array['id']]['label'] = $data_array['name'];
					$bddBranches[$data_array['id']]['parent_id'] = $data_array['id_parent_slice'];
				}
				$userTree = createTree($bddBranches);
				?>
				
				<div id="list_tree">
				<script>
				var userBranches = <?php echo json_encode($bddBranches);?>;
				var userTree = <?php echo json_encode($userTree);?>;
				$(function() {
					$('#list_tree').tree({
						data: userTree,
						dragAndDrop: true,
					});
				});

				$('#list_tree').bind(
					'tree.contextmenu',
					function(event) {

						if (confirm('delete '+event.node.id+' ?')) { 
						}

					}
					);
				$('#list_tree').bind('tree.move',function(event) {
				/*
					console.log('moved_node', event.move_info.moved_node);
  	    	  		console.log('target_node', event.move_info.target_node);
        			console.log('position', event.move_info.position);
        			console.log('previous_parent', event.move_info.previous_parent);
        		*/  

        		if(event.move_info.position == 'after'){
        			moveto = event.move_info.target_node.parent.id;
        		}else if (event.move_info.position == 'inside'){
        			moveto = event.move_info.target_node.id;
        		}

        		if(moveto === undefined){
        			//alert(event.move_info.position);
        			moveto = 0;
        		}

        		xhrObject('', 'moveTreeNode/'+event.move_info.moved_node.id+'/'+moveto, false);
        		xhrObject('list_tree', 'refreshtree', false);
        		});
				</script>
				</div>

	</div>

	<div id="dossier">		
		<p class="title">
			Dossiers
		</p>
	</div>

	<div id="map">		
		<p class="title">
			Map
		</p>
				<div id="mapContainer">

				</div>
	</div>
	
</aside>