<?php
/**
 * Title: Card 1
 * Slug: patterns-medical/card-1
 * Categories: featured
 * Description: A layout featuring an icon, title, and content, commonly used in repeated columns or as a standalone section.
 *
 * @package    Patterns_Medical
 * @subpackage Patterns_Medical/patterns
 * @since      1.0.0
 */

?>
<!-- wp:group {"style":{"border":{"radius":"5px"},"spacing":{"blockGap":"0px","padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"backgroundColor":"default","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-default-background-color has-background"
    style="border-radius:5px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">
    <!-- wp:image {"width":"auto","height":"80px","sizeSlug":"full","linkDestination":"none","style":{"color":{"duotone":"var:preset|duotone|base"}}} -->
    <figure class="wp-block-image size-full is-resized"><img
            src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/icon-4.png" style="width:auto;height:80px" /></figure>
    <!-- /wp:image -->

    <!-- wp:spacer {"height":"var:preset|spacing|50"} -->
    <div style="height:var(--wp--preset--spacing--50)" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:heading {"level":4,"align":"wide"} -->
    <h4 class="wp-block-heading alignwide"><?php esc_html_e( 'Emergency', 'patterns-medical' ); ?></h4>
    <!-- /wp:heading -->

    <!-- wp:spacer {"height":"var:preset|spacing|10"} -->
    <div style="height:var(--wp--preset--spacing--10)" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:paragraph {"align":"left","style":{"spacing":{"margin":{"bottom":"0px"}},"typography":{"lineHeight":"1.8"}},"textColor":"tertiary"} -->
    <p class="has-text-align-left has-tertiary-color has-text-color"
        style="margin-bottom:0px;line-height:1.8"><?php esc_html_e( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', 'patterns-medical' ); ?>
    </p>
    <!-- /wp:paragraph -->
</div>
<!-- /wp:group -->