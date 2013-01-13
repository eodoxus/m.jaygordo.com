<ul data-role="listview" data-inset="true">
	<li data-role="list-divider">Latest Projects</li>

	<?php foreach ($projects as $post): ?>
	<li>
		<a href="<?php echo URL::site($post->url()) ?>"><?php echo $post->title ?></a>
	</li>
	<?php endforeach ?>
</ul>
