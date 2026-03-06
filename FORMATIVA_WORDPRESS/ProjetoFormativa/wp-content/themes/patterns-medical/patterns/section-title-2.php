<?php
/**
 * Title: Section Title 2
 * Slug: patterns-medical/section-title-2
 * Categories: text, featured
 * Description: A layout featuring a title, content, and button group in centered alignment, commonly used for section titles in feature areas.
 *
 * @package    Patterns_Medical
 * @subpackage Patterns_Medical/patterns
 * @since      1.0.0
 */

?>
<!-- wp:group {"style":{"spacing":{"blockGap":"0","padding":{"right":"var:preset|spacing|80","left":"var:preset|spacing|80"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"
    style="padding-right:var(--wp--preset--spacing--80);padding-left:var(--wp--preset--spacing--80)">
    <!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","letterSpacing":"1px"}},"textColor":"primary","fontSize":"x-small"} -->
    <p class="has-text-align-center has-primary-color has-text-color has-x-small-font-size"
        style="letter-spacing:1px;text-transform:uppercase"><?php esc_html_e( 'Our Team', 'patterns-medical' ); ?></p>
    <!-- /wp:paragraph -->

    <!-- wp:heading {"textAlign":"center"} -->
    <h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'Book an Appointment to Get Quality Dental Services', 'patterns-medical' ); ?></h2>
    <!-- /wp:heading -->
</div>
<!-- /wp:group -->