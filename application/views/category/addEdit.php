<div class="container">
  <h2><?php echo ucfirst($mode);?> Category</h2> 
  <div class="row">
	<div style="color:red">
	<?php echo validation_errors(); 
	$str = '';
	if($mode == 'add')
	{
		$str.= $url.'/category/add';
	}
	else
	{
		$str.= $url.'/category/edit/'.$singleRecord->catId;
	}
	?>
	</div>
	<form action="<?php echo $str;?>" method="post">
		<?php 
		if($mode == 'edit')
		{
			echo '<input type="hidden" name="catId" value="'.$singleRecord->catId.'" >';
		}?>
		
		<div class="form-group">
			<label>Category Name</label>
			<input type="text" name='catName' class="form-control" placeholder="Category Name" value="<?php echo (($mode=='edit')? $singleRecord->catName : '')?>" >
		</div>
		<button type="submit" class="btn btn-success">Save</button>
		<a href='<?php echo $url;?>/category'><button type="button" class="btn btn-danger">Cancel</button></a>
	</form>
	</div>
</div>