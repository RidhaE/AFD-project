$(document).ready(function() {
 
     
    $('#nomprenom').on('input', function() {
          var regEx=/[^a-zA-Z]/;
        if ($("#nomprenom").val().length <= 24) {
            $("#label1").removeClass("text-danger");
            $("#nomprenom").removeClass("is-invalid");
            $("#nomprenomHelp").hide();
            check = true;
            console.log(check);
            
          }
          else {
            $("#label1").addClass("text-danger");
            $("#nomprenom").addClass("is-invalid");
            $("#nomprenomHelp").show();
            check = false;
    
      }


       
    });

        $('#codebanque').on('input', function() {
          var regEx=/[^a-zA-Z]/;
        if ($.isNumeric($("#codebanque").val()) && $("#codebanque").val().length <= 5) {
            $("#label2").removeClass("text-danger");
            $("#codebanque").removeClass("is-invalid");
            $("#codebancqueHelp").hide();
            check = true;
      
          }
          else {
            $("#label2").addClass("text-danger");
            $("#codebanque").addClass("is-invalid");
            $("#codebancqueHelp").show();
            check = false;
      
      }
    });

       $('#codeguichet').on('input', function() {
          var regEx=/[^a-zA-Z]/;
        if ($.isNumeric($("#codeguichet").val()) && $("#codeguichet").val().length <= 5) {
            $("#label3").removeClass("text-danger");
            $("#codeguichet").removeClass("is-invalid");
            $("#codeguichetHelp").hide();
            check = true;
          
          }
          else {
            $("#label3").addClass("text-danger");
            $("#codebanque").addClass("is-invalid");
            $("#codeguichetHelp").show();
            check = false;
    
      }
    });

      $('#numcompte').on('input', function() {
          var regEx=/[^a-zA-Z]/;
        if ($.isNumeric($("#numcompte").val()) && $("#numcompte").val().length <= 5) {
            $("#label4").removeClass("text-danger");
            $("#numcompte").removeClass("is-invalid");
            $("#numcompteHelp").hide();
            check = true;
     
          }
          else {
            $("#label4").addClass("text-danger");
            $("#numcompte").addClass("is-invalid");
            $("#numcompteHelp").show();
            check = false;
        
      }
    });

      $('#numcompte').on('input', function() {
          var regEx=/[^a-zA-Z]/;
        if ($.isNumeric($("#numcompte").val()) && $("#numcompte").val().length <= 11) {
            $("#label4").removeClass("text-danger");
            $("#numcompte").removeClass("is-invalid");
            $("#numcompteHelp").hide();
            check = true;
     
          }
          else {
            $("#label4").addClass("text-danger");
            $("#numcompte").addClass("is-invalid");
            $("#numcompteHelp").show();
            check = false;
        
      }
    });


      $('#montant').on('input', function() {
          var regEx=/[^a-zA-Z]/;
        if ($.isNumeric($("#montant").val()) && $("#montant").val().length <= 16) {
            $("#label5").removeClass("text-danger");
            $("#montant").removeClass("is-invalid");
            $("#montantHelp").hide();
            check = true;
         
          }
          else {
            $("#label5").addClass("text-danger");
            $("#montant").addClass("is-invalid");
            $("#montantHelp").show();
            check = false;
       
      }
    });

     $('#motif').on('input', function() {
          var regEx=/[^a-zA-Z]/;
        if ($("#motif").val().length <= 32) {
            $("#label6").removeClass("text-danger");
            $("#motif").removeClass("is-invalid");
            $("#motifHelp").hide();
            check = true;
          }
          else {
            $("#label6").addClass("text-danger");
            $("#motif").addClass("is-invalid");
            $("#motifHelp").show();
            check = false;
      }
    });
    
  
    
  

});