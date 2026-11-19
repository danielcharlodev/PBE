<?php
/**
 * Title: Featured Section 3
 * Slug: patterns-medical/featured-section-3
 * Categories: banner, featured
* Description: A collection of various WordPress inbuilt blocks, such as headings, paragraphs, image, groups, and buttons, arranged in different positions to form a complete page layout.
 *
 * @package    Patterns_Medical
 * @subpackage Patterns_Medical/patterns
 * @since      1.0.0
 */

?>
<!-- wp:cover {"url":"<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/img-4.jpg","hasParallax":true,"dimRatio":70,"overlayColor":"base","isUserOverlayColor":true,"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignfull has-parallax"
    style="padding-top:var(--wp--preset--spacing--80);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--80);padding-left:var(--wp--preset--spacing--30)">
    <span aria-hidden="true"
        class="wp-block-cover__background has-base-background-color has-background-dim-70 has-background-dim"></span>
    <div class="wp-block-cover__image-background has-parallax"
        style="background-position:50% 50%;background-image:url(<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/img-4.jpg)">
    </div>
    <div class="wp-block-cover__inner-container">
        <!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"0px"}}}} -->
        <div class="wp-block-columns alignwide"><!-- wp:column {"verticalAlignment":"top","width":"25%"} -->
            <div class="wp-block-column is-vertically-aligned-top" style="flex-basis:25%">
                <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30"},"blockGap":"var:preset|spacing|10"},"dimensions":{"minHeight":""},"layout":{"selfStretch":"fixed","flexSize":"300px"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
                <div class="wp-block-group"
                    style="padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)">
                    <!-- wp:heading {"textAlign":"center","textColor":"default"} -->
                    <h2 class="wp-block-heading has-text-align-center has-default-color has-text-color"><?php esc_html_e( '20+', 'patterns-medical' ); ?></h2>
                    <!-- /wp:heading -->

                    <!-- wp:paragraph {"align":"center","textColor":"default"} -->
                    <p class="has-text-align-center has-default-color has-text-color"><?php esc_html_e( 'Winning Award', 'patterns-medical' ); ?></p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:column -->

            <!-- wp:column {"verticalAlignment":"top","width":"25%"} -->
            <div class="wp-block-column is-vertically-aligned-top" style="flex-basis:25%">
                <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30"},"blockGap":"var:preset|spacing|10"},"dimensions":{"minHeight":""},"layout":{"selfStretch":"fixed","flexSize":"300px"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
                <div class="wp-block-group"
                    style="padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)">
                    <!-- wp:heading {"textAlign":"center","textColor":"default"} -->
                    <h2 class="wp-block-heading has-text-align-center has-default-color has-text-color"><?php esc_html_e( '100K+', 'patterns-medical' ); ?></h2>
                    <!-- /wp:heading -->

                    <!-- wp:paragraph {"align":"center","textColor":"default"} -->
                    <p class="has-text-align-center has-default-color has-text-color"><?php esc_html_e( 'Happy Customers', 'patterns-medical' ); ?></p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:column -->

            <!-- wp:column {"verticalAlignment":"top","width":"25%"} -->
            <div class="wp-block-column is-vertically-aligned-top" style="flex-basis:25%">
                <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30"},"blockGap":"var:preset|spacing|10"},"dimensions":{"minHeight":""},"layout":{"selfStretch":"fixed","flexSize":"300px"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
                <div class="wp-block-group"
                    style="padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)">
                    <!-- wp:heading {"textAlign":"center","textColor":"default"} -->
                    <h2 class="wp-block-heading has-text-align-center has-default-color has-text-color"><?php esc_html_e( '20M+', 'patterns-medical' ); ?></h2>
                    <!-- /wp:heading -->

                    <!-- wp:paragraph {"align":"center","textColor":"default"} -->
                    <p class="has-text-align-center has-default-color has-text-color"><?php esc_html_e( 'Working Hours', 'patterns-medical' ); ?></p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:column -->

            <!-- wp:column {"verticalAlignment":"top","width":"25%"} -->
            <div class="wp-block-column is-vertically-aligned-top" style="flex-basis:25%">
                <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30"},"blockGap":"var:preset|spacing|10"},"dimensions":{"minHeight":""},"layout":{"selfStretch":"fixed","flexSize":"300px"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
                <div class="wp-block-group"
                    style="padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)">
                    <!-- wp:heading {"textAlign":"center","textColor":"default"} -->
                    <h2 class="wp-block-heading has-text-align-center has-default-color has-text-color"><?php esc_html_e( '100+', 'patterns-medical' ); ?></h2>
                    <!-- /wp:heading -->

                    <!-- wp:paragraph {"align":"center","textColor":"default"} -->
                    <p class="has-text-align-center has-default-color has-text-color"><?php esc_html_e( 'Completed Projects', 'patterns-medical' ); ?></p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:column -->
        </div>
        <!-- /wp:columns -->
    </div>
</div>
<!-- /wp:cover -->