
function fill(Value) {

     $('#search').val(Value);

     $('#display').hide();
   }
   $(document).ready(function() {

     $("#search").keyup(function() {

         const plate_numbers = $('#search').val();

         if (plate_numbers == "") {

             $("#display").html("");
         }

         else {

             $.ajax({

                 type: "POST",

                 url: "ajax.php",

                 data: {

                     search: plate_numbers
                 },

                 success: function(html) {

                     $("#display").html(html).show();
                 }
             });
         }
     });
   });