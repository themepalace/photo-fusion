<?php
/**
 * Photo Fusion customizer validation functions
 *
 * @package Theme Palace
 * @subpackage Photo_Fusion

 * @since Photo Fusion 0.4
 */

function photo_fusion_validate_excerpt_length( $validity, $value ){
	$value = intval( $value );
    if ( empty( $value ) || ! is_numeric( $value ) ) {
        $validity->add( 'required', __( 'You must supply a valid number.', 'photo-fusion' ) );
    } elseif ( $value < 5 ) {
        $validity->add( 'min_excerpt_length', __( 'Minimum excerpt length is 5', 'photo-fusion' ) );
    } elseif ( $value > 15 ) {
        $validity->add( 'max_excerpt_length', __( 'Maximum excerpt length is 15', 'photo-fusion' ) );
    }
    return $validity;
}