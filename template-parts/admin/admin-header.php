<?php
/**
 * Template used to display admin welcome page header.
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

<div class="header">
    <h1><?php echo esc_html__( 'Welcome to ', 'aurora-wp' ) . esc_html( Base::get_instance()->get_theme_name() ); ?></h1>
    <h3><?php echo esc_html__( 'Theme Version: ', 'aurora-wp' ); ?><span><?php echo esc_html( Base::get_instance()->get_theme_version() ); ?></span></h3>
    <p class="about-theme">
        <?php
        echo sprintf(
            '%1$s %2$s. %2$s %3$s',
            esc_html__( 'Thank you for choosing', 'aurora-wp' ),
            esc_html( Base::get_instance()->theme_name ),
            esc_html__( 'is now installed and ready to use! Get ready to build some awesome websites. Check out the below tabs for more information and updates. We hope you will love it.', 'aurora-wp' )
        );
        ?>
    </p>
</div>