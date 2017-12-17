<section class="slider-about">
  <div class="photo_slider-about">
    slajder nr 1<BR/>
    <?php for ($i=1; $i <=$element['Slider']['number'] ; $i++) {  ?>
      <div class="" style="width:25%; float:left;">
        <?php echo '<img src="'.$element['Photo'][$i].'" width=100% >';?>

      </div><?php } ?>
  </div>
<div class="clearfix"></div>
</section>

<section class="description-about">
  <div class="name-about">
    <h2><?php echo $element['Settings'][0]['Settings']['value'] ?></h2>
  </div>
  <div class="introduction-about">
    <h3><?php echo $element['Settings'][1]['Settings']['value'] ?></h3>
  </div>
  <div class="text-about">
    o mnie
  </div>
  <BR/>
  <div class="photo-about">
    <div class="photo1" style="float:left; width:50%;">
      photo1
    </div>
    <div class="photo2" style="float:left;">
      photo2
    </div>
  </div>
  <div class="clearfix"></div>
  <BR/>
  <div class="text2-about">
    bla bla bla
  </div>
</section>
