<ul data-role="listview">
<?php foreach ($posts as $post): ?>
	<li>
		<?php echo Module::render('teaser')->bind('post', $post) ?>
	</li>
<?php endforeach ?>
</ul>

<?php echo $pagination ?>