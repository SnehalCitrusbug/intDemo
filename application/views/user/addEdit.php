<div class="container">
  <h2><?php echo ucfirst($mode);?> Users</h2> 
  <div class="row">
	<div style="color:red">
	<?php echo validation_errors(); 
	$str = '';
	if($mode == 'add')
	{
		$str.= $url.'/user/add';
	}
	else
	{
		$str.= $url.'/user/edit/'.$singleRecord->userId;
	}
	?>
	</div>
	<form action="<?php echo $str;?>" method="post">
		<?php 
		if($mode == 'edit')
		{
			echo '<input type="hidden" name="userId" value="'.$singleRecord->userId.'" >';
		}?>
		
		<div class="form-group">
			<label>First Name</label>
			<input type="text" name='fName' class="form-control" placeholder="First Name" value="<?php echo (($mode=='edit')? $singleRecord->fName : '')?>" >
		</div>
		<div class="form-group">
			<label>Last Name</label>
			<input type="text" name='lName' class="form-control" placeholder="Last Name" value="<?php echo (($mode=='edit')? $singleRecord->lName : '')?>" >
		</div>
		<button type="submit" class="btn btn-success">Save</button>
		<a href='<?php echo $url;?>/user'><button type="button" class="btn btn-danger">Cancel</button></a>
	</form>
	</div>
</div>