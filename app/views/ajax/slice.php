<div class="slice" id="<?php echo $data['research'];?>">
	<p class="slicetitle">
		Slice : <?php echo $data['name'].' CTX : '.$data['ctxslice'];?>
	<p/>
	<?php
	while ($data_array = $data['marble']['adjectifs']->fetch()){
	?>
		<span class="<?php echo $data['research'];?>Name name"><?php echo $data_array['name'];?></span>
		<span class="<?php echo $data['research'];?>Score score"><?php echo $data_array['score'];?></span>
<?php	if($data['sliceOwned']){
?>
		<span class="destroyAdj" onclick="
			xhrObject('', 'destroyAdjSlice/<?php echo $data_array['id'];?>', false);
			xhrObject('ajaxslice', 'getSliceById/<?php echo $data['research'].'/'.$data['ctxslice'].'/'.$data['name'];?>/', false);
		">
		</span>

		<?php
	}?>
		<hr>

<?php
	}
	$data['marble']['adjectifs']->closeCursor();

	if($data['sliceOwned']){
	?>
	
	<form class="add_adj" method="post" onsubmit="
	xhrObject('', 'addAdjSlice/<?php echo $data['research'];?>/'+this.elements[0].value, false);
	xhrObject('ajaxslice', 'getSliceById/<?php echo $data['research'].'/'.$data['ctxslice'].'/'.$data['name'];?>/1', false);
	return false;
	">
		<input id="add_adj" type="text" value=" + Add new adjectif for this slice" name="add_adj" onFocus="this.value='';" onBlur="if(this.value==''){this.value=' + Add new adjectif for this slice';}">
	</form>
	<?php
	};
	?>
		
</div>

	