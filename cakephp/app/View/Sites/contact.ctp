<section class="contact_header" style="background-color:#ddd;">
  <div class="container">
    <div class="contact_strip"><?php echo $element['Settings'][4]['Settings']['value']; ?></div>
  </div>
</section>
<section class="contact_map col-md-12" style="margin-top:10px;">
  <div class="container">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d81732.53314879886!2d18.792052371760022!3d50.19588294655777!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4716cb0a47487e13%3A0x7cc15d58779f7e0c!2zTWlrb8WCw7N3!5e0!3m2!1spl!2spl!4v1515946655371" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
  </div>
</section>

<section class="contact_form">
  <div class="container">

    <div class="form col-md-8" style="padding:0;">

      <div class="kontakt_box_all1 m-b-30">

        <!-- name -->
        <div class="small_box m-b-5 m-t-5 p-r-sbi">
  				<input class="small_box_in " id="c_name" style="float:left;" placeholder="imię i nazwisko">
  				<div class="error err_c_name"></div>
        </div>
        <!-- name -->

        <!-- mail -->
        <div class="small_box m-b-5 m-t-5 p-l-sbi">
  				<input class="small_box_in" id="c_email" style="float:right;" placeholder="email">
  				<div class="error err_c_email"></div>
        </div>
        <!-- mail -->

        <div class="clearfix"></div>
        <!-- message -->

        <div class="message m-b-5 m-t-5">
  				<textarea class="small_box_in" style="width:100%; resize:vertical;" id="c_text" placeholder="wiadomość"></textarea>
  				<div class="error err_c_text"></div>
        </div>
        <!-- message -->

				<input type="submit" class="contact_btn m-t-5">
			</div>
			<div class="kontakt_box_all2">

			</div>
    </div>
    <div class="info col-md-4" style="padding:0;">

      <div class="tel_box m-t-20" style="display:<?php switch ($element['Settings'][5]['Settings']['value']) {case 'off': echo ('none'); break; case 'on': echo (''); break; } ?>;">
        <i class="fas fa-phone m-r-20"></i>514 899 274
      </div>

      <div class="mail_box m-t-10 m-b-20" style="display:<?php switch ($element['Settings'][6]['Settings']['value']) {case 'off': echo ('none'); break; case 'on': echo (''); break; } ?>;">
        <i class="fas fa-envelope m-r-20"></i>marszta@gmail.com
      </div>
    </div>
  </div>
</section>
