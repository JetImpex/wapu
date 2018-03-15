<?php
/**
 * Wish List template
*/

$private 	= edd_wl_get_query( 'private' ); // get the private lists
$public 	= edd_wl_get_query( 'public' ); // get the public lists
?>

<?php echo edd_wl_create_list_link(); // create list ?>

<?php
/**
 * Private lists
*/
if ( $private ) : ?>
	<h3 class="edd-wl-heading"><?php echo sprintf( __( 'Private %s', 'edd-wish-lists' ), edd_wl_get_label_plural() ); ?></h3>
	<ul class="edd-wish-list">
	<?php foreach ( $private as $id ) : ?>
		<?php
			$items = get_post_meta( $id, 'edd_wish_list', true );
			$count = ! empty( $items ) ? count( $items ) : '0';
		?>
		<li>
			<span class="edd-wl-item-title">
				<a href="<?php echo edd_wl_get_wish_list_view_uri( $id ); ?>" title="<?php echo the_title_attribute( array('post' => $id ) ); ?>"><?php echo get_the_title( $id ); ?></a>
			</span>
			<div class="edd-wl-item-data">
				<span class="edd-wl-item-count"><?php echo $count; ?></span>
				<?php // edit link
					echo edd_wl_edit_link( $id );
				?>
			</div>
		</li>
	<?php endforeach; ?>
	</ul>
<?php endif; // if private lists ?>

<?php
/**
 * Public lists
*/
if ( $public ) : ?>
	<h3 class="edd-wl-heading"><?php echo sprintf( __( 'Public %s', 'edd-wish-lists' ), edd_wl_get_label_plural() ); ?></h3>
	<ul class="edd-wish-list">
	<?php foreach ( $public as $id ) : ?>
		<?php
			$items = get_post_meta( $id, 'edd_wish_list', true );
			$count = ! empty( $items ) ? count( $items ) : '0';
		?>
		<li>
			<span class="edd-wl-item-title">
				<a href="<?php echo edd_wl_get_wish_list_view_uri( $id ); ?>" title="<?php echo the_title_attribute( array('post' => $id ) ); ?>"><?php echo get_the_title( $id ); ?></a>
			</span>
			<div class="edd-wl-item-data">
				<span class="edd-wl-item-count"><?php echo $count; ?></span>
				<?php // edit link
					echo edd_wl_edit_link( $id );
				?>
			</div>
		</li>
	<?php endforeach; ?>
	</ul>
<?php endif; // if public lists ?>
