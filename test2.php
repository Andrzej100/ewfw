<html>
<head>
</head>
<body>
<?php
if(!empty($_FILES['pliki'])){
foreach  ($_FILES['pliki']['name'] as $key => $name) {
$fileNme=$_FILES['pliki']['name'][$key];
$fileType=$_FILES['pliki']['type'][$key];
$uploads_dir="D:\\xampp\\htdocs\\test\\uploads\\".$fileNme;
move_uploaded_file($_FILES['pliki']['tmp_name'][$key],$uploads_dir);
}}aa
?>
 
</body></html>