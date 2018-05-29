<section class="Photos">
  <div class="folders_box clearfix">
    <?php for ($i=0; $i<$element['count']; $i++) {  ?>
      <div class="img_photo" style="margin-bottom:35px;">
        <?php
            echo '<a href="'.$element['src'][$i].'" data-lightbox="galeria"><img class="img_thumbnail anim" src="'.$element['src'][$i].'"></a>';
        ?>
      </div><?php } ?>
  </div>
</section>
