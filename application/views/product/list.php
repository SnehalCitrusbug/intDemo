<div class="container">
  <h2>Product</h2> 
  <form action="<?php echo $url;?>/Product/delete" method="post"> 
	<div class='row'>
		<div class='pull-right'>
		<button type="button" class='btn-success' id="addForm">Add</button>
		<button type="submit" class='btn-danger'>Delete</button>
		</div>
	</div>
<section>
  <table class="table">
    <thead>
      <tr>
		<th> <input type="checkbox" id="checkAll" value=""> </th>
		<th>Product Id</th>
        <th>Product name</th>
		<th>Category name</th>
		<th>User name</th>
		<th>Product Image</th>
		<th>Edit</th>
      </tr>
    </thead>
    <tbody>
	<?php
	foreach($listData as $key => $value)
	{
		echo "<tr>
		<th> <input type='checkbox' name='ids[]' value='".$value->productId."'> </th>
        <td>".$value->productId."</td>
        <td>".$value->productName."</td>
		<td>".$value->catId."</td>
		<td>".$value->userId."</td>
		<td><img src='".$value->productImage."' style='width:100px;border-radius: 10px;'></td>
		<td><a href='".$url."/Product/edit/".$value->productId."'>EDIT</a></td>
      </tr>";
	}
	?>
     
    </tbody>
  </table>
  </section>
  <div class="pagination pull-right">
    <ul>
       <?php echo $links ?>
    </ul>    
</div>
  
  </form>
</div>
<script>
$('#addForm').click(function() {
   window.location ='<?php echo $url;?>'+'/product/add';
});
</script>

