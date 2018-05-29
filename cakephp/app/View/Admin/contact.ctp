<section class="name_contact_admin">
  Tekst 1
  <form class="" method="post">
    <input type="hidden" name="id" value="5">
    <input type="hidden" name="name" value="Text contact">
    <textarea style="width:100%;" type="text" name="data[settings]"><?php echo $element['Settings'][4]['Settings']['value'] ?></textarea>
    <input type="submit" name="text">
  </form>
</section>
<section class="toggle telephone">
  <br>
  Numer telefonu
  <form method="post">
    <input type="text" name="data[nr]" placeholder="Numer Telefonu"  value="<?php echo $element['Settings'][12]['Settings']['value']; ?>">
    <input type="submit" name="Nr">
    <br>
    <input type="submit" name="toggle_tel" value="<?php switch ($element['Settings'][5]['Settings']['value']) {case 'off': echo ('Pokaż'); break; case 'on': echo ('Ukryj'); break; } ?>">
  </form>
</section>
<section class="toggle mail">
  <br>
  Ukryj adres mailowy
  <form method="post">
    <input type="text" name="data[mail]" placeholder="Adres email"  value="<?php echo $element['Settings'][13]['Settings']['value']; ?>">
    <input type="submit" name="Mail">
    <br>
    <input type="submit" name="toggle_mail" value="<?php switch ($element['Settings'][6]['Settings']['value']) {case 'off': echo ('Pokaż'); break; case 'on': echo ('Ukryj'); break; } ?>">
  </form>
</section>
