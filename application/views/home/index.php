<ul data-role="listview" data-inset="true" data-theme="c" data-dividertheme="b">
	<li><?php echo HTML::anchor('contact', 'Contact Me') ?></li>
	<li><?php echo HTML::anchor('portfolio', 'Portfolio') ?></li>
	<li><?php echo HTML::anchor('code_examples', 'Code Examples') ?></li>
	<li><?php echo HTML::anchor('blog', 'Blog') ?></li>
	<li><?php echo HTML::anchor('resume', 'Resum&eacute;') ?></li>
	<li><?php echo HTML::anchor('photos', 'Photos') ?></li>
</ul>

<?php echo Block::factory('views/projects') ?>