<section class="slider_1_about_admin">
  slider nr 1: <BR/>
  <?php for ($i=1; $i <=$element['Slider'][0]['number'] ; $i++) {  ?>
    <div class="" style="width:25%; float:left; border:1px solid #f00;">
      <?php
          echo '<img src="'.$element['Photo'][0][$i]['1'].'" width=100% >';
      ?>
      <form class="" action="" method="post" enctype="multipart/form-data" name="">
        <input type="file" name="Photo[]"/>
        <input type="hidden" name="data[id]" value="<?php echo $element['Photo'][0][$i]['2']; ?>"/>
        <input type="hidden" name="data[Slider_photos.id]" value="<?php echo $element['Photo'][0][$i]['3']; ?>"/>
        <input type="hidden" name="data[Slider_id]" value="1">
        <input type="submit" name="photo">
        <input class="x-del" type="button" value="Usuń Zdjęcie" data-asoc="<?php echo $element['Photo'][0][$i]['3']; ?>" data-id="1" style="float:right;">
        <!--<input type="submit" name="delete" value="X-del" style="float:right;">-->
        <BR/>
      </form>

    </div><?php } ?>
    <div class="" style="width:25%; float:left; border:1px solid #f00;">
        Dodaj zdjęcie:
      <form class="" action="" method="post" enctype="multipart/form-data" name="">
        <input type="file" name="Photo[]"/>
        <input type="hidden" name="data[Slider_id]" value="1"/>
        <input type="hidden" name="data[id]" value="0"/>

        <input type="submit" name="photo"><BR/>
      </form>

    </div>
    <div class="clearfix"></div>
    <!-- wyskakujące okienko z potwiedzeniem usunięcia -->
      <div id="light3" class="white_content">
        <h3 style="text-align:center;">Czy na pewno chcesz usunąć zdjęcie?</h3>
       <form class="delete_photo" method="post">
         <input type="submit" name="delete" value="Tak" style="float:right;">
         <input type="button" value="Nie" onclick="close3()">
       </form>
      </div>
      <div id="fade3" class="black_overlay"></div>
    <!-- -->
</section>
<section class="name_about_admin">
  Tekst 1
  <form class="" method="post">
    <input type="hidden" name="id" value="1">
    <input type="hidden" name="name" value="Text about 1">
    <textarea style="width:100%;" type="text" name="data[settings]"><?php echo $element['Settings'][0]['Settings']['value'] ?></textarea>
    <input type="submit" name="text">
  </form>
</section>
<section class="introduction_about_admin">
  Tekst 2
  <form class="" method="post">
    <input type="hidden" name="id" value="2">
    <input type="hidden" name="name" value="Text about 2">
    <textarea style="width:100%;" type="text" name="data[settings]"><?php echo $element['Settings'][1]['Settings']['value'] ?></textarea>
    <input type="submit" name="text">
  </form>
  Tekst 3
  <form class="" method="post">
    <input type="hidden" name="id" value="3">
    <input type="hidden" name="name" value="Text about 3">
    <textarea style="width:100%;" type="text" name="data[settings]"><?php echo $element['Settings'][2]['Settings']['value'] ?></textarea>
    <input type="submit" name="text">
  </form>
</section>
<section class="photos_about_admin">
  Zdjęcia: <BR/>
  <?php for ($i=1; $i <=$element['Slider'][1]['number'] ; $i++) {  ?>
    <div class="" style="width:25%; float:left; border:1px solid #f00;">
      <?php
          echo '<img src="'.$element['Photo'][1][$i]['1'].'" width=100% >';
      ?>
      <form class="" action="" method="post" enctype="multipart/form-data" name="">
        <input type="file" name="Photo[]"/>
        <input type="hidden" name="data[id]" value="<?php echo $element['Photo'][1][$i]['2']; ?>"/>
        <input type="hidden" name="data[Slider_photos.id]" value="<?php echo $element['Photo'][1][$i]['3']; ?>"/>
        <input type="hidden" name="data[Slider_id]" value="2">

        <input type="submit" name="photo">
        <input class="x-del" type="button" value="Usuń Zdjęcie" data-asoc="<?php echo $element['Photo'][1][$i]['3']; ?>" data-id="2" style="float:right;">
        <BR/>
      </form>

    </div><?php }if (($element['Slider'][1]['number'])<4) {?>
    <div class="" style="width:25%; float:left; border:1px solid #f00;">
        Dodaj zdjęcie:
      <form class="" action="" method="post" enctype="multipart/form-data" name="">
        <input type="file" name="Photo[]"/>
        <input type="hidden" name="data[Slider_id]" value="2"/>
        <input type="hidden" name="data[id]" value="0"/>

        <input type="submit" name="photo"><BR/>
      </form>

    </div>
    <div class="clearfix"></div>
  <?php } ?>
  Tekst 4
  <form class="" method="post">
    <input type="hidden" name="id" value="4">
    <input type="hidden" name="name" value="Text about 4">
    <textarea style="width:100%;" type="text" name="data[settings]"><?php echo $element['Settings'][3]['Settings']['value'] ?></textarea>
    <input type="submit" name="text">
  </form>
</section>
