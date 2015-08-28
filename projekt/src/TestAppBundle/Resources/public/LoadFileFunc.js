/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function loadXMLDoc()
{

    var xhr = new XMLHttpRequest();
    var filevar = document.getElementById('testappbundle_obrazki_nazwa');
    console.log(filevar);
//    var files = filevar.file[0];
    var files = filevar;
    var formData = new FormData();
  
        formData.append('pliki', file);
    var url= $( '#myForm' ).attr( 'action' );

    xhr.open("POST",url, true);

    xhr.addEventListener('progress', function (e) {
        var done = e.position || e.loaded, total = e.totalSize || e.total;
        var fileprogres = document.getElementById("ladowanie");
        fileprogres.innerHtml = 'xhr progress: ' + (Math.floor(done / total * 1000) / 10) + '%';
    }, false);


    if (xhr.upload) {
        xhr.upload.onprogress = function (e) {
            var done = e.position || e.loaded, total = e.totalSize || e.total;
            var progresbar = document.getElementById("progressBar");
            progresbar.max = e.total;
            progresbar.value = e.loaded;
            var plik = document.getElementById("postep");
            plik.innerHTML = 'xhr.upload progress: ' + done + ' / ' + total + ' = ' + (Math.floor(done / total * 1000) / 10) + '%';

        };
    }
    xhr.onerror = function (e) {

        var bald = document.getElementById("odpowiedz");
        blad.innerHTML = 'xhr upload error' + e.error;


    }
    xhr.onreadystatechange = function (e) {
        if (4 == this.readyState && this.status == 200) {
            var odpowiedz = document.getElementById("odpowiedz");
            odpowiedz.innerHTML = 'xhr upload complete' + file.size;

        }

    };

    xhr.send(formData);
}



