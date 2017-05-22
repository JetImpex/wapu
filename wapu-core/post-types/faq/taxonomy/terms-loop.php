<?php
/**
 * Terms loop item
 *
 * Available variables:
 *
 * $term     - current term object (look https://developer.wordpress.org/reference/functions/get_terms/ for structure).
 * $posts    - posts listing for current term.
 * $taxonomy - current taxonomy.
 */
?>
<div class="faq-term">
	<h4 class="faq-term__title"><?php echo $term->name; ?></h4>

	<?php echo $posts; ?>

</div>