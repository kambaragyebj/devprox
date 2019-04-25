
  $(document).ready(function(){

        $(document).on('click','#gen_no',function(){
            //alert("You have clicked Me");
              var record_no     = $('#record_number').val();  
               
               if(record_no !=''){

                  $.ajax({
                       beforeSend:function() { 
                         $('#ajaxloading').show();
                       },

                      url      : 'main.php',
                      method   : 'post', 
                      data     : {record_no : record_no},
                      complete: function(){
                          $('#ajaxloading').hide();
                      },
                      success  : function(data){
                                  $('#ajaxloading').hide();

                                  var messageAlert = 'alert-success';
                                  var messageText  =  "Thank you,record Generated";
                                  var alertBox    = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';
                                  $(".messages").html(alertBox);
                                  $("#record_number").val("");      
                                 }

                  });
                }else{


                    alert("Please enter the number of records you want to generate");
                }

            
        });
       
       $(document).on('click','#file_no',function(){ 
           var file_data = $('#fileName').prop('files')[0];
           var form_data = new FormData();
           form_data.append('fileName', file_data);
           $.ajax({
              
                url: 'upload.php', 
                dataType: 'text', 
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
               
                success: function (data) {
                         var messageAlert = 'alert-success';
                         var messageText  =  data;
                         var alertBox     = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';
                         $(".messages").html(alertBox);
                         $("#fileName").val("");
                },
                error: function (data) {
                          alert(data);
                        //$('#msg').html(data); 
                }
           });
       });


  });
