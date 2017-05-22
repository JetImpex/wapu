<?php
/**
 * Default banner template
 */
?>
<div class="blurb <?php echo $class; ?>" <?php echo $id; ?>>
	<?php $this->html( $link, '<a href="%1$s" class="blurb__link-wrap">' ) ?> 
		<?php echo $img_tag; ?>
		<?php $this->html( $font_icon, '<i class="nc-icon-outline %s"></i>' ); ?>
		<?php $this->html( $title, '<h6 class="blurb__title">%s</h6>' ); ?>
		<?php $this->html( $text, '<div class="blurb__text">%s</div>' ); ?>
		<?php $this->html( $text, '<span class="blurb__link">%2$s</span>', array( $link_text ) ); ?>
	</a>
</div>