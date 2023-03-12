
<div class="apus-search-form search-fix clearfix">
	<div class="inner-search">
		<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
			<div class="main-search">
				<div class="autocompleate-wrapper">
			  		<input type="text" placeholder="<?php esc_attr_e( 'Search course...', 'edumy' ); ?>" name="s" class="apus-search form-control" autocomplete="off"/>
				</div>
			</div>
			<?php if ( defined('LP_COURSE_CPT') && LP_COURSE_CPT ) { ?>
                <input type="hidden" name="ref" value="course" class="post_type" />
            <?php } ?>
			<button type="submit" class="btn btn-theme radius-0"><i class="flaticon-magnifying-glass"></i></button>
		</form>
	</div>
</div>