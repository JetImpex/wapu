<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Wapuula
 */

$landing_first_image = wapu_get_mod( 'landing_first_image' );
if ( $landing_first_image ) {
	$landing_first_image_url = esc_url( $landing_first_image );
	$landing_first_image_url = esc_url( $landing_first_image_url );
}

$landing_first_image_retina = wapu_get_mod( 'landing_first_image_retina' );
if ( $landing_first_image_retina ) {
	$landing_first_image_retina_url = esc_url( $landing_first_image_retina );
	$landing_first_image_retina_url = esc_url( $landing_first_image_retina_url );
}

$landing_second_image = wapu_get_mod( 'landing_second_image' );
if ( $landing_second_image ) {
	$landing_second_image_url = esc_url( $landing_second_image );
	$landing_second_image_url = esc_url( $landing_second_image_url );
}

$landing_second_image_retina = wapu_get_mod( 'landing_second_image_retina' );
if ( $landing_second_image_retina ) {
	$landing_second_image_retina_url = esc_url( $landing_second_image_retina );
	$landing_second_image_retina_url = esc_url( $landing_second_image_retina_url );
}

$landing_third_image = wapu_get_mod( 'landing_third_image' );
if ( $landing_third_image ) {
	$landing_third_image_url = esc_url( $landing_third_image );
	$landing_third_image_url = esc_url( $landing_third_image_url );
}

$landing_third_image_retina = wapu_get_mod( 'landing_third_image_retina' );
if ( $landing_third_image_retina ) {
	$landing_third_image_retina_url = esc_url( $landing_third_image_retina );
	$landing_third_image_retina_url = esc_url( $landing_third_image_retina_url );
}

$landing_fourth_image = wapu_get_mod( 'landing_fourth_image' );
if ( $landing_fourth_image ) {
	$landing_fourth_image_url = esc_url( $landing_fourth_image );
	$landing_fourth_image_url = 'style="background-image:url(' . esc_url( $landing_fourth_image_url ) . ')"';
}

$landing_fifth_image = wapu_get_mod( 'landing_fifth_image' );
if ( $landing_fifth_image ) {
	$landing_fifth_image_url = esc_url( $landing_fifth_image );
	$landing_fifth_image_url = 'style="background-image:url(' . esc_url( $landing_fifth_image_url ) . ')"';
}

$landing_sixth_image = wapu_get_mod( 'landing_sixth_image' );
if ( $landing_sixth_image ) {
	$landing_sixth_image_url = esc_url( $landing_sixth_image );
	$landing_sixth_image_url = 'style="background-image:url(' . esc_url( $landing_sixth_image_url ) . ')"';
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wapu' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->
	<section class="landing landing__first">
		<div class="innerfirst">
			<h2>We Love <strong>Elementor</strong></h2>
			<h2>&amp; Believe in It!</h2>
			<p>Meet best products made for Elementor page builder with love</p>
		</div>
	</section>
	<section class="landing landing__second">
		<a href="https://www.templatemonster.com/wordpress-elementor-themes/">
			<div class="container">
				<div class="inner-wrap">
					<img src="<?php echo $landing_first_image ?>" srcset="<?php echo $landing_first_image_retina ?> 2x" alt="<?php printf( esc_attr__('landing-image', 'wapu' )); ?>" />
					<div class="landing__inner-content">
						<p>Easy usage. Classy looks.</p>
						<h2>Special</h2>
						<h2>Elementor <strong>Themes</strong></h2>
						<p><span>Discover Now!</span></p>
					</div>
				</div>
			</div>
		</a>
	</section>
	<section class="landing landing__third">
		<a href="https://www.templatemonster.com/elementor-templates.php">
			<div class="container">
				<div class="inner-wrap">
					<img src="<?php echo $landing_second_image_url ?>" srcset="<?php echo $landing_second_image_retina ?> 2x" alt="<?php printf( esc_attr__('landing-image', 'wapu' )); ?>" />
					<div class="landing__inner-content">
						<p>Fit for any topic. Designed for demanding tastes.</p>
						<h2>Stylish Elementor</h2>
						<h2><strong>Templates</strong></h2>
						<p><span>Discover Now!</span></p>
					</div>
				</div>
			</div>
		</a>
	</section>
	<section class="landing landing__fourth">
		<a href="https://www.templatemonster.com/wordpress-elementor-plugins/">
			<div class="container">
				<div class="inner-wrap">
					<img src="<?php echo $landing_third_image_url ?>" srcset="<?php echo $landing_third_image_retina ?> 2x" alt="<?php printf( esc_attr__('landing-image', 'wapu' )); ?>" />
					<div class="landing__inner-content">
						<p>Created for utmost convenience.</p>
						<h2>Powerful</h2>
						<h2>Elementor <strong>Plugins</strong></h2>
						<p><span>Discover Now!</span></p>
					</div>
				</div>
			</div>
		</a>
	</section>
	<section class="landing landing__fifth bg-pan-right">
		<div class="bg-fifth" <?php echo $landing_fourth_image_url ?>>
			<a href="https://crocoblock.com/">
				<h2>CrocoBlock Makes It</h2>
				<h2><strong>All-in-one</strong></h2>
				<p>Join CrocoBlock to get more astonishing products for Elementor in one subscription!</p>
			</a>
		</div>
	</section>
	<section class="landing landing__sixth">
		<div class="box box__social" <?php echo $landing_fifth_image_url ?>>
			<a href="https://www.facebook.com/groups/314070442378651/about/">
				<h2>Follow <strong>ZemezJet</strong></h2>
				<h2>Community</h2>
				<p>Get more information on ZemezJet discounts, products and updates on Facebook!</p>
			</a>
		</div>
		<div class="box box__visit" <?php echo $landing_sixth_image_url ?>>
			<a href="https://www.facebook.com/groups/CrocoblockCommunity/">
				<h2>Visit <strong>CrocoBlock</strong></h2>
				<h2>Community</h2>
				<p>Stay tuned to the latest news & enjoy CrocoBlock together with the rapidly growing community!</p>
			</a>
		</div>
	</section>
	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'wapu' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->
