<h1>Log Helper</h1>
<h3>Available log files:<h3>
<ul>
<?php foreach ($files as $file): ?>
<li><?php echo html::anchor(url::site("logviewer/view/$file"), $file) ?></li>
<?php endforeach ?>
</ul>
