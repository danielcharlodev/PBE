<?php
/**
 * Title: Hero Banner Content
 * Slug: patterns-medical/hero-banner-content
 * Categories: featured
 * Description: A layout that displays a title, content, and button group, suited for showcasing a hero banner.
 *
 * @package    Patterns_Medical
 * @subpackage Patterns_Medical/patterns
 * @since      1.0.0
 */

?>
<!-- wp:columns {"verticalAlignment":"center","metadata":{"name":"Hero content"},"align":"wide"} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained","contentSize":"800px","justifyContent":"left"}} -->
<div class="wp-block-group alignwide"><!-- wp:paragraph {"align":"left","style":{"typography":{"lineHeight":"1.2","textTransform":"uppercase","letterSpacing":"1px"}},"fontSize":"x-small"} -->
<p class="has-text-align-left has-x-small-font-size" style="letter-spacing:1px;line-height:1.2;text-transform:uppercase"><?php esc_html_e( 'We Care For Every Patient', 'patterns-medical' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"left","level":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"800"}},"fontSize":"xx-large"} -->
<h1 class="wp-block-heading has-text-align-left has-xx-large-font-size" style="font-style:normal;font-weight:800"><?php esc_html_e( 'Finest Patient Care &amp; Amenities Service', 'patterns-medical' ); ?></h1>
<!-- /wp:heading -->



<!-- wp:spacer {"height":"var:preset|spacing|30"} -->
<div style="height:var(--wp--preset--spacing--30)" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:paragraph {"align":"left","style":{"typography":{"fontSize":"18px","lineHeight":1.6}}} -->
<p class="has-text-align-left" style="font-size:18px;line-height:1.6"><?php esc_html_e( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas voluptatem maiores eaque similique non distinctio ', 'patterns-medical' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:spacer {"height":"var:preset|spacing|20"} -->
<div style="height:var(--wp--preset--spacing--20)" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"left"}} -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-fill"} -->
<div class="wp-block-button is-style-fill"><a class="wp-block-button__link wp-element-button"><?php esc_html_e( 'Explore More', 'patterns-medical' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:image {"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/img-2.png" /></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->