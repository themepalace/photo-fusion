<div class="site-branding alignleft">
	<?php if ( function_exists( 'the_custom_logo' ) ) : ?>
		<div class="site-logo">
		   <?php the_custom_logo();?>
		</div><!-- end .site-logo -->
	<?php endif; ?>
	<?php $enable_site_header = display_header_text();

		if( $enable_site_header ) :
	?>
	    <div id="site-header">
	    	<?php 
		    	$site_name = get_bloginfo( 'name', 'display' );
		    	if( !empty( $site_name ) ) :
	    	?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php 
				endif;	
				$description = get_bloginfo( 'description', 'display' );
				if ( !empty( $description ) ) : 
			?>
				<h2 class="site-description"><?php echo esc_html( $description ); ?></h2>
			<?php endif; ?>
	    </div><!-- end #site-header -->
	<?php endif; ?>
</div><!-- end .site-branding -->