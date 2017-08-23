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
				$this->html( $title, '<h4 class="blurb__title">%s</h4>' );
				$this->html( $text, '<div class="blurb__text">%s</div>' );
			?>
		</div>
		<div class="blurb_products_list">
			<i class="jetimpex-icon-wordpress"></i>
			<i class="jetimpex-icon-woo"></i>
			<i class="jetimpex-icon-html"></i>
			<i class="jetimpex-icon-joomla"></i>
			<i class="jetimpex-icon-magento"></i>
			<i class="jetimpex-icon-opencart"></i>
			<i class="jetimpex-icon-presta"></i>
			<i class="jetimpex-icon-shopify"></i>
		</div>
	<?php $this->html( $link, '</a>' ); ?>
</div>