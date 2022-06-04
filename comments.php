<?php 
   /*@package Jombazar */ 
   
   if (post_password_required()){return;}
?>

<div id="comments" class="row comments-area">
	<?php if(have_comments()) : ?>
		<h3 class="comment-title"> 
			<?php
				printf (
					esc_html(_nx('One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'cafesatu')),
					number_format_i18n(get_comments_number()),
					'<span>'.get_the_title().'</span>'
				);
			?>
		</h3>
		
		<?php bzbr001_get_post_navigation(); ?>
		
		<?php if(!comments_open() && get_comments_number()) :?>
		<p><?php esc_html_e('Comments are closed', 'bzbr001'); ?></p>
		<?php endif; ?>
		
		<ul class="comment-list">
		<?php
			$args = array (
				'walker' 		=> null,
				'max_depth' 	=> 3,
				'style'		=> 'ul',
				'callback'	=> null,
				'end-callback'=> null,
				'type'			=> 'all',
				'reply_text'	=> _('Reply'),
				'page'			=> '',
				'per_page'	=> '',
				'avatar_size'	=> 48,
				'reverse_top_level' 	=> true,
				'reverse_children' 	=> true,
				'format'		=> 'html5',
				'short_ping'	=> false,
				'echo'			=> true,
			);
			wp_list_comments($args);
		?>
		</ul>
		
		<?php bzbr001_get_post_navigation(); ?>
	
	<?php endif; ?>
	
	<?php 
	
		$fields = array (
			'author'	=> 
				'<div class="col-xs-6">
					<div class="form-group">
						<input id="author" name="author" placeholder = "*Name" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author'] ) . '" required="required" />
					</div>',
			
			'email' =>
					'<div class="form-group">
						<input id="email" name="email" placeholder = "*Email" type="text" class="form-control" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" " required="required" />
					</div>',
	
			'url' =>
					'<div class="form-group">
						<input id="url" name="url" placeholder = "Website" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author_url'] ) .'" />
					</div>
				</div>',
		);
		
		if(is_user_logged_in()):
			$comment_div = '<div class="col-xs-12">';
		else:
			$comment_div = '<div class="col-xs-6">';
		endif;
		
		$comment_field = 
			$comment_div.
				'<div class="form-group">
					<textarea id="comment" placeholder="*Your Comment" name="comment" class="form-control" rows="6" required="required">' .'</textarea>
				</div>
			</div>';
	
	
		$args = array(
			'title_reply' 	=> __( 'ADD A COMMENT' ),
			'class_submit'	=> 'btn btn-block btn-lg btn-danger',
			'label_submit'	=>	__('Submit Comment'),
			'comment_field'=>  $comment_field,
			'fields'		=> apply_filters('comment_form_default_fields', $fields),
		);
		
		comment_form($args); 

	?>
	
</div>
