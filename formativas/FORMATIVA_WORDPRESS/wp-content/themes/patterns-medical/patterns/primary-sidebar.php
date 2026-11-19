<?php
/**
 * Title: Primary Sidebar
 * Slug: patterns-medical/primary-sidebar
 * Categories: posts
 * Block Types: core/template-part/primary-sidebar
 * Description: Display a collection of blocks for primary sidebar template part.
 *
 * @package    Patterns_Medical
 * @subpackage Patterns_Medical/patterns
 * @since      1.0.0
 */

?>
<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group">
    <!-- wp:pattern {"slug":"patterns-medical/search-form"} /-->
    <!-- wp:pattern {"slug":"patterns-medical/latest-posts"} /-->
    <!-- wp:pattern {"slug":"patterns-medical/latest-comments"} /-->
</div>
<!-- /wp:group -->