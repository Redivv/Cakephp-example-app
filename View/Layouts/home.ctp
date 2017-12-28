<!DOCTYPE html>
<html>
<head>
	<title>Główna</title>
	<?php echo $this->element('meta'); ?>
</head>

<body class="background_home_img">
			<?php echo $this->element('header'); ?>

			<?php echo $this->Flash->render(); ?>
			<?php echo $this->fetch('content'); ?>

			<?php echo $this->element('footer'); ?>
</body>
</html>
