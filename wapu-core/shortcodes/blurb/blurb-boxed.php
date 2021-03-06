<?php
/**
 * Default banner template
 */
?>
<div class="blurb <?php echo $class; ?>" <?php echo $id; ?>>
	<?php $this->html( $link, '<a href="%1$s" class="blurb__link"%2$s>', array( $target ) ); ?>
		<?php echo $img_tag; ?>
		<?php $this->html( $font_icon, '<i class="nc-icon-outline %s"></i>' ); ?>
		<div class="blurb_description">
			<?php
				$this->html( $title, '<h6 class="blurb__title">%s</h6>' );
				$this->html( $text, '<div class="blurb__text">%s</div>' );
			?>
		</div>
	<?php $this->html( $link, '</a>' ); ?>
</div>