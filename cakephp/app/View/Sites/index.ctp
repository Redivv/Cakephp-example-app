<div id="owl-index" class="owl-carousel owl-theme" id="owl-one">
  <?php for ($i=1; $i<=$element['Slider'][0]['number'] ; $i++) {?>
    <div class="item background_home_img" style="background-image:url('../..<?php echo $element['Photo'][0][$i][1];?>');"></div>
  <?php }?>
</div>
