<div class="container">
  <h2><?php echo ucfirst($mode);?> Product</h2> 
  <div class="row">
	<div style="color:red">
	<?php echo validation_errors(); 
	$str = '';
	if($mode == 'add')
	{
		$str.= $url.'/Product/add';
	}
	else
	{
		$str.= $url.'/Product/edit/'.$singleRecord->productId;
	}
	?>
	</div>
	<form action="<?php echo $str;?>" method="post" enctype="multipart/form-data">
		<?php 
		if($mode == 'edit')
		{
			echo '<input type="hidden" name="productId" value="'.$singleRecord->productId.'" >';
		}?>
		
		<div class="form-group">
			<label>Product Name</label>
			<input type="text" name='productName' class="form-control" placeholder="Product Name" value="<?php echo (($mode=='edit')? $singleRecord->productName : '')?>" >
		</div>
		<div class="form-group">
			<label>Product Image</label>
			<br>
			<?php 
			if(($mode=='edit') && ($singleRecord->productImage) != '')
			{
				echo '<input type="hidden" name="productImageStatus" class="form-control" value="yes">';
				
				echo '<img src="'.$singleRecord->productImage.'" ><br><a href="'.$url.'/Product/removeImage/'.$singleRecord->productId.'"><button type="button" class="btn btn-danger" style="width: 138px;margin-top: 10px;">Remove</button></a>';
			}
			else
			{
				echo '<input type="hidden" name="productImageStatus" class="form-control" value="no" >';
				
				echo '<input type="file" name="productImage" class="form-control" >';
			}
			
			?>
			
			
		</div>
		<div class="form-group">
			<label>Category</label>
			<select name='catId' class="form-control" >
			<option value="">Select category</option>
			<?php
				foreach($categoryList as $key => $value)
				{
					if($singleRecord->catId == $value->catId)
					{
						echo '<option value="'.$value->catId.'" selected>'.$value->catName.'</option>';
					}
					else
					{
						echo '<option value="'.$value->catId.'">'.$value->catName.'</option>';
					}
				}
			?>
			</select>
		</div>
		<div class="form-group">
			<label>User</label>
			<select name='userId' class="form-control" >
			<option value="">Select user</option>
			<?php
				foreach($userList as $key => $value)
				{
					if($singleRecord->userId == $value->userId)
					{
						echo '<option value="'.$value->userId.'" selected>'.$value->fName.' '.$value->lName.'</option>';
					}
					else
					{
						echo '<option value="'.$value->userId.'">'.$value->fName.' '.$value->lName.'</option>';
					}
				}
			?>
			</select>
		</div>
		
		<button type="submit" class="btn btn-success">Save</button>
		<a href='<?php echo $url;?>/Product'><button type="button" class="btn btn-danger">Cancel</button></a>
	</form>
	</div>
</div>