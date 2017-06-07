<?php
/**
 * PopUp template
 */
?>
<div class="submit-ticket">
<?php if ( $title ) : ?>
	<h4 class="submit-ticket__title"><?php echo esc_html( $title ); ?></h4>
<?php endif; ?>
<?php if ( $content ) : ?>
	<div class="submit-ticket__content"><?php echo esc_html( $content ); ?></div>
<?php endif; ?>
<?php if ( ! empty( $links ) ) : ?>
	<div class="providers-list"><?php
		foreach ( $links as $link ) {

			if ( ! empty( $link['logo'] ) ) {
				$image = wp_get_attachment_image(
					$link['logo'], 'full', false, array( 'class' => 'providers-list__item-img' )
				);
			} else {
				$image = '';
			}

			printf(
				'<div class="providers-list__item-wrap"><a href="%1$s" target="_blank" class="providers-list__item">
					%2$s
					<span class="providers-list__item-label">%3$s</span>
				</a></div>',
				esc_url( $link['link'] ),
				$image,
				esc_html( $link['label'] )
			);
		}
	?></div>
<?php endif; ?>
</div>