<?php
/**
 * Title: Footer
 * Slug: patterns-medical/footer
 * Categories: footer
 * Block Types: core/template-part/footer
 * Description: A pattern for displaying the site footer.
 *
 * @package    Patterns_Medical
 * @subpackage Patterns_Medical/patterns
 * @since      1.0.0
 */

?>
<!-- wp:group {"align":"full","className":"has-accent-background-color","backgroundColor":"quinary","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-accent-background-color has-quinary-background-color has-background"><!-- wp:columns {"verticalAlignment":"top","align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|80"},"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-top" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:column {"verticalAlignment":"top","width":"50%"} -->
<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:50%"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"700","lineHeight":"1.2"},"elements":{"link":{"color":{"text":"var:preset|color|default"}}}},"textColor":"default","fontSize":"x-large"} -->
<p class="has-default-color has-text-color has-link-color has-x-large-font-size" style="font-style:normal;font-weight:700;line-height:1.2"><?php esc_html_e( 'Choose Our Hospital, Choose The Best Care For Yourself', 'patterns-medical' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"top","width":"25%"} -->
<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:25%"><!-- wp:heading {"level":5,"textColor":"default"} -->
<h5 class="wp-block-heading has-default-color has-text-color"><?php esc_html_e( 'Address', 'patterns-medical' ); ?></h5>
<!-- /wp:heading -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|default"}}}},"textColor":"default","fontSize":"medium"} -->
<p class="has-default-color has-text-color has-link-color has-medium-font-size"><?php esc_html_e( '785 15h Street, Office 478 Berlin, De 81566 6391 Elgin St. Celina, 10299', 'patterns-medical' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:social-links {"iconColor":"default","iconColorValue":"#ffffff","className":"is-style-logos-only"} -->
<ul class="wp-block-social-links has-icon-color is-style-logos-only"><!-- wp:social-link {"url":"#","service":"twitter"} /-->

<!-- wp:social-link {"url":"#","service":"instagram"} /-->

<!-- wp:social-link {"url":"#","service":"whatsapp"} /--></ul>
<!-- /wp:social-links --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"top","width":"25%"} -->
<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:25%"><!-- wp:heading {"level":6,"textColor":"default"} -->
<h6 class="wp-block-heading has-default-color has-text-color"><?php esc_html_e( 'Say Hello', 'patterns-medical' ); ?></h6>
<!-- /wp:heading -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"className":"pwp-txt-dec-non","style":{"elements":{"link":{":hover":{"color":{"text":"var:preset|color|primary"}},"color":{"text":"var:preset|color|default"}}}},"fontSize":"medium"} -->
<p class="pwp-txt-dec-non has-link-color has-medium-font-size"><a href="<?php echo esc_url( 'mailto:info@example.com' ); ?>"><?php esc_html_e( 'info@example.com', 'patterns-medical' ); ?></a></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"pwp-txt-dec-non","style":{"elements":{"link":{":hover":{"color":{"text":"var:preset|color|primary"}},"color":{"text":"var:preset|color|default"}}}},"fontSize":"large"} -->
<p class="pwp-txt-dec-non has-link-color has-large-font-size"><a href="<?php echo esc_url( 'tel:(629) 555-0129' ); ?>"><?php esc_html_e( '(629) 555-0129', 'patterns-medical' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull">
    
    <!-- wp:group {"align":"wide","style":{"border":{"top":{"color":"#ffffff52","style":"solid","width":"1px"},"right":[],"bottom":[],"left":[]},"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
    <div class="wp-block-group alignwide" style="border-top-color:#ffffff52;border-top-style:solid;border-top-width:1px;padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)">
        
        
        <!-- wp:navigation {"textColor":"default","overlayMenu":"never","style":{"spacing":{"blockGap":"var:preset|spacing|20"},"typography":{"fontSize":"13px"}}} -->
        <!-- wp:navigation-link {"label":"Privacy","url":"#"} /-->

        <!-- wp:navigation-link {"label":"Policy","url":"#"} /-->

        <!-- wp:navigation-link {"label":"Terms \u0026amp; Conditions","url":"#"} /-->
        <!-- /wp:navigation -->

        <!-- wp:pattern {"slug":"patterns-medical/copyright"} /-->

    </div>
    <!-- /wp:group -->

</div>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"patterns-medical/scroll-to-top-button"} /-->

</div>
<!-- /wp:group -->