<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Admin</title>
		<!-- Moje Pliki -->
		<?php echo $this->Html->css('cms.css'); ?>
		<?php echo $this->Html->css('main.css'); ?>

	</head>
	<body>
		<div class="left">
			<?php echo $this->element('admin_menu') ?>
		</div>
		<div class="right">
			<?php echo $this->Flash->render(); ?>
			<?php echo $this->fetch('content'); ?>
			<div class="clearfix"></div>
		</div>
	</body>
	<?php echo $this->Html->script('popup.js');?>
</html>
