<?php
/**
 * Image banner template
 */
?>
<div class="blurb <?php echo $class; ?>" <?php echo $id; ?>>
	<?php $this->html( $link, '<a href="%1$s" class="blurb__link">' ) ?> 
		<?php echo $img_tag; ?>
	<?php $this->html( $link, '</a>' ); ?>
</div>