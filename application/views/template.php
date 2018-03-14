<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>DEMO</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  
</head>
<style>
.row
{
	margin: 10px;
}
</style>
<body>
<?php 
include($fileName);
?>
</body>
<script>
$(document).ready(function() {
	
    $('#checkAll').click(function() {
		
		if (! $('input:checkbox').is('checked')) {
			  $('input:checkbox').attr('checked','checked');
		  } else {
			  $('input:checkbox').prop("checked", true);
		  }         
    });
});

</script>
</html>