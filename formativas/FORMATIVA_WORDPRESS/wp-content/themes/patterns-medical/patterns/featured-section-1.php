<?php
/**
 * Title: Featured Section 1
 * Slug: patterns-medical/featured-section-1
 * Categories: featured
 * Description: A collection of various WordPress inbuilt blocks, such as headings, paragraphs, image, groups, and buttons, arranged in different positions to form a complete page layout.
 *
 * @package    Patterns_Medical
 * @subpackage Patterns_Medical/patterns
 * @since      1.0.0
 */

?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}},"backgroundColor":"default","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-default-background-color has-background" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|40","left":"var:preset|spacing|80"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center">
    
<!-- wp:image {"linkDestination":"none"} -->
<figure class="wp-block-image"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/img-3.png" /></figure>
<!-- /wp:image -->

 </div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
<div class="wp-block-column is-vertically-aligned-center">
    
<!-- wp:pattern {"slug":"patterns-medical/section-title-1"} /-->

 <!-- wp:group {"layout":{"type":"constrained"}} -->
    <div class="wp-block-group">
        <!-- wp:group {"style":{"typography":{"fontStyle":"normal","fontWeight":"700"}},"fontSize":"medium","layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
        <div class="wp-block-group has-medium-font-size" style="font-style:normal;font-weight:700">
            <!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|tertiary"}}}},"textColor":"tertiary"} -->
            <p class="has-tertiary-color has-text-color has-link-color"><?php esc_html_e( '01', 'patterns-medical' ); ?></p>
            <!-- /wp:paragraph -->

            <!-- wp:paragraph -->
            <p><?php esc_html_e( 'Lorem ipsum dolor sit amet', 'patterns-medical' ); ?></p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:group -->

        <!-- wp:separator {"className":"is-style-wide","style":{"spacing":{"margin":{"top":"15px","bottom":"15px"}},"color":{"background":"#c2c2c2"}}} -->
        <hr class="wp-block-separator has-text-color has-alpha-channel-opacity has-background is-style-wide"
            style="margin-top:15px;margin-bottom:15px;background-color:#c2c2c2;color:#c2c2c2" />
        <!-- /wp:separator -->

        <!-- wp:group {"style":{"typography":{"fontStyle":"normal","fontWeight":"700"}},"fontSize":"medium","layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
        <div class="wp-block-group has-medium-font-size" style="font-style:normal;font-weight:700">
             <!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|tertiary"}}}},"textColor":"tertiary"} -->
            <p class="has-tertiary-color has-text-color has-link-color"><?php esc_html_e( '02', 'patterns-medical' ); ?></p>
            <!-- /wp:paragraph -->

            <!-- wp:paragraph -->
            <p><?php esc_html_e( 'Lorem ipsum dolor sit amet', 'patterns-medical' ); ?></p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:group -->

        <!-- wp:spacer {"height":"var:preset|spacing|10"} -->
        <div style="height:var(--wp--preset--spacing--10)" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->

        <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"left"}} -->
        <div class="wp-block-buttons">
            <!-- wp:button {"textAlign":"center","className":"is-style-fill"} -->
            <div class="wp-block-button is-style-fill"><a
                    class="wp-block-button__link has-text-align-center wp-element-button"><?php esc_html_e( 'Know More', 'patterns-medical' ); ?></a></div>
            <!-- /wp:button -->
        </div>
        <!-- /wp:buttons -->
    </div>
    <!-- /wp:group -->

</div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->