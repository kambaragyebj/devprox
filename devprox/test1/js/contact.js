
  $(document).ready(function(){

        $(document).on('click','#capture_info',function(){
                var first_name     = $('#first_name').val();
                var last_name      = $("#last_name").val();
                var id_number      = $("#id_number").val();
                var date_of_birth  = $("#date_of_birth").val();
                console.log(id_number);
                if(first_name !='' && last_name !='' && id_number !='' && date_of_birth !=''){
                      $.ajax({
                          url      : 'php/controller.php',
                          method   : 'post', 
                          data     : {first_name : first_name,last_name:last_name,id_number:id_number,date_of_birth:date_of_birth},
                          success  : function(data){
                                      
                                         var messageAlert = 'alert-success';
                                         var messageText  =  data;
                                         var alertBox    = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';
                                         $(".messages").html(alertBox);
                                         $('#first_name').val("");
                                         $("#last_name").val("");
                                         $("#id_number").val("");
                                         $("#date_of_birth").val("");
   
                                       
                                     }

                      });

              }else{

                 var messageAlert = 'alert-warning';
                 var messageText  = 'Please enter all the fields !' ;
                 var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>' + messageText + '</strong></div>';
                    
                  $(".messages").html(alertBox);
              }
            
         });
        $(document).on("input", "#id_number", function() {
             this.value = this.value.replace(/\D/g,'');
             var length = this.value.length;
             //console.log(length);

             if(!(this.value) || length>14){

                 var messageAlert = 'alert-warning';
                 var messageText  = 'Please enter a valid 13 Digit ID number !' ;
                 var alertBox = '<div id="cancle_id" class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';
                 $(".messages").html(alertBox); 
                 $("#id_number").val("");
             }
            

        });
        $('#first_name').keypress(function (e) {
                var regex = new RegExp("^[a-zA-Z]+$");
                var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
                if (regex.test(str)) {
                   return true;
                }
                else
                {
                   var messageAlert = 'alert-warning';
                   var messageText  = 'Please enter your first name with Alphabate letters!' ;
                   var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';
                   $(".messages").html(alertBox);
                   $("#first_name").val("");
                return false;
                }
        });
        $('#first_name').keypress(function (e) {
                var regex = new RegExp("^[a-zA-Z]+$");
                var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
                if (regex.test(str)) {
                   return true;
                }
                else
                {
                   var messageAlert = 'alert-warning';
                   var messageText  = 'Please enter your first name with Alphabate letters!' ;
                   var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';
                   $(".messages").html(alertBox);
                   $("#first_name").val("");
                return false;
                }
        });

        $('#reset_info').click(function(){
            //alert("You have clicked Me");
              $('#first_name').val("");
              $("#last_name").val("");
              $("#id_number").val("");
              $("#date_of_birth").val("");
   
        });


  });
