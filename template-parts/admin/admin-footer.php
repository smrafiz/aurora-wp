<?php
/**
 * Template used to display admin welcome page footer.
 *
 * @package 	AuroraWPThemes
 * @since 		1.0
 */

use AuroraThemes\Core\Base as Base;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}
?>

<div class="footer">
    <div class="col-12">
        <h4>Leave us a review</h4>
        <p>Are you are enjoying <?php echo esc_html( Base::get_instance()->get_theme_name() ); ?>? We would love your feedback.</p>
        <a href="#" class="button button-primary">Submit a review</a>
    </div>
</div>