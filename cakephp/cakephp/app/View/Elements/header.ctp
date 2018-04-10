<header>
  <div class="container header">
      <div class="row">
        <div class="col-md-12">
          <div class="page_logo">
            <a href="/cakephp/strony/index" class="page_logo_link black" style="text-decoration:none;">Marek Sztajgli</a>
          </div>
        </div>
      </div>
      <div class="row">
          <div class="page_menu col-md-12" style="text-decoration:none;">
              <a href="/cakephp/strony/about/" class="col-md-1 col-sm-2 black col-xs-3 col-sm-offset-2 col-md-offset-4 menu_box anim_short">O mnie<div class="strip anim_short"></div></a>
              <div id="gallery" class="col-md-1 col-sm-2 black col-xs-3 menu_box"><a style="color:inherit !important;">Galeria</a>

                <!-- menu slide -->
                <div class="slide-menu m-t-20">
                  <?php for ($i=1; $i<count($galleries); $i++){
                    echo'<a href="/cakephp/strony/gallery?id='.$galleries[$i]['id'].'" class="button anim_short">'.$galleries[$i]['name'].'</a>';
                  }echo'<a href="/cakephp/strony/gallery?id='.$galleries[count($galleries)]['id'].'" class="button anim_short">'.$galleries[count($galleries)]['name'].'</a>';?>
                </div>
                <!-- menu slide -->
              </div>
              <a href="/cakephp/strony/meh" class="col-md-1 col-sm-2 black col-xs-3 menu_box anim_short">coś coś<div class="strip anim_short"></div></a>
              <a href="/cakephp/strony/contact" class="col-md-1 col-sm-2 black col-xs-3 menu_box anim_short">Kontakt<div class="strip anim_short"></div></a>
          </div>
        </div>
    </div>
  </header>
