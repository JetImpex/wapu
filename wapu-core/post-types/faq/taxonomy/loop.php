<?php
/**
 * Posts loop item
 */
?>
<dt class="faq-post__title"><?php
	the_title();
?></dt>
<dd class="faq-post__content faq-hidden">
	<div class="faq-post__inner">
		<?php
			the_content();
		?>
	</div>
</dd>