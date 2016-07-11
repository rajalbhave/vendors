

//$.noConflict();
jQuery(document).ready(function($) {
	   $("#new-message-dialog").dialog({ 
			autoOpen: false,
			resizable: true,
			modal: true,
			width:'auto'
			
	   
	   });
	   $("#add-new-message").click(
            function () {
                $("#new-message-dialog").dialog('open');
                return false;
            }
        );
	   

	  $(function() {
   $( "#datepicker" ).datepicker().datepicker("setDate", new Date());
   $("#datepicker").datepicker("option", "minDate", 0);
	$('#timepicker').timepicker({
	controlType: 'select',
	oneLine: true,
	defaultTime: 'now',
	timeFormat: 'hh:mm tt'
		});
		$('#timepicker').timepicker("setDate", new Date());
  });

	
	
	
	
	$('#newMessage').validate({
		rules:{
			message:{
				required: true,
				minlength: 2
			}
			

		},
		
		messages:{
			cname:{
				required: "Please enter your message",
				minlength: "your message must consist of at least 2 characters"
			}
			
		},
		 submitHandler: function(form) {    var $form = $( this ),
          url = $form.attr( 'action' );
			$(form).ajaxSubmit({
				type:"POST",
                data: $(form).serialize(),
				url: url,
				success: function(data) { 
				var formData = $(form).serialize();
					//console.log(formData);
                    $('div#success').fadeIn();
					console.log(data);
					$(form)[0].reset();
					$( "#datepicker" ).datepicker().datepicker("setDate", new Date());
					 $(".display-message").html(data);
					 $("#new-message-dialog").dialog('close');
                },
				error: function() {
                      $('#error').fadeIn();
					  $("#new-message-dialog").dialog('close');
						
                }
				
			 });
		 }
	});
	
});