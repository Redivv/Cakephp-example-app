$(document).ready(function(){
	main();
	listener_contact();
	$('.owl-carousel').owlCarousel({
	    loop:true,
	    margin:20,
	    nav:false,
	    responsive:{
	        0:{
	            items:2
	        },
	        600:{
	            items:3
	        },
	        1000:{
	            items:4
	        }
	    }
	});
});
// FUNCTION MAIN

function main(){

}

function listener_contact(){
	$('.contact_btn').on('click', function(){
		$('.error').css('display', 'none');
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: '/cakephp/send.php',
			data:
			{
				name:$('#c_name').val(),
				email:$('#c_email').val(),
				text:$('#c_text').val()
			}
		})
		.done(function(data)
		{
			if(data.type=='error')
			{
				$.each(data.code, function(k,v)
				{
					$('.err_c_'+k) .html(v) .css('display','block');
				});
			}
			else
			{
				$('.kontakt_box_all1').css('display','none');
				$('.kontakt_box_all2').css('display','block').html(data.code);
			}
		});
	});
}
