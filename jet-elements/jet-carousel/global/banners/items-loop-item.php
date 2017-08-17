<?php
/**
 * Loop item template
 */
?>
<div class="jet-carousel__item">
	<figure class="jet-banner jet-effect-<?php echo esc_attr( $this->get_settings( 'animation_effect' ) ); ?>"><?php
		//echo $this->__loop_item( array( 'item_link' ), '<a href="%s" class="jet-banner__link">' );
			echo '<div class="jet-banner__overlay"></div>';
			echo $this->__loop_item( array( 'item_image', 'url' ), '<img src="%s" alt="" class="jet-banner__img">' );
			echo '<figcaption class="jet-banner__content">';
				echo '<div class="jet-banner__content-wrap">';
					echo $this->__loop_item( array( 'item_title' ), '<h5 class="jet-banner__title">%s</h5>' );
					echo $this->__loop_item( array( 'item_text' ), '<div class="jet-banner__text">%s</div>' );
				echo '</div>';
			echo '</figcaption>';
		//echo $this->__loop_item( array( 'item_link' ), '</a>' );
	?></figure>
</div>