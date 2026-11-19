<?php
/**
 * Title: Featured Section 5
 * Slug: patterns-medical/featured-section-5
 * Categories: featured
 * Description: A collection of various WordPress inbuilt blocks, such as headings, paragraphs, image, groups, and buttons, arranged in different positions to form a complete page layout.
 *
 * @package    Patterns_Medical
 * @subpackage Patterns_Medical/patterns
 * @since      1.0.0
 */

?>
<!-- wp:group {"align":"full","style":{"layout":{"selfStretch":"fit","flexSize":""},"spacing":{"padding":{"bottom":"var:preset|spacing|80","top":"var:preset|spacing|80"}}},"backgroundColor":"quaternary","layout":{"type":"constrained","contentSize":""}} -->
<div class="wp-block-group alignfull has-quaternary-background-color has-background" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|40","left":"var:preset|spacing|80"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"40%","layout":{"type":"default"}} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:40%"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"left","style":{"typography":{"textTransform":"uppercase","letterSpacing":"1px"}},"textColor":"primary","fontSize":"x-small"} -->
<p class="has-text-align-left has-primary-color has-text-color has-x-small-font-size" style="letter-spacing:1px;text-transform:uppercase"><?php esc_html_e( 'Choose your plan', 'patterns-medical' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"left"} -->
<h2 class="wp-block-heading has-text-align-left"><?php esc_html_e( 'Our Affordable Pricing Plans', 'patterns-medical' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:spacer {"height":"var:preset|spacing|20"} -->
<div style="height:var(--wp--preset--spacing--20)" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:paragraph {"align":"left","textColor":"tertiary"} -->
<p class="has-text-align-left has-tertiary-color has-text-color"><?php esc_html_e( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas voluptatem maiores eaque similique non distinctio voluptates perspiciatis', 'patterns-medical' ); ?> </p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"60%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:60%"><!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"0","left":"var:preset|spacing|30"}}}} -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column">
    
    <!-- wp:pattern {"slug":"patterns-medical/card-3"} /-->

</div>
<!-- /wp:column -->

<!-- wp:column {"style":{"spacing":{"padding":{"top":"var:preset|spacing|80"}}}} -->
<div class="wp-block-column" style="padding-top:var(--wp--preset--spacing--80)">
    <!-- wp:group {"style":{"border":{"radius":"5px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"blockGap":"0"}},"backgroundColor":"default","layout":{"type":"constrained"}} -->
    <div class="wp-block-group has-default-background-color has-background" style="border-radius:5px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">
        
        <!-- wp:image {"width":"auto","height":"80px","sizeSlug":"full","linkDestination":"none","align":"center","style":{"color":{"duotone":"var:preset|duotone|base"}}} -->
        <figure class="wp-block-image aligncenter size-full is-resized"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/icon-8.png" style="width:auto;height:80px"/></figure>
        <!-- /wp:image -->

        <!-- wp:spacer {"height":"var:preset|spacing|40"} -->
        <div style="height:var(--wp--preset--spacing--40)" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->

        <!-- wp:heading {"textAlign":"center","level":4,"align":"wide"} -->
        <h4 class="wp-block-heading alignwide has-text-align-center"><?php esc_html_e( 'Gold Pack', 'patterns-medical' ); ?></h4>
        <!-- /wp:heading -->

        <!-- wp:spacer {"height":"var:preset|spacing|20"} -->
        <div style="height:var(--wp--preset--spacing--20)" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->

        <!-- wp:paragraph {"align":"center","textColor":"tertiary"} -->
        <p class="has-text-align-center has-tertiary-color has-text-color"><?php esc_html_e( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', 'patterns-medical' ); ?></p>
        <!-- /wp:paragraph -->

        <!-- wp:spacer {"height":"var:preset|spacing|30"} -->
        <div style="height:var(--wp--preset--spacing--30)" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->

        <!-- wp:group {"style":{"spacing":{"blockGap":"5px"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center","verticalAlignment":"bottom"}} -->
        <div class="wp-block-group">
                <!-- wp:group {"style":{"spacing":{"blockGap":"5px"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
                <div class="wp-block-group">
                
                    <!-- wp:heading {"level":6} -->
                    <h6 class="wp-block-heading"><sup><?php esc_html_e( '$', 'patterns-medical' ); ?></sup></h6>
                    <!-- /wp:heading -->

                    <!-- wp:heading {"level":4,"style":{"typography":{"lineHeight":"0.7"}},"fontSize":"xx-large"} -->
                    <h4 class="wp-block-heading has-xx-large-font-size" style="line-height:0.7"><?php esc_html_e( '79', 'patterns-medical' ); ?></h4>
                    <!-- /wp:heading -->
                </div>
                <!-- /wp:group -->

            <!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|tertiary"}}}},"textColor":"tertiary"} -->
            <p class="has-tertiary-color has-text-color has-link-color"><?php esc_html_e( '/ Mo', 'patterns-medical' ); ?></p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:group -->

        <!-- wp:spacer {"height":"var:preset|spacing|30"} -->
        <div style="height:var(--wp--preset--spacing--30)" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->

        <!-- wp:group {"style":{"spacing":{"blockGap":"5px"}},"layout":{"type":"flex","flexWrap":"nowrap","orientation":"vertical","justifyContent":"center"}} -->
        <div class="wp-block-group">
            
            <!-- wp:paragraph {"align":"center","textColor":"tertiary"} -->
            <p class="has-text-align-center has-tertiary-color has-text-color"><?php esc_html_e( 'Nemo enim ipsam', 'patterns-medical' ); ?></p>
            <!-- /wp:paragraph -->

            <!-- wp:paragraph {"align":"center","textColor":"tertiary"} -->
            <p class="has-text-align-center has-tertiary-color has-text-color"><?php esc_html_e( 'Voluptas sit aspernatur', 'patterns-medical' ); ?></p>
            <!-- /wp:paragraph -->

            <!-- wp:paragraph {"align":"center","textColor":"tertiary"} -->
            <p class="has-text-align-center has-tertiary-color has-text-color"><?php esc_html_e( 'Beatae vitae vitae dicta', 'patterns-medical' ); ?></p>
            <!-- /wp:paragraph -->

        </div>
        <!-- /wp:group -->


        <!-- wp:spacer {"height":"var:preset|spacing|20"} -->
        <div style="height:var(--wp--preset--spacing--20)" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->

        <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
        <div class="wp-block-buttons"><!-- wp:button {"className":"is-style-fill","style":{"spacing":{"padding":{"left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}}} -->
        <div class="wp-block-button is-style-fill"><a class="wp-block-button__link wp-element-button" style="padding-right:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><?php esc_html_e( 'Get Now', 'patterns-medical' ); ?></a></div>
        <!-- /wp:button --></div>
        <!-- /wp:buttons -->

    </div>
    <!-- /wp:group -->    
</div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->