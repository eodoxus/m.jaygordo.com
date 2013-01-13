<?php if ($messages !== NULL): ?>
<ul class="<?php echo $class ?>">
	<?php foreach ($messages as $message) echo '<li>' . __($message) . '</li>';	?>
</ul>
<?php endif; ?>