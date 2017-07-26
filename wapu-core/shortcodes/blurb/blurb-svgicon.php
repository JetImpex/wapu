<?php
/**
 * Default banner template
 */
?>
<div class="blurb <?php echo $class; ?>" <?php echo $id; ?>>
	<?php $this->html( $link, '<div class="blurb__link"%2$s>', array( $target ) ); ?>
		<?php echo $img_tag; ?>
		<?php $this->html( $font_icon, '<i class="jetimpex-%s"></i>' ); ?>
		<div class="blurb_description">
			<?php
				$this->html( $title, '<h4 class="blurb__title">%s</h4>' );
				$this->html( $text, '<div class="blurb__text">%s</div>' );
			?>
		</div>
	<?php $this->html( $link, '</div>' ); ?>
</div>