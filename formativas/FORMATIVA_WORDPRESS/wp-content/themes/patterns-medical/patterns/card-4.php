<?php
/**
 * Title: Card 4
 * Slug: patterns-medical/card-4
 * Categories: featured
 * Description: A layout featuring an icon, title, and content, commonly used in repeated columns or as a standalone section.
 *
 * @package    Patterns_Medical
 * @subpackage Patterns_Medical/patterns
 * @since      1.0.0
 */

?>
<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"auto","height":"60px","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/img-9.png" style="width:auto;height:60px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"align":"full","style":{"spacing":{"blockGap":"0","padding":{"right":"0","left":"0"}}},"layout":{"type":"constrained","contentSize":""}} -->
<div class="wp-block-group alignfull" style="padding-right:0;padding-left:0">    
<!-- wp:heading {"textAlign":"left","level":5,"align":"wide","textColor":"base"} -->
<h5 class="wp-block-heading alignwide has-text-align-left has-base-color has-text-color"><?php esc_html_e( 'Natalie Jones', 'patterns-medical' ); ?></h5>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"left","textColor":"tertiary"} -->
<p class="has-text-align-left has-tertiary-color has-text-color"><?php esc_html_e( 'Dental Assistant', 'patterns-medical' ); ?></p>
<!-- /wp:paragraph -->

</div>
<!-- /wp:group --></div>
<!-- /wp:group -->

