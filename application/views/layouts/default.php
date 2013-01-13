<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
	<title>Jason Gordon, Jay Gordo, eodoxus, Gordo, Gordonzobean</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<?php foreach ($styles as $file) echo HTML::style($file), "\n\t" ?>
<?php foreach ($scripts as $file) echo HTML::script($file), "\n\t" ?>

</head>
<body class="<?php if (isset($body_class)) echo $body_class ?>">
	<div data-role="page" data-theme="b" id="page">
		
		<div data-role="header">
			<h1><?php echo $title ?></h1>
			<?php if (URL::current() != ''): ?>
				<a href="<?php echo URL::site('') ?>" data-icon="home" data-iconpos="notext" data-direction="reverse" class="ui-btn-right jqm-home">Home</a>
			<?php endif ?>
		</div>
	
		<div id="content" data-role="content">
			<?php echo $content ?>
		</div>
		
		<div id="footer">
			<p>
				Powered by
				<?php echo HTML::anchor('http://jquerymobile.com/', 'jQuery Mobile') ?>,
				<?php echo HTML::anchor('http://kohanaframework.org/', 'Kohana') ?>,
				<?php echo HTML::anchor('http://drupal.org/', 'Drupal') ?>,
				<?php echo HTML::anchor('http://httpd.apache.org/', 'Apache') ?>,
				<?php echo HTML::anchor('http://www.mysql.com/', 'MySQL') ?>, and
				<?php echo HTML::anchor('portfolio/this-site', 'Elbow Grease') ?>
			</p>
		</div>
	</div>
</body>
</html>
