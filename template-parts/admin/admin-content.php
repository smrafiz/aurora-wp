<?php
/**
 * Template used to display admin welcome page content.
 *
 * @package 	AuroraWPThemes
 * @since 		1.0
 */

use AuroraThemes\Admin\Settings_Callbacks as Render;
use AuroraThemes\Admin\Plugins as Plugins;
use AuroraThemes\Core\Base as Base;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}
?>

<div id="aurora-content-tab">
    <?php
    echo '<p class="required-plugin-description">' . esc_html__( 'Aurora Core Plugin is required to use ', 'aurora-wp' ) . esc_html( Base::get_instance()->get_theme_name() ) . esc_html__( '. The recommended plugins offer design integrations for this theme. Install and activate all the plugins to get the full flavour of the theme.', 'aurora-wp' ) . '</p>'
    ?>

    <h2 class="nav nav-tab-wrapper">
        <?php

        // Initializing rendering.
        $content_render = Render::get_instance();

        // Building up tab content.
        $admin_tabs = [
            __( 'dashboard', 'aurora-wp' )      => [
                [
                    'title'     => esc_html__( 'Install Plugins', 'aurora-wp' ),
                    'description'      => esc_html__( 'We have created a curated list of recommended plugins. Please install and activate these plugins for using core functionalities of Aurora theme.', 'aurora-wp' ),
                    'column'    => 'col col-4',
                    'button'    => [
                        'text'          => esc_html__( 'Install Plugins', 'aurora-wp' ),
                        'link'          => esc_url( '#tab-recommened-plugins' ),
                        'need_button'   => true,
                        'new_tab'       => false,
                    ],
                ],
                [
                    'title'     => esc_html__( 'Documentation', 'aurora-wp' ),
                    'description'      => esc_html__( 'Need assistance? Learn more about any aspect of Aurora Theme.', 'aurora-wp' ),
                    'column'    => 'col col-4',
                    'button'    => [
                        'text'          => esc_html__( 'Read Documentation', 'aurora-wp' ),
                        'link'          => esc_url( 'https://themeitems.com' ),
                        'need_button'   => true,
                        'new_tab'       => true,
                    ],
                ],
                [
                    'title'     => esc_html__( 'Customize Aurora', 'aurora-wp' ),
                    'description'      => esc_html__( 'You can customize everything in Aurora theme using the powerful WordPress Customizer.', 'aurora-wp' ),
                    'column'    => 'col col-4',
                    'button'    => [
                        'text'          => esc_html__( 'Customize', 'aurora-wp' ),
                        'link'          => esc_url( admin_url( 'customize.php' ) ),
                        'need_button'   => true,
                        'new_tab'       => true,
                    ],
                ],
            ],
            __( 'recommened-plugins', 'aurora-wp' )        => [
                [
                    'title'             => esc_html__( 'Plugins', 'aurora-wp' ),

                    'column'            => 'col col-12',
                ],
            ],
            __( 'support', 'aurora-wp' )     => [
                [
                    'title'             => esc_html__( 'Need Some Help?', 'aurora-wp' ),
                    'description'       => esc_html__( 'Please contact us for any kind of help. We would love to be of any assistance.', 'aurora-wp' ),
                    'icon'              => esc_html__( '', 'aurora-wp' ),
                    'column'            => 'col col-4',
                    'button'            => [
                        'text'          => esc_html__( 'Contact Us', 'aurora-wp' ),
                        'link'          => esc_url( '#' ),
                        'need_button'   => true,
                        'new_tab'       => true,
                    ],
                ],
                [
                    'title'             => esc_html__( 'Documentation', 'aurora-wp' ),
                    'description'       => esc_html__( 'Need assistance? Learn more about any aspect of Aurora Theme.', 'aurora-wp' ),
                    'column'            => 'col col-4',
                    'button'            => [
                        'text'          => esc_html__( 'Read Documentation', 'aurora-wp' ),
                        'link'          => esc_url( 'https://themeitems.com' ),
                        'need_button'   => true,
                        'new_tab'       => true,
                    ],
                ],
                [
                    'title'             => esc_html__( 'Changelog', 'aurora-wp' ),
                    'description'       => esc_html__( 'Need to check the recent changes? Please check our changelog to get a summary of the recent fixes and implementions.', 'aurora-wp' ),
                    'column'            => 'col col-4',
                    'button'            => [
                        'text'          => esc_html__( 'Read Changelog', 'aurora-wp' ),
                        'link'          => esc_url( '#tab-changelog' ),
                        'need_button'   => true,
                        'new_tab'       => false,
                    ],
                ],
            ],
            __( 'demo-import', 'aurora-wp' ) => [
                [
                    'title'             => esc_html__( 'Import Demo Contents', 'aurora-wp' ),
                    'description'       => esc_html__( 'Clone a demo site in a few clicks.', 'aurora-wp' ),
                    'column'            => 'col col-12',
                ],
            ],
            __( 'changelog', 'aurora-wp' )   => [
                [
                    'title'             => esc_html__( 'Aurora Changelog', 'aurora-wp' ),
                    'description'       => esc_html__( 'Check for any recent changes', 'aurora-wp' ),
                    'column'            => 'col col-12',
                ],
            ],
        ];

        $tab_list = '';

        foreach( $admin_tabs as $key => $value ) {
            $tab_list .= '<a class="nav-tab" href="#tab-' . $key . '">' . esc_attr( ucfirst( str_replace( '-', ' ', $key ) ) ) . '</a>';
        }

        echo $tab_list; // WPCS: XSS ok.
        ?>

    </h2>

	<div class="tab-content">
        <div class="container">
            <?php
            $tab_content = '';

            $i = 0;
            foreach( $admin_tabs as $key => $value ) {
                $active = ( 0 === $i ) ? ' active' : '';
                $tab_content .= '<div class="tab-pane' . esc_attr( $active ) . '" id="tab-' . $key . '">';

                    switch( $key ) {
                        case 'recommened-plugins':
                            $tab_content .= $content_render->section_render( $value );
                            $tab_content .= Plugins::get_instance()->render();
                            break;

                        default:
                            $tab_content .= $content_render->section_render( $value );
                            break;
                    }
                $tab_content .= '</div>';

                $i++;
            }

            echo $tab_content; // WPCS: XSS ok.
            ?>
        </div><!-- .container -->
	</div><!-- .tab-content -->
</div><!-- .aurora-content-tab -->