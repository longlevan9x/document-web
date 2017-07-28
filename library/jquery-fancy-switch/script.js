 $(document).ready(function(){

 	// select on button for default
 	$('input.b_on').attr("checked",true);
 

	$('.switch-2').css('background-image', 'url("images/on.png")');
 	$('.switch-3').css('background-image', 'url("images/on-3.png")');
 	$('.switch-4').css('background-image', 'url("images/on-4.png")');
 	$('.switch-5').css('background-image', 'url("images/black-on-1.png")');
 	$('.switch-6').css('background-image', 'url("images/black-on-2.png")');
 	$('.switch-7').css('background-image', 'url("images/black-on-3.png")');
 	$('.switch-8').css('background-image', 'url("images/small-on.png")');


    $("input[name=on_off]").change(function() {
      var button = $(this).val();
      	if(button == 'on'){ $('.switch').css('background-position', 'left'); } 
        if(button == 'off'){ $('.switch').css('background-position', 'right'); }
         
        $('.result span').html(button);
        $('.result').fadeIn();
 
   });

    $("input[name=on_off_2]").change(function() {
      	var button = $(this).val();
      	if(button == 'on'){ $('.switch-2').css('background-image', 'url(images/on.png)'); }
        if(button == 'off'){ $('.switch-2').css('background-image', 'url("images/off.png")'); }
      
        $('.result span').html(button);
        $('.result').fadeIn();
 
   });

	$("input[name=on_off_3]").change(function() {
      	var button = $(this).val();
      	if(button == 'on'){ $('.switch-3').css('background-image', 'url(images/on-3.png)'); }
        if(button == 'off'){ $('.switch-3').css('background-image', 'url("images/off-3.png")'); }
   
        $('.result span').html(button);
        $('.result').fadeIn();
 
   });

	$("input[name=on_off_4]").change(function() {
      	var button = $(this).val();
      	if(button == 'on'){ $('.switch-4').css('background-image', 'url(images/on-4.png)'); } 
        if(button == 'off'){ $('.switch-4').css('background-image', 'url("images/off-4.png")'); }
     
        $('.result span').html(button);
        $('.result').fadeIn();
 
   });

	$("input[name=on_off_5]").change(function() {
      	var button = $(this).val();
      	if(button == 'on'){ $('.switch-5').css('background-image', 'url(images/black-on-1.png)'); }  
        if(button == 'off'){ $('.switch-5').css('background-image', 'url("images/black-off-1.png")'); }
               
        $('.result span').html(button);
        $('.result').fadeIn();
 
   });

	$("input[name=on_off_6]").change(function() {
      	var button = $(this).val();
      	if(button == 'on'){ $('.switch-6').css('background-image', 'url(images/black-on-2.png)'); } 
        if(button == 'off'){ $('.switch-6').css('background-image', 'url("images/black-off-2.png")'); }
 
        $('.result span').html(button);
        $('.result').fadeIn();
 
   });

	$("input[name=on_off_7]").change(function() {
      	var button = $(this).val();
      	if(button == 'on'){ $('.switch-7').css('background-image', 'url(images/black-on-3.png)'); } 
        if(button == 'off'){ $('.switch-7').css('background-image', 'url("images/black-off-3.png")'); }
         
               
         $('.result span').html(button);
         $('.result').fadeIn();
 
   });

	$("input[name=on_off_8]").change(function() {
      	var button = $(this).val();
      	if(button == 'on'){ $('.switch-8').css('background-image', 'url(images/small-on.png)'); }
        if(button == 'off'){ $('.switch-8').css('background-image', 'url("images/small-off.png")'); }
          
               
         $('.result span').html(button);
 
   });

});

