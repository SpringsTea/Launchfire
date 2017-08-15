$(document).on('click', 'button#submit', function() {
	var color = $('input#color').val();

	submitColor(color);//The word color looks really weird when you repeat it
});


function submitColor( color ){
	$.ajax({
      method:"POST",
      url: 'ajax/proxy.php',
      dataType: "json",
      data:{
      	c: color
      },
      success: function( result ){

		if( result.error ){
			alert(result.error.msg);
		}
		
		else if ( result.success === true ){
			$.when(
				$('div#form').children().fadeOut(800)
			)
			.done(
				function(){
					$('div#form').append('Success');
				}
			);
		}

		else if( result.success === false ){
			alert( 'Sorry!' );
		}

		else{
			alert( 'Something unexpected happened' );
		}

      }
    });
}