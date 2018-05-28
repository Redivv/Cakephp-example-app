$(document).ready(function(){
	main();
	listener_contact();
	$('#owl-about').owlCarousel({
	    loop:true,
	    margin:20,
	    nav:false,
	    responsive:{
	        0:{
	            items:2
	        },
	        810:{
	            items:3
	        },
	        1250:{
	            items:4
	        }
	    }
	});
	$('#owl-index').owlCarousel({
	    loop:true,
	    margin:0,
	    nav:true,
			navText:["<i class='fas fa-arrow-left'></i>","<i class='fas fa-arrow-right'></i>"],
	    responsive:{
	        0:{
	            items:1
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
