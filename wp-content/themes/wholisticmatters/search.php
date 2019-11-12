<?php 
global $wp_query;
get_header(); ?>
<div class="boxed">
	<?php get_template_part('navbar-search-box'); ?>
	<script>
	jQuery(document).ready(function($){
		$(".boxed .short_link_search").click(function (e) {
			$(this).closest('.search-box').toggleClass("advance-open");
		});
	});
	</script>
	<div class="sm-wrapp">
		<div class="row">
            <div class="col-md-12 ">
				<h5 class="search_res_info"><?php _e(sprintf('<span class="wm_s_found_posts">%d</span> results for "%s"', 0, get_search_query())); ?></h5>
				<div class="tabs-me wm-archive-tabs wm_search_tabs js_wm_search_tabs" style="display: none;">
					<span class="tabs_links_lbl">View:</span>
					<span class="tabs-links">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active show" id="all_media-tab" data-toggle="tab" href="#all_media" role="tab" aria-controls="all_media" aria-selected="true">(<b>0</b>) <?php _e('All'); ?></a>
							</li>
							<li class="nav-item">
                                <a class="nav-link" id="Articles-tab" data-toggle="tab" href="#Articles" role="tab"
								   aria-controls="Articles" aria-selected="false">(<b>0</b>) <?php _e('Articles'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="Videos-tab" data-toggle="tab" href="#Videos" role="tab"
                                    aria-controls="Videos" aria-selected="false">(<b>0</b>) <?php _e('Videos'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="Podcast-tab" data-toggle="tab" href="#Podcast" role="tab"
                                    aria-controls="Podcast" aria-selected="false">(<b>0</b>) <?php _e('Podcast'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="Downloads-tab" data-toggle="tab" href="#Downloads" role="tab"
                                    aria-controls="Downloads" aria-selected="false">(<b>0</b>) <?php _e('PDF Resources'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="Recipes-tab" data-toggle="tab" href="#Recipes" role="tab"
                                    aria-controls="Recipes" aria-selected="false">(<b>0</b>) <?php _e('Recipes'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="Skills-tab" data-toggle="tab" href="#Skills" role="tab"
                                    aria-controls="Skills" aria-selected="false">(<b>0</b>) <?php _e('Skill Videos'); ?></a>
                            </li>
						</ul>
					</span>
					
						
					
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active" id="all_media" role="tabpanel" aria-labelledby="all_media-tab"></div>
						<div class="tab-pane fade" id="Articles" role="tabpanel" aria-labelledby="Articles-tab"></div>
						<div class="tab-pane fade" id="Videos" role="tabpanel" aria-labelledby="Videos-tab"></div>
						<div class="tab-pane fade" id="Podcast" role="tabpanel" aria-labelledby="Podcast-tab"></div>
						<div class="tab-pane fade" id="Downloads" role="tabpanel" aria-labelledby="Downloads-tab"></div>
						<div class="tab-pane fade" id="Recipes" role="tabpanel" aria-labelledby="Recipes-tab"></div>
						<div class="tab-pane fade" id="Skills" role="tabpanel" aria-labelledby="Skills-tab"></div>
					</div>
						
				</div>
			</div>
		</div>
	</div>
</div>   
<?php get_footer(); ?>