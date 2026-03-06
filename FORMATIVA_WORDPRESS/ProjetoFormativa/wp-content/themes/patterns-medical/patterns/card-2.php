<?php
/**
 * Title: Card 2
 * Slug: patterns-medical/card-2
 * Categories: featured
 * Description: A layout featuring an icon, title, and content, commonly used in repeated columns or as a standalone section.
 *
 * @package    Patterns_Medical
 * @subpackage Patterns_Medical/patterns
 * @since      1.0.0
 */

?>
<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"backgroundColor":"default","layout":{"type":"constrained"}} -->
    <div class="wp-block-group has-default-background-color has-background">              


    <!-- wp:cover {"url":"<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/img-5.jpg","dimRatio":0,"minHeight":450,"isDark":false,"style":{"border":{"radius":"5px"}}} -->
        <div class="wp-block-cover is-light" style="border-radius:5px;min-height:450px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span><img class="wp-block-cover__image-background" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/img-5.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","fontSize":"large"} -->
        <p class="has-text-align-center has-large-font-size"></p>
        <!-- /wp:paragraph --></div></div>
    <!-- /wp:cover -->

    <!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignwide"><!-- wp:heading {"level":5,"align":"wide","textColor":"base"} -->
        <h5 class="wp-block-heading alignwide has-base-color has-text-color"><?php esc_html_e( 'Natalie Jones', 'patterns-medical' ); ?></h5>
        <!-- /wp:heading -->

        <!-- wp:paragraph {"align":"left","textColor":"tertiary"} -->
        <p class="has-text-align-left has-tertiary-color has-text-color"><?php esc_html_e( 'Dental', 'patterns-medical' ); ?></p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->