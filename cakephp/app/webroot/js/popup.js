	$(document).ready(function()
	{
		nasluchiwacz_slider();
		nasluchiwacz_folder();
	});
// funkcja zamykająca popupowe okienko
	function close1(){
		$('#light').hide();
		$('*').css('overflow','visible');
		$('#fade').hide();
	}
// funkcja otwieracjąca popupowe okienko
	function box(){
		$('#light').show();
		$('*').css('overflow','hidden');
		$('#fade').show();
	}
	function close2() {
		$('#light2').hide();
		$('*').css('overflow','visible');
		$('#fade2').hide();
	}
	function box2(){

		$('#light2').show();
		$('*').css('overflow','hidden');
		$('#fade2').show();
	}
	function close3() {
		$('#light3').hide();
		$('*').css('overflow','visible');
		$('#fade3').hide();
	}
	function nasluchiwacz_slider() {
		$('.x-del').on('click',function(){
			var asoc=$(this).data('asoc');
			var id=$(this).data('id');
			$('.delete_photo').html('<input type="hidden" name="data[Slider_photos.id]" value="'+asoc+'"/><input type="hidden" name="data[Slider_id]" value="'+id+'"><input type="submit" name="delete" value="Tak" style="float:right;"><input type="button" value="Nie" onclick="close3()">');
			$('#light3').show();
			$('*').css('overflow','hidden');
			$('#fade3').show();
		});
	}
	function nasluchiwacz_folder() {
		$('.x-del_folder').on('click',function(){
			var asoc=$(this).data('asoc');
			var id=$(this).data('id');
			$('.delete_photo').html('<input type="hidden" name="data[Folder_photos.id]" value="'+asoc+'"/><input type="hidden" name="data[Folder_id]" value="'+id+'"><input type="submit" name="delete" value="Tak" style="float:right;"><input type="button" value="Nie" onclick="close3()">');
			$('#light3').show();
			$('*').css('overflow','hidden');
			$('#fade3').show();
		});
	}
