<?php

/*$color = edd_get_option( 'checkout_color', 'gray' );
$color = ( $color == 'inherit' ) ? '' : $color;*/

if ( is_user_logged_in() ) :
	$license_keys = edd_software_licensing()->get_license_keys_of_user( get_current_user_id(), 0, 'any', false );
	?>
	<?php do_action( 'edd_sl_license_keys_before' ); ?>

	<table id="edd_sl_license_keys" class="edd-table">
		<thead>
			<tr class="edd_sl_license_row">
				<?php do_action('edd_sl_license_keys_header_before'); ?>
				<th class="edd_sl_item"><?php _e( 'Item Name', 'edd_sl' ); ?></th>
				<th class="edd_sl_details"><?php _e( 'Item Key', 'edd_sl' ); ?></th>
				<?php do_action('edd_sl_license_keys_header_after'); ?>
			</tr>
		</thead>
		<?php if ( $license_keys ) : ?>

			<?php foreach ( $license_keys as $license ) : ?>
				<?php /* $payment_id = edd_software_licensing()->get_payment_id( $license->ID ); */ ?>
				<tr class="edd_sl_license_row">

					<?php do_action( 'edd_sl_license_keys_row_start', $license->ID ); ?>
					<?php /* $child_keys = edd_software_licensing()->get_child_licenses( $license->ID ); */ ?>
					<td>
						<?php echo edd_software_licensing()->get_download_name( $license->ID ); ?>
					</td>
					<td>
						<?php echo esc_attr( edd_software_licensing()->get_license_key( $license->ID ) ); ?>
					</td>

					<?php do_action( 'edd_sl_license_keys_row_end', $license->ID ); ?>

				</tr>

			<?php endforeach; ?>

		<?php else: ?>

			<tr class="edd_sl_license_row">
				<td colspan="2"><?php _e( 'You currently have no licenses', 'edd_sl' ); ?></td>
			</tr>
		<?php endif; ?>
	</table>
	<?php do_action( 'edd_sl_license_keys_after' ); ?>
<?php else : ?>
	<p class="edd-alert edd-alert-warn">
		<?php _e( 'You must be logged in to view license keys.', 'edd_sl' ); ?>
	</p>
	<?php echo edd_login_form(); ?>
<?php endif; ?>
