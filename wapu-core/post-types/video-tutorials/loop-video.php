<?php
/**
 * Loop video template
 *
 * Available variables:
 *
 * $post_id Post ID
 * $thumb   Thumbnail
 */
?>
<div class="wapu-loop-video">
	<a class="wapu-loop-video__link" href="#" data-init="popup" data-post="<?php echo $post_id; ?>"><?php
		echo $thumb;
	?></a>
</div>