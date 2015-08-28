/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function initAjaxForm()
{
    $('form').on('click', '#testappbundle_obrazki_button', function (e) {
      // var data = new FormData($('#formik')[0]);
        e.preventDefault();
           
        var imie=$("#testappbundle_obrazki_nazwa").val();
        var plik = document.getElementById("testappbundle_obrazki_data").files[0];
//        console.log(plik)
        var formdata= new FormData();
        formdata.append('data',plik);
        formdata.append('nazwa',imie);
//        formdata.append('testappbundle_obrazki[nazwa]',imie);
        
      
      //  var xhr = new XMLHttpRequest();
      //  xhr.onreadystatechange = function (e) {
      //  if (4 == this.readyState && this.status == 200) {
            
        //var columns = JSON.parse(xhr.Response);
        //document.getElementById("div").innerHTML=columns;
       
       //console.log(zmienna['message']);
     //  console.log(xhr.ResponseText);
  //  }
     //   };
    //    xhr.open('POST', $('form').attr('action'));
    //    xhr.send(formdata);
     //   function myFunction(response) {
  //  var arr = JSON.parse(response);
    //   var out=arr[0];
  //      document.getElementById("div").innerHTML= out;
  //  }
  $(".loading-progress").width(400);
  var progress = $(".loading-progress").progressTimer({
	  timeLimit: 10,showHtmlSpan: true,
	  onFinish: function () {
           $("#info").html('Pobieranie ukonczone');
       }
   });
      
    
               $.ajax({           type:'POST',
            url: $('form').attr('action'),
            //data: {'testappbundle_obrazki': {'nazwa':imie, 'data':plik}},
            data: formdata,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false
       
        })
                
        .done(function (data) {
            progress.progressTimer('complete');
            if (typeof data.nazwa !== 'undefined') {
                
                var info='Nazwapliku :'+ data.nazwa+'<br>'+
                      'rozmiar:'+ data.rozmiar+'<br>'+
                        'typ:'+ data.typ+'<br>'+
                        'sciezka tymczasowa:'+data.tymczasowa+'<br>'+
                        data.wiadomosc;
                 $("#infoserver").html(info);
            }
       })
       .error(function(){
	  progress.progressTimer('error', {
	  errorText:'ERROR!',
	  onFinish:function(){
              $("#error").html('Wystapil blad podczas przesylania');
        }
          });
      })
      
       
        .fail(function (jqXHR, textStatus, errorThrown) {
           if (typeof jqXHR.responseJSON !== 'undefined') {
                if (jqXHR.responseJSON.hasOwnProperty('form')) {
                    $('#form_body').html(jqXHR.responseJSON.form);
               }

               $('.form_error').html(jqXHR.responseJSON.message);

           } else {
               alert(errorThrown);
           }
 
        });
    });
}

