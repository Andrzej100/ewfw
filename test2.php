<html>
<head>
</head>
<body>
<?php
$fileNme=$_FILES['thefile']['name'];
$fileType=$_FILES['thefile']['type'];
$uploads_dir="C:\\xampp\\htdocs\\test\\uploads\\".$fileNme;
move_uploaded_file($_FILES['thefile']['tmp_name'],$uploads_dir);
?>

</body></html>