<?php
/**
 * Title: Featured Section 2
 * Slug: patterns-medical/featured-section-2
 * Categories: services, featured
 * Description: A collection of various WordPress inbuilt blocks, such as headings, paragraphs, image, groups, and buttons, arranged in different positions to form a complete page layout.
 *
 * @package    Patterns_Medical
 * @subpackage Patterns_Medical/patterns
 * @since      1.0.0
 */

?>
<!-- wp:group {"align":"full","style":{"layout":{"selfStretch":"fit","flexSize":""},"spacing":{"padding":{"bottom":"var:preset|spacing|80","top":"var:preset|spacing|80"},"blockGap":"var:preset|spacing|60"}},"backgroundColor":"quaternary","layout":{"type":"constrained","contentSize":""}} -->
<div class="wp-block-group alignfull has-quaternary-background-color has-background"
    style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
     <!-- wp:columns {"verticalAlignment":null,"align":"wide"} -->
    <div class="wp-block-columns alignwide">
        <!-- wp:column {"verticalAlignment":"top","width":"55%","layout":{"type":"default"}} -->
        <div class="wp-block-column is-vertically-aligned-top" style="flex-basis:55%">
            <!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group">
                <!-- wp:paragraph {"align":"left","style":{"typography":{"textTransform":"uppercase","letterSpacing":"1px"}},"textColor":"primary","fontSize":"x-small"} -->
                <p class="has-text-align-left has-primary-color has-text-color has-x-small-font-size"
                    style="letter-spacing:1px;text-transform:uppercase"><?php esc_html_e( 'our services', 'patterns-medical' ); ?></p>
                <!-- /wp:paragraph -->

                <!-- wp:heading {"textAlign":"left"} -->
                <h2 class="wp-block-heading has-text-align-left"><?php esc_html_e( 'We provide the best medical services for you and your family.', 'patterns-medical' ); ?></h2>
                <!-- /wp:heading -->

            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"verticalAlignment":"center","width":"45%"} -->
        <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:45%">
            <!-- wp:paragraph {"align":"left","style":{"typography":{"fontStyle":"normal","fontWeight":"300"}},"textColor":"tertiary","fontSize":"medium"} -->
            <p class="has-text-align-left has-tertiary-color has-text-color has-medium-font-size"
                style="font-style:normal;font-weight:300"><?php esc_html_e( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas voluptatem maiores eaque similique non distinctio voluptates perspiciatis', 'patterns-medical' ); ?></p>
            <!-- /wp:paragraph -->

            <!-- wp:paragraph {"align":"left","textColor":"tertiary"} -->
            <p class="has-text-align-left has-tertiary-color has-text-color"><?php esc_html_e( 'Lorem ipsum dolor sit amet, consectetur
                adipisicing elit. Quas voluptatem maiores eaque similique non distinctio voluptates perspiciatis', 'patterns-medical' ); ?></p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:column -->
    </div>
     <!-- /wp:columns -->
      
    <!-- wp:columns {"verticalAlignment":"center","align":"wide"} -->
    <div class="wp-block-columns alignwide are-vertically-aligned-center">
        <!-- wp:column {"verticalAlignment":"center","layout":{"type":"constrained"}} -->
        <div class="wp-block-column is-vertically-aligned-center">
            <!-- wp:pattern {"slug":"patterns-medical/card-1"} /-->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"verticalAlignment":"center","layout":{"type":"constrained"}} -->
        <div class="wp-block-column is-vertically-aligned-center">
            <!-- wp:group {"style":{"border":{"radius":"5px"},"spacing":{"blockGap":"0px","padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"backgroundColor":"default","layout":{"type":"constrained"}} -->
            <div class="wp-block-group has-default-background-color has-background"
                style="border-radius:5px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">
                <!-- wp:image {"width":"auto","height":"80px","sizeSlug":"full","linkDestination":"none","style":{"color":{"duotone":"var:preset|duotone|base"}}} -->
                <figure class="wp-block-image size-full is-resized"><img
                        src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/icon-5.png" style="width:auto;height:80px" /></figure>
                <!-- /wp:image -->

                <!-- wp:spacer {"height":"var:preset|spacing|50"} -->
                <div style="height:var(--wp--preset--spacing--50)" aria-hidden="true" class="wp-block-spacer"></div>
                <!-- /wp:spacer -->

                <!-- wp:heading {"level":4,"align":"wide"} -->
                <h4 class="wp-block-heading alignwide"><?php esc_html_e( 'Dental', 'patterns-medical' ); ?></h4>
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
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"verticalAlignment":"center","layout":{"type":"constrained"}} -->
        <div class="wp-block-column is-vertically-aligned-center">
            <!-- wp:group {"style":{"border":{"radius":"5px"},"spacing":{"blockGap":"0px","padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"backgroundColor":"default","layout":{"type":"constrained"}} -->
            <div class="wp-block-group has-default-background-color has-background"
                style="border-radius:5px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">
                <!-- wp:image {"width":"auto","height":"80px","sizeSlug":"full","linkDestination":"none","style":{"color":{"duotone":"var:preset|duotone|base"}}} -->
                <figure class="wp-block-image size-full is-resized"><img
                        src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/icon-6.png" style="width:auto;height:80px" /></figure>
                <!-- /wp:image -->

                <!-- wp:spacer {"height":"var:preset|spacing|50"} -->
                <div style="height:var(--wp--preset--spacing--50)" aria-hidden="true" class="wp-block-spacer"></div>
                <!-- /wp:spacer -->

                <!-- wp:heading {"level":4,"align":"wide"} -->
                <h4 class="wp-block-heading alignwide"><?php esc_html_e( 'Cardio', 'patterns-medical' ); ?></h4>
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
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"verticalAlignment":"center","layout":{"type":"constrained"}} -->
        <div class="wp-block-column is-vertically-aligned-center">
           <!-- wp:group {"style":{"border":{"radius":"5px"},"spacing":{"blockGap":"0px","padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"backgroundColor":"default","layout":{"type":"constrained"}} -->
            <div class="wp-block-group has-default-background-color has-background"
                style="border-radius:5px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">
                <!-- wp:image {"width":"auto","height":"80px","sizeSlug":"full","linkDestination":"none","style":{"color":{"duotone":"var:preset|duotone|base"}}} -->
                <figure class="wp-block-image size-full is-resized"><img
                        src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/icon-7.png" style="width:auto;height:80px" /></figure>
                <!-- /wp:image -->

                <!-- wp:spacer {"height":"var:preset|spacing|50"} -->
                <div style="height:var(--wp--preset--spacing--50)" aria-hidden="true" class="wp-block-spacer"></div>
                <!-- /wp:spacer -->

                <!-- wp:heading {"level":4,"align":"wide"} -->
                <h4 class="wp-block-heading alignwide"><?php esc_html_e( 'Medicine', 'patterns-medical' ); ?></h4>
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
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->

</div>
<!-- /wp:group -->