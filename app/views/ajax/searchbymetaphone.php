<p class="title">
	Maybe did you mean :
</p>

<div class="suggest_result">

	<?php
		while ($data_array = $data['marble']['adjectifs']->fetch()){
	?>
		<div
		class="more"
		onclick="
		getElementById('suggest').innerHTML = '';
		"
		onMouseOver="
		xhrObject('ajaxtest', 'searchContextsForObjet/<?php echo $data_array['id'];?>/<?php echo $data_array['name'];?>', false);
		"
		onMouseOut="
		getElementById('ajaxtest').innerHTML = '';
		objnew[0] = new makeTree(0, 0, 1, '<?php echo $_SESSION['user']['firstname']?>', userTree, 1);
		">
			<?php echo $data_array['name'];?>
			
		</div>
<?php
	}
	$data['marble']['adjectifs']->closeCursor();
?>
</div>

