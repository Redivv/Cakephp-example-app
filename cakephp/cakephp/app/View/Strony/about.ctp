<section class="about">
      <div class="owl-carousel owl-theme">
        <div class="item"><h4>1</h4></div>
        <div class="item"><h4>2</h4></div>
        <div class="item"><h4>3</h4></div>
        <div class="item"><h4>4</h4></div>
        <div class="item"><h4>5</h4></div>
        <div class="item"><h4>6</h4></div>
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
  <BR/>
  <div class="photo">
    <?php for ($i=1; $i <=$element['Slider'][1]['number'] ; $i++) {  ?>
      <div class="about_photo" style="width:25%;">
        <?php
            echo '<img src="'.$element['Photo'][1][$i]['1'].'" width=100% >';
            echo "<div>";
 }?>

  </div>
  <div class="clearfix"></div>
  <BR/>
  <div class="text2-about">
    bla bla bla
  </div>
</section>
