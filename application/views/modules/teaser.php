<a href="<?php echo URL::site($post->url()) ?>">
	<h3><?php echo $post->title ?></h3>
	<p><?php echo strip_tags($post->revision->teaser) ?></p>
</a>