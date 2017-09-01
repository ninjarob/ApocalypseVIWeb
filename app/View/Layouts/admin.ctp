<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->charset();
		
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $this->Html->css('jquery-ui-1.8.16.custom');

		echo $this->Html->script('jquery-1.6.2');

		echo $this->Html->script('jquery.dataTables.min');

		echo $this->Html->script('jquery-ui-1.8.16.custom.min');

		echo $this->Html->script('jquery.ui.position');

		echo $this->Html->script('jquery.ui.widget');

		echo $this->Html->script('jquery.ui.mouse');

		echo $this->Html->script('jquery.ui.draggable');

		echo $this->Html->script('jquery.ui.resizable');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1>Apocalypse V Administration  (<?php echo $this->Html->link('Admin Home', array('controller'=>'/admin/', 'action'=>'index'), array()); ?>)</h1>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $content_for_layout; ?>

		</div>
		<div id="footer">

		</div>
	</div>
</body>
</html>
