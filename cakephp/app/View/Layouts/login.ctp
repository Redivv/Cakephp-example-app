<!DOCTYPE html>
<html>
	<head>
		<?php echo $this->element('meta'); ?>
		<title>Logowanie do panelu</title>
	</head>
	<body>
		<?php echo $this->Flash->render(); ?>
		<?php echo $this->fetch('content'); ?>
	</body>
</html>
