<?php
/**
 * Sanitization functions
 * List of all sanitization functions used globally on the theme.
 *
 * @package 	AuroraWPThemes
 * @since 		1.0
 */

if ( ! function_exists( 'aurora_sanitize_checkbox' ) ) {
    /**
     * Sanitizes checkbox values.
     *
     * @param  boolean|integer|string|null $input The checkbox value.
     * @return bool
     * @since  1.0
     */
    function aurora_sanitize_checkbox( $input ) {
        return ( ( isset( $input ) && true === $input ) ? true : false );
    }
}

if ( ! function_exists( 'aurora_sanitize_text' ) ) {
    /**
     * Sanitizes text/textarea inputs.
     *
     * @param  integer|string|null $input The text input.
     * @return string/mixed
     * @since  1.0
     */
    function aurora_sanitize_text( $input ) {

    	// List of allowed tags.
		$allowed_tags = wp_kses_allowed_html( 'post' );

		return wp_kses( stripslashes_deep( $input ), $allowed_tags );
    }
}

if ( ! function_exists( 'aurora_sanitize_select' ) ) {
    /**
     * Sanitizes Radio Button and Select inputs.
     *
     * @param  string $input The radio/select input.
     * @return string
     * @since  1.0
     */
	function aurora_sanitize_select( $input, $setting ) {
        // Input must be a slug.
        $input = sanitize_key( $input );

        // List of possible select options.
        $choices = $setting->manager->get_control( $setting->id )->choices;

        // Return input if valid or return default option.
        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}
}

if ( ! function_exists( 'aurora_sanitize_url' ) ) {
    /**
     * Sanitizes URL inputs.
     *
	 * @param  string $input Input to be sanitized (either a string containing a single url or multiple, separated by commas).
	 * @return string
     * @since  1.0
     */
	function aurora_sanitize_url( $input ) {

		// Check for single or multiple URL.
		if ( strpos( $input, ',' ) !== false ) {
			$input = explode( ',', $input );
		}

		// Check for array.
		if ( is_array( $input ) ) {
			foreach ( $input as $key => $value ) {
				$input[ $key ] = esc_url_raw( $value );
			}
			$input = implode( ',', $input );
		} else {
			$input = esc_url_raw( $input );
		}

		return $input;
	}
}

if ( ! function_exists( 'aurora_sanitize_switch' ) ) {
    /**
     * Sanitizes Switch inputs.
     *
	 * @param  string $input Switch input.
	 * @return string
     * @since  1.0
     */
	function aurora_sanitize_switch( $input ) {

		if ( true === $input ) {
			return 1;
		} else {
			return 0;
		}
	}
}

if ( ! function_exists( 'aurora_sanitize_number' ) ) {
    /**
     * Sanitizes Number inputs.
     *
	 * @param  string $input Number input.
	 * @return string
     * @since  1.0
     */
	function aurora_sanitize_number( $input ) {
		return absint( $input );
	}
}

if ( ! function_exists( 'aurora_sanitize_select2' ) ) {
    /**
     * Sanitizes Select2 inputs.
     *
     * @param  string   Input to be sanitized (either a string containing a single string or multiple, separated by commas)
     * @return string   Sanitized input
     * @since  1.0
     */
    function aurora_sanitize_select2( $input ) {
        if ( false  !== strpos( $input, ',' ) ) {
            $input = explode( ',', $input );
        }

        if( is_array( $input ) ) {
            foreach ( $input as $key => $value ) {
                $input[$key] = sanitize_text_field( $value );
            }
            $input = implode( ',', $input );
        } else {
            $input = sanitize_text_field( $input );
        }

        return $input;
    }
}

    /**
     * Google Font sanitization
     *
     * @param  string   JSON string to be sanitized
     * @return string   Sanitized input
     */
    if ( ! function_exists( 'skyrocket_google_font_sanitization' ) ) {
        function skyrocket_google_font_sanitization( $input ) {
            $val =  json_decode( $input, true );
            if( is_array( $val ) ) {
                foreach ( $val as $key => $value ) {
                    $val[$key] = sanitize_text_field( $value );
                }
                $input = json_encode( $val );
            }
            else {
                $input = json_encode( sanitize_text_field( $val ) );
            }
            return $input;
        }
    }