<?php
/**
 * The template for displaying search form
 *
 * @package Theme Palace
 * @subpackage Photo Fusion 
 * @since Photo Fusion 0.1
 */

?>
<form action="<?php echo esc_url( home_url('/') ); ?>">

	<div class="form-group">
		<input type="text" name="s" placeholder="<?php __( 'search..', 'photo-fusion' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" >
		<button class="btn fill btn-js" type="submit"><i class="fa fa-search"></i></button>
	</div><!-- end .form-group -->
	
</form>