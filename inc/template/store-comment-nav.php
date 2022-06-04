<?php /* @package Jombazar */ ?>

<nav class="comment-navigation" role="navigation">
	<div class="row">
		<div class="col-xs-6" style="padding-left: 0px;">
			<div class="post-link-nav" >
				<span class="fa fa-angle-left" aria-hidden="true"></span>
				<?php previous_comments_link(esc_html__('Older Comments', 'cafesatu')) ?>
			</div>
		</div>
	
		<div class="col-xs-6 text-right">
			<div class="post-link-nav">
				<?php next_comments_link(esc_html__('Newer Comments', 'cafesatu')) ?>
				<span class="fa fa-angle-right" aria-hidden="true"></span>
			</div>
		</div>
	</div>
</nav>