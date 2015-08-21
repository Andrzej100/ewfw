<!DOCTYPE html>
<html>
<head>
</head>
<body>
 
 
 
 
 
<form action="test2.php" method="POST" enctype="multipart/form-data">
<input type="file" name="pliki[]"  id="file" multiple />
<input type="button"  value="ok" onClick="loadXMLDoc()"/>
</form>
<progress id="progressBar" value="0" max="100">  
 </progress>  
<div id="ladowanie"></div>
<div id="postep"></div>
<div id="odpowiedz">asd</div>
<script type='text/javascript' >
function loadXMLDoc()
{
       
        var xhr=new XMLHttpRequest();
        var filevar=document.getElementById('file');
        var files=filevar.files;
        var formData = new FormData();
        for (var i = 0; i < files.length; i++) {
    var file = files[i];
    formData.append('pliki[]',file,file.name);
    }
       
        xhr.open("POST","test2.php",true);
       
        xhr.addEventListener('progress', function(e) {
                 var done = e.position || e.loaded, total = e.totalSize || e.total;
                        var fileprogres = document.getElementById("ladowanie");
                                fileprogres.innerHtml = 'xhr progress: ' + (Math.floor(done/total*1000)/10) + '%';
        }, false);
       
       
        if ( xhr.upload ) {
                xhr.upload.onprogress = function(e) {
                    var done = e.position || e.loaded, total = e.totalSize || e.total;
                                        var progresbar = document.getElementById("progressBar");
                                        progresbar.max=e.total;
                                        progresbar.value=e.loaded;
                                    var plik = document.getElementById("postep");
                                        plik.innerHTML = 'xhr.upload progress: ' + done + ' / ' + total + ' = ' + (Math.floor(done/total*1000)/10) + '%';
                   
                };
        }
        xhr.onerror = function(e) {
                       
                var bald = document.getElementById("odpowiedz");
                blad.innerHTML = 'xhr upload error' + e.error;
               
       
        }
        xhr.onreadystatechange = function(e) {
                if ( 4 == this.readyState && this.status == 200 ) {
                                        var odpowiedz = document.getElementById("odpowiedz");
                    odpowiedz.innerHTML = 'xhr upload complete' + file.size;
                                       
                }
 
            };
 
        xhr.send(formData);
}
</script>
 
 
 

    </body></html>
