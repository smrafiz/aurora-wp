<?php
/**
 * Customizer Custom Control 'Typography_Control' Class.
 *
 * @package 	AuroraWPThemes
 * @since 		1.0
 */

namespace AuroraThemes\Customizer\Controls;

use AuroraThemes\Customizer\Controls\Control;

// Do not allow directly accessing this file.
if ( ! defined('ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

// Exit if WP_Customize_Control does not exsist.
if ( ! class_exists( 'WP_Customize_Control' ) ) {
    return null;
}

/**
 * Customizer Custom Control 'Typography_Control' Class.
 *
 * @since v1.0
 */
class Typography_Control extends Control {

    /**
     * The type of control being rendered.
     *
     * @access public
     * @since  1.0
     */
    public $type = 'typography';

    /**
     * The list of Google Fonts.
     *
     * @access private
     * @since  1.0
     */
    private $font_list = false;

    /**
     * The saved font values decoded from json.
     *
     * @access private
     * @since  1.0
     */
    private $font_values = [];

    /**
     * The index of the saved font within the list of Google fonts.
     *
     * @access private
     * @since  1.0
     */
    private $font_index = 0;

    /**
     * The number of fonts to display from the json file.
     * Either positive integer or 'all'. Default = 'all'.
     *
     * @access private
     * @since  1.0
     */
    private $font_count = 'all';

    /**
     * The font list sort order.
     * Either 'alpha' or 'popular'. Default = 'alpha'.
     *
     * @access private
     * @since  1.0
     */
    private $font_order = 'alpha';

    /**
     * Constructor.
     *
     * @access public
     * @since  1.0
     */
    public function __construct( $manager, $id, $args = [], $options = [] ) {

        parent::__construct( $manager, $id, $args );

        // Get the font sort order.
        if ( isset( $this->input_attrs['orderby'] ) && 'popular' === strtolower( $this->input_attrs['orderby'] ) ) {
            $this->font_order = 'popular';
        }

        // Get the list of Google fonts.
        if ( isset( $this->input_attrs['font_count'] ) ) {
            if ( 'all' != strtolower( $this->input_attrs['font_count'] ) ) {
                $this->font_count = ( abs( (int) $this->input_attrs['font_count'] ) > 0 ? abs( (int) $this->input_attrs['font_count'] ) : 'all' );
            }
        }

        $this->font_list = $this->get_google_fonts( 'all' );

        // var_dump( $this->font_list );

        // Decode the default json font value.
        $this->font_values = json_decode( $this->value() );

        // Find the index of our default font within our list of Google fonts
        $this->font_index = $this->get_font_index( $this->font_list, $this->font_values->font );
    }

    /**
     * Enqueue scripts and styles.
     *
     * @access public
     * @since  1.0
     */
    public function enqueue() {
        wp_enqueue_style( 'aurora-select2-styles', $this->get_assets_uri() . 'css/select2.min.css', [], '4.0.7' );
        wp_enqueue_style( 'aurora-customizer-control-styles', $this->get_assets_uri() . 'css/admin/customizer.css', [], $this->get_theme_version() );
        wp_enqueue_script( 'aurora-select2-js', $this->get_assets_uri() . 'js/select2.min.js', [ 'jquery' ], '4.0.7', true );
        wp_enqueue_script( 'aurora-customizer-control-js', $this->get_assets_uri() . 'js/admin/customizer.js', ['jquery', 'aurora-select2-js'], $this->get_theme_version(), true );
    }

    /**
     * Pass List of Google Fonts to JS.
     *
     * @access public
     * @since  1.0
     */
    public function to_json() {

        // Call parent to_json() method to get the core defaults like "label", "description", etc.
        parent::to_json();

        // Settings Fonts List.
        $this->json['aurorafontslist'] = $this->font_list;

    }

    /**
     * Render the control in the customizer.
     *
     * @access public
     * @since  1.0
     */
    public function render_content() {
        $font_counter = 0;
        $font_found = false;
        $render_font_list = '';

        if( empty( $this->font_list ) ) {
            return false;
        }
            ?>
        <div class="aurora-custom-control typography-control">

            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

            <?php
            if( ! empty( $this->description ) ) {
            ?>
                <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
            <?php
            }
            ?>

            <input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize-control-google-font-selection" <?php $this->link(); ?> />

            <div class="google-fonts">
                <select class="google-fonts-list" control-name="<?php echo esc_attr( $this->id ); ?>">
                    <?php
                        foreach( $this->font_list as $key => $value ) {
                            $font_counter++;
                            $render_font_list .= '<option value="' . $value->family . '" ' . selected( $this->font_values->font, $value->family, false ) . '>' . $value->family . '</option>';

                            if ( $this->font_values->font === $value->family ) {
                                $font_found = true;
                            }

                            if ( is_int( $this->font_count ) && $font_counter === $this->font_count ) {
                                break;
                            }
                        }

                        if ( ! $font_found && $this->font_index ) {
                            // If the default or saved font value isn't in the list of displayed fonts, add it to the top of the list as the default font
                            $render_font_list = '<option value="' . $this->font_list[ $this->font_index ]->family . '" ' . selected( $this->font_values->font, $this->font_list[ $this->font_index ]->family, false ) . '>' . $this->font_list[ $this->font_index ]->family . ' (default)</option>' . $render_font_list;
                        }

                        // Display list of font options.
                        echo $render_font_list;
                    ?>
                </select>
            </div>

            <div class="customize-control-description">Select weight &amp; style for regular text</div>
            <div class="weight-style">
                <select class="google-fonts-regularweight-style">
                    <?php
                        foreach( $this->font_list[$this->font_index]->variants as $key => $value ) {
                            echo '<option value="' . $value . '" ' . selected( $this->font_values->regularweight, $value, false ) . '>' . $value . '</option>';
                        }
                    ?>
                </select>
            </div>

            <input type="hidden" class="google-fonts-category" value="<?php echo $this->font_values->category; ?>">
        </div>
    <?php
    }

    /**
     * Find the index of the saved font in our multidimensional array of Google Fonts
     */
    public function get_font_index( $haystack, $needle ) {
        foreach( $haystack as $key => $value ) {
            if( $value->family == $needle ) {
                return $key;
            }
        }
        return false;
    }

    /**
     * Return the list of Google Fonts from our json file. Unless otherwise specfied, list will be limited to 30 fonts.
     */
    public function get_google_fonts( $count = 30 ) {

        $font_file = $this->get_assets_uri() . 'fonts/google-fonts/google-fonts-sort-by-alpha.json';

        if ( 'popular' === $this->font_order ) {
            $font_file = $this->get_assets_uri() . 'fonts/google-fonts/google-fonts-sort-by-popularity.json';
        }

        $request = wp_remote_get( $font_file );
        if( is_wp_error( $request ) ) {
            return "";
        }

        $body = wp_remote_retrieve_body( $request );
        $content = json_decode( $body );

        if( $count == 'all' ) {
            return $content->items;
        } else {
            return array_slice( $content->items, 0, $count );
        }
    }
}
