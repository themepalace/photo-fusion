<?php
	global $comment_status;
	if ( is_home() || is_archive() || is_single() || is_search() )  {
		photo_fusion_posted_on();
	}

	// get number of comments in a post
	if ( comments_open() && get_comments_number() ){
		photo_fusion_no_of_comment();
	}

?>