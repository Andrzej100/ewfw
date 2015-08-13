<?php 

var_dump($_FILES);
if(!empty($_FILES)) {
		
	$data = file_get_contents($_FILES['test']['tmp_name']);
	file_put_contents(__DIR__.'/'.'upload.jpg', $data);

}


?>

<html><body>


<form method="POST" enctype="multipart/form-data">
<input type="file" name="test" />
<input type="submit" value="ok"/>
</form>



<image src="upload.jpg" />

</body></html>