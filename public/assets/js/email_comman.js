//Common Event Trigger for emails app
$(document).ready(function() {
			var selectedItems=0;
			//Table Row Click Event
			$(document).on('click', '.clickable', function (event) {
			//$('.clickable').click( function() {
				$('#inbox-wrapper').addClass('animated fadeOut');
				$('#inbox-wrapper').hide();					
				$('#preview-email-wrapper').addClass('animated fadeIn ');			
				$('#preview-email-wrapper').show();			
				$('.page-title').show();	
				//Load email details
				$('#inbox-wrapper').removeClass('animated fadeOut');			
				$('#inbox-wrapper').removeClass('animated fadeIn');			
			});
			
			//Back Button Event 
			$(document).on('click', '#btn-back', function (event) {
//			$('#btn-back').click( function() {							
				$('#inbox-wrapper').addClass('animated fadeIn');
				$('#inbox-wrapper').show();									
				$('#preview-email-wrapper').addClass('animated fadeOut');			
				$('#preview-email-wrapper').hide();			
				$('.page-title').hide();				
				$('#preview-email-wrapper').removeClass('animated fadeIn ');				
				$('#preview-email-wrapper').removeClass('animated fadeOut ');				
			});
			
			//Check box select Event
			//Trigger Quick bar
			$(document).on('click', '#email-list .checkbox input', function (event) {
//			$('#email-list .checkbox input').click( function() {			
				if($(this).is(':checked')){
					selectedItems++;
					$("#quick-access").css("bottom","0px");	
					$(this).parent().parent().parent().toggleClass('row_selected');					
				}
				else{					
						selectedItems--;
						$("#quick-access").css("bottom","0px");	
						$(this).parent().parent().parent().toggleClass('row_selected');		
				}
				if(selectedItems==0){
						$("#quick-access").css("bottom","-115px");
				}
			});
			
			//Adjust Page layout to condensed
			$('.page-content').css('margin-left','50');
			
			//Quick action dismiss Event
			$(document).on('click', '#quick-access .btn-cancel', function (event) {
			//$('#quick-access .btn-cancel').click( function() {
					$("#quick-access").css("bottom","-115px");
					$('#email-list .checkbox').children('input').attr('checked', false);
					$("#emails tbody tr").removeClass('row_selected');			
			});	
			
});