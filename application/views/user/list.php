<div class="container">
  <h2>Users</h2> 
  <form action="<?php echo $url;?>/user/delete" method="post"> 
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
        <th>First name</th>
        <th>Last name</th>  
		<th>Edit</th>
      </tr>
    </thead>
    <tbody>
	<?php
	foreach($listData as $key => $value)
	{
		echo "<tr>
		<th> <input type='checkbox' name='ids[]' value='".$value->userId."'> </th>
        <td>".$value->userId."</td>
        <td>".$value->fName."</td>
        <td>".$value->lName."</td>
		<td><a href='".$url."/user/edit/".$value->userId."'>EDIT</a></td>
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
   window.location ='<?php echo $url;?>'+'/user/add';
});
</script>
