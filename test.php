<!DOCTYPE html>
<html>
<head>
</head>
<body>

 



<form action="test2.php" method="POST" enctype="multipart/form-data">
<input type="file" name="test"  id="file"/>
<input type="button"  value="ok" onClick="loadXMLDoc()"/>
</form>
<div id="ladowanie"></div>
<div id="postep"></div>
<div id="odpowiedz">asd</div>
<script type='text/javascript' >
function loadXMLDoc()
{
	
	var xhr=new XMLHttpRequest();
	var filevar=document.getElementById('file');
	var file=filevar.files[0];
	var formData = new FormData();
    formData.append("thefile", file);
	
	xhr.open("POST","test2.php",true);
	
	xhr.addEventListener('progress', function(e) {
		 var done = e.position || e.loaded, total = e.totalSize || e.total;
		        var fileprogres = document.getElementById("ladowanie");
				fileprogres.innerHtml = 'xhr progress: ' + (Math.floor(done/total*1000)/10) + '%';
	}, false);
	
	if ( xhr.upload ) {
		xhr.upload.onprogress = function(e) {
                    var done = e.position || e.loaded, total = e.totalSize || e.total;
				    var plik = document.getElementById("postep");
					plik.innerHTML = 'xhr.upload progress: ' + done + ' / ' + total + ' = ' + (Math.floor(done/total*1000)/10) + '%';
                    
                };
	}
	
	xhr.onreadystatechange = function(e) {
                if ( 4 == this.readyState && this.status == 200 ) {
					var odpowiedz= document.getElementById("odpowiedz");
                    odpowiedz.innerHTML = 'xhr upload complete' + file.size;
					
                }
            };

	xhr.send(formData);
}
</script>



</body></html>