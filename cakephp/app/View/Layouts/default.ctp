<!DOCTYPE html>
<html>
<head>
	<?php echo $this->element('meta'); ?>
</head>

<body>
			<?php echo $this->element('header'); ?>
			<?php echo $this->Flash->render(); ?>
			<?php echo $this->fetch('content'); ?>
			<?php echo $this->element('footer'); ?>
</body>
</html>
