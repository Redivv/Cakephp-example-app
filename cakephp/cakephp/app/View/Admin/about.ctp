about
W "$element['helper']['menu'] trzymana jest nazwa podstrony (about, index itd.) mozna zaznaczyć to w menu jak ktoś chce"
<section class="slider_1_about_admin">
  slider nr 1: <BR/>
  <?php for ($i=1; $i <=$element['Slider']['number'] ; $i++) {  ?>
    <div class="" style="width:25%; float:left; border:1px solid #f00;">
      <?php

          echo '<img src="'.$element['Photo'][$i]['1'].'" width=100% >';
      ?>
      <form class="" action="" method="post" enctype="multipart/form-data">
        <input type="file" name="data[Photo]"/>
        <input type="hidden" name="data[id]" value="<?php echo $element['Photo'][$i]['2']; ?>"/>
        <input type="hidden" name="data[Slider_photos.id]" value="<?php echo $element['Photo'][$i]['3']; ?>"/>

        <input type="submit" name="">
        <input type="submit" name="data[delete]" value="X-del" style="float:right;">
        <BR/>
      </form>

    </div><?php } ?>
    <div class="" style="width:25%; float:left; border:1px solid #f00;">
        Dodaj zdjęcie:
      <form class="" action="" method="post" enctype="multipart/form-data">
        <input type="file" name="data[Photo]"/>
        <input type="hidden" name="data[Slider_id]" value="1"/>
        <input type="hidden" name="data[id]" value="0"/>

        <input type="submit" name=""><BR/>
      </form>

    </div>


</section>
