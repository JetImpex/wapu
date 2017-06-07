<?php
/**
 * Documentation search form.
 *
 * name="_docs_query" is required attribute
 */
?>
<div class="docs-search <?php echo $class; ?>" <?php echo $id; ?>>
	<h5><?php esc_html_e( 'Search for documentation:', 'wapu' ); ?></h5>
	<div class="docs-search__form">
		<input type="text" name="_docs_query" class="docs-search__input" placeholder="<?php esc_html_e( 'Enter theme name or template ID', 'wapu' ); ?>">
		<button class="docs-search__submit" type="submit" data-init="docs"><?php
			esc_html_e( 'Find', 'wapu' );
		?></button>
		<div class="doc-search__msg"></div>
	</div>
</div>