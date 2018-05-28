<section class="menu_index_admin">
  Menu
  <form class="" method="post">
    <input style="display: block;" type="text" name="data[settings][1]" value="<?php echo $element['Settings'][7]['Settings']['value']; ?>">
    <br>
    <input type="text" name="data[settings][2]" value="<?php echo $element['Settings'][8]['Settings']['value']; ?>">
    <input type="text" name="data[settings][3]" value="<?php echo $element['Settings'][9]['Settings']['value']; ?>">
    <input type="text" name="data[settings][4]" value="<?php echo $element['Settings'][10]['Settings']['value']; ?>">
    <input type="text" name="data[settings][5]" value="<?php echo $element['Settings'][11]['Settings']['value']; ?>">
    <br>
    <input type="submit" name="menu">
  </form>
</section>
<section class="slider_index_admin">
  Tło głównej strony: <BR/>
  <?php for ($i=1; $i <=$element['Slider'][0]['number'] ; $i++) {  ?>
    <div class="" style="width:25%; float:left; border:1px solid #f00;">
      <?php
          echo '<img src="'.$element['Photo'][0][$i]['1'].'" width=100% >';
      ?>
      <form class="" action="" method="post" enctype="multipart/form-data" name="">
        <input type="file" name="Photo[]"/>
        <input type="hidden" name="data[id]" value="<?php echo $element['Photo'][0][$i]['2']; ?>"/>
        <input type="hidden" name="data[Slider_photos.id]" value="<?php echo $element['Photo'][0][$i]['3']; ?>"/>
        <input type="hidden" name="data[Slider_id]" value="3">
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
        <input type="hidden" name="data[Slider_id]" value="3"/>
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
