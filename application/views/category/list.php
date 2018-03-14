<div class="container">
  <h2>Category</h2> 
  <form action="<?php echo $url;?>/category/delete" method="post"> 
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
		<th>User Id</th>
        <th>Category name</th>
		<th>Edit</th>
      </tr>
    </thead>
    <tbody>
	<?php
	foreach($listData as $key => $value)
	{
		echo "<tr>
		<th> <input type='checkbox' name='ids[]' value='".$value->catId."'> </th>
        <td>".$value->catId."</td>
        <td>".$value->catName."</td>
		<td><a href='".$url."/category/edit/".$value->catId."'>EDIT</a></td>
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
   window.location ='<?php echo $url;?>'+'/category/add';
});
</script>
