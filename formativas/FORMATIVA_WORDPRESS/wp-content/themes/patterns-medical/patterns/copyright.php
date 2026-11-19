<?php
/**
 * Title: Copyright
 * Slug: patterns-medical/copyright
 * Categories: footer
 * Block Types: core/template-part/footer
 * Description: Dynamic copyright text
 *
 * @package    Patterns_Medical
 * @subpackage Patterns_Medical/patterns
 * @since      1.0.0
 */

?>
<!-- wp:group {"style":{"spacing":{"blockGap":"5px"},"elements":{"link":{"color":{"text":"var:preset|color|default"}}}},"textColor":"default","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group has-default-color has-text-color has-link-color">
    
<!-- wp:paragraph {"placeholder":"<?php esc_attr_e( 'Dynamic copyright text', 'patterns-medical' ); ?>","metadata":{"bindings":{"content":{"source":"patterns-medical/copyright","args":{"key":"copyright"}}}},"fontSize":"x-small"} -->
<p class="has-x-small-font-size"></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php esc_html_e( '. All Rights Reserved', 'patterns-medical' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->