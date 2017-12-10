<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>
			My Page
		</title>
		<!-- Moje Pliki -->
		<?php echo $this->element('meta'); ?>
	</head>
	<body>
		<div class="left">
			<a href="/cakephp/admin/dashboard">dashboard</a>
			<a href="/cakephp/admin/about">about</a>
			<a href="/cakephp/admin/gallery">galeria</a>
			<a href="/cakephp/admin/meh">cośtam</a>
			<a href="/cakephp/admin/contact">kontakt</a>
			<div class="clearfix"></div>
		</div>
		<div class="right">
			<?php echo $this->Flash->render(); ?>
			<?php echo $this->fetch('content'); ?>
			<div class="clearfix"></div>
		</div>


	</body>
</html>
