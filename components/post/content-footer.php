<footer class="entry-footer">

<?php $tags = get_the_tags();
    if( !empty ( $tags ) ) { ?>
    <div class="pull-right">
        <div class="widget widget_meta">
            <div class="widget-title">
                <h4>Tags</h4>
            </div><!-- end .widget-title -->
            <ul>
            <?php   
                foreach ( $tags as $key => $tag ) {
                       echo '<li><a href="'. esc_url( get_tag_link( $tag->term_id ) ).'">'. esc_html( $tag->name ) .'</a></li>';
                }
            ?>
            </ul>
        </div><!-- end .widget_meta -->
    </div><!-- end .pull-right -->
<?php } ?>
                  
</footer>