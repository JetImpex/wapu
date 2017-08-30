<?php
/**
 * Loop item template
 */
?>
<div class="jet-carousel__item"><?php
	echo $this->__loop_item( array( 'item_link' ), '<a href="%s" class="jet-carousel__item-link" target="_blank">' );
	echo $this->__loop_item( array( 'item_image', 'url' ), '<img src="%s" alt="" class="jet-carousel__item-img">' );
	echo $this->__loop_item( array( 'item_link' ), '</a>' );
	echo '<div class="jet-carousel__content">';
		echo $this->__loop_item( array( 'item_title' ), '<h6 class="jet-carousel__item-title">' );
		echo $this->__loop_item( array( 'item_link' ), '<a href="%s" class="jet-carousel__item-link" target="_blank">' );
		echo $this->__loop_item( array( 'item_title' ), '%s' );
		echo '</a>';
		echo '</h6>';
		echo $this->__loop_item( array( 'item_text' ), '<div class="jet-carousel__item-text">%s</div>' );
	echo '</div>';
?></div>