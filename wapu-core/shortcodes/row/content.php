<?php
/**
 * Row template
 */

$class = ! empty( $atts['class'] ) ? esc_attr( $atts['class'] ) : false;
$id    = ! empty( $atts['id'] ) ? sprintf( ' id="%s"', esc_attr( $atts['id'] ) ) : '';

?>
<div class="row <?php echo $class; ?>" <?php echo $id; ?>><?php
	echo $content;
?></div>