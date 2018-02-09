jQuery(document).ready( function ($) {

  $("#register-modal .modal-body form").submit(function(e) {
      var url = "lib/registration.php"; // the script where you handle the form input.
      $.ajax({
             type: "POST",
             url: url,
             data: $(this).serialize(), // serializes the form's elements.
             success: function(data) {
                 //alert("Thank you!!!");
                 console.log(data);
             },
             error: function(data) {
                 alert("Error");
             }
           });
      //e.preventDefault(); // avoid to execute the actual submit of the form.
  });

});