<section class="about">

      <div class="owl-carousel owl-theme p-r-15 p-l-15">
        <?php for ($i=1; $i<=$element['Slider'][0]['number'] ; $i++) {?>
          <div class="item"><img src="<?php echo $element['Photo'][0][$i][1];?>"></div>
        <?php }?>
      </div>

<div class="clearfix"></div>
</section>

<section class="about">
  <div class="name">
    <h1><?php echo $element['Settings'][0]['Settings']['value']; ?></h1>
  </div>
  <div class="introduction ">
    <h3><?php echo $element['Settings'][1]['Settings']['value']; ?></h3>
  </div>
  <div class="text p-t-30">
    <h4><?php echo $element['Settings'][2]['Settings']['value']; ?></h4>
  </div>

  <!-- photos -->
  <div class="photo-box">
    <!-- photo row -->
    <div class="photo">
      <img src="<?php if(isset($element['Photo'][1][1][1])){echo $element['Photo'][1][1][1];} ?>" alt="">
    </div>
    <div class="photo">
      <img src="<?php if(isset($element['Photo'][1][2][1])){echo $element['Photo'][1][2][1];} ?>" alt="">
    </div>
    <div class="clearfix"></div>
    <!-- Photo row -->
    <!-- photo row -->
    <div class="photo">
      <img src="<?php if(isset($element['Photo'][1][3][1])){echo $element['Photo'][1][3][1];} ?>" alt="">
    </div>
    <div class="photo">
      <img src="<?php if(isset($element['Photo'][1][4][1])){echo $element['Photo'][1][4][1];} ?>" alt="">
    </div>
    <div class="clearfix"></div>
    <!-- Photo row -->
  </div>

  <div class="clearfix"></div>
  <BR/>
  <div class="text p-t-30 m-b-40">
    <h4><?php echo $element['Settings'][3]['Settings']['value'] ?></h4>
  </div>
</section>
