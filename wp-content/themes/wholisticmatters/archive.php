<?php 
global $post,$wp_query;
$meta_prefix = WM_META_PREFIX;
$tax_term = get_queried_object();
$tax_lbls = get_taxonomy_labels(get_taxonomy($tax_term->taxonomy));
$tax_label = isset($tax_lbls->name) ? $tax_lbls->name : __('Archive');
if(is_tag()){
	$tax_label = __('Topic');
}
$key_topic_image = ''; //default/fallback  image
if ( $tax_term->term_image ) {
    $key_topic_image = wp_get_attachment_image( $tax_term->term_image, 'wm-topic' );
}
?>
<?php get_header(); ?>
<div class="boxed">
    <!---Boxed-->
    <div class="<?php if(is_tag()): ?>sm-wrapp<?php else: ?>container<?php endif; ?>">
		<?php if(!is_tag()): ?>
		<div class="banner-inner <?php if(is_tag()){echo 'banner-inner-tag';}?>">
            <div class="data-banner">
                <div class="badge-banner"><?php echo strtoupper($tax_label); ?></div>
                <div class="detail-data">
                    <?php the_archive_title('<h1>','</h1>'); ?>
                    <?php the_archive_description(); ?>
                </div>
            </div>
            <div class="image-banner">
                <?php echo $key_topic_image; ?>
            </div>
        </div>
		<?php endif; ?>
        
        <div class="row">
            <div class="col-md-12 <?php if(!is_tag()): ?>col-lg-7<?php endif; ?>">
				<?php if(!is_tag()): ?>
					<?php 
					$feat_posts  = WMHelper::getFeaturedPosts( ); 
					?>
					<?php if( $feat_posts->have_posts()  ):  ?>
						<h2 class="section_heading"><?php _e('Featured Content'); ?></h2>
						<br>
						<?php while ( $feat_posts->have_posts() ) : $feat_posts->the_post(); ?>
							<?php get_template_part( 'template-parts/post/archive', 'item' ); ?>
						<?php endwhile;?>
					<?php wp_reset_postdata();  ?>
					<?php endif; ?>
                <?php endif; ?>
                    
                <?php   
				//library posts
                $a_posts  = WMHelper::getPosts( 'article' );
                $v_posts  = WMHelper::getPosts( 'video' );
                $aud_posts  = WMHelper::getPosts( 'audio' );
                $pdf_posts  = WMHelper::getPosts( 'pdf' );
                ?>
				<?php if(is_tag()): ?>		
					<?php the_archive_title('<h2 class="section_heading">','</h2>'); ?>
				<?php else: ?> 
					<?php the_archive_title('<h2 class="section_heading">',' '.__('Library').'</h2>'); ?>
				<?php endif; ?> 
                    
                <div class="tabs-me wm-archive-tabs">
					<?php if ( have_posts() ) : ?>
                    <span class="tabs_links_lbl">View:</span>
                    <span class="tabs-links">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                    aria-controls="home" aria-selected="true">(<?php echo $wp_query->found_posts; ?>) All</a>
                            </li>
							<?php if( $a_posts->have_posts()  ): ?>
                            <li class="nav-item">
                                <a class="nav-link" id="Articles-tab" data-toggle="tab" href="#Articles" role="tab"
                                    aria-controls="Articles" aria-selected="false">(<?php echo $a_posts->found_posts; ?>) Articles</a>
                            </li>
							<?php endif; ?>   
							<?php if( $v_posts->have_posts()  ): ?>
                            <li class="nav-item">
                                <a class="nav-link" id="Videos-tab" data-toggle="tab" href="#Videos" role="tab"
                                    aria-controls="Videos" aria-selected="false">(<?php echo $v_posts->found_posts; ?>) Videos</a>
                            </li>
							<?php endif; ?>   
							<?php if( $aud_posts->have_posts()  ): ?>
                            <li class="nav-item">
                                <a class="nav-link" id="Podcast-tab" data-toggle="tab" href="#Podcast" role="tab"
                                    aria-controls="Podcast" aria-selected="false">(<?php echo $aud_posts->found_posts; ?>) Podcast Episodes</a>
                            </li>
							<?php endif; ?>   
							<?php if( $pdf_posts->have_posts()  ): ?>
                            <li class="nav-item">
                                <a class="nav-link" id="Downloads-tab" data-toggle="tab" href="#Downloads" role="tab"
                                    aria-controls="Downloads" aria-selected="false">(<?php echo $pdf_posts->found_posts; ?>) PDF Downloads</a>
                            </li>
							<?php endif; ?>   
                        </ul>
                    </span>
					<?php endif; ?>   
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                             	<?php get_template_part( 'template-parts/post/archive', 'item' ); ?>
								<?php endwhile; ?>      
								<?php if ( $wp_query->max_num_pages > 1 ): ?>      
								<div class="text-center margin-40 wm_loadmore_archive_all">
									<a href="#." class="btn btn-theme-fix btn-gray wm_loadmore_archive_link js_wm_loadmore_archive" data-load-term="<?php echo $tax_term->term_id; ?>" data-load-tax="<?php echo esc_attr($tax_term->taxonomy); ?>" data-load-tab="all"><?php _e('Load More'); ?></a>
								</div>
								<?php endif; ?>      
                            <?php else: ?>   
								<?php get_template_part( 'template-parts/post/archive', 'none' ); ?>
                            <?php endif; ?>      
                        </div>
						<?php if( $a_posts->have_posts()  ): ?>
                        <div class="tab-pane fade" id="Articles" role="tabpanel" aria-labelledby="Articles-tab">
							<?php while ( $a_posts->have_posts() ) : $a_posts->the_post(); ?>
								<?php get_template_part( 'template-parts/post/archive', 'item' ); ?>
							<?php endwhile;?>
                            <?php wp_reset_postdata();  ?>
							<?php if ( $a_posts->max_num_pages > 1 ): ?>      
                            <div class="text-center margin-40 wm_loadmore_archive_all">
                                <a href="#." class="btn btn-theme-fix btn-gray wm_loadmore_archive_link js_wm_loadmore_archive" data-load-term="<?php echo $tax_term->term_id; ?>" data-load-tax="<?php echo esc_attr($tax_term->taxonomy); ?>" data-load-tab="article"><?php _e('Load More'); ?></a>
                            </div>
                            <?php endif; ?>
                        </div>
						<?php endif; ?>   
						<?php if( $v_posts->have_posts()  ): ?>
                        <div class="tab-pane fade" id="Videos" role="tabpanel" aria-labelledby="Videos-tab">
							<?php while ( $v_posts->have_posts() ) : $v_posts->the_post(); ?>
								<?php get_template_part( 'template-parts/post/archive', 'item' ); ?>
							<?php endwhile;?>
                            <?php wp_reset_postdata();  ?>
							<?php if ( $v_posts->max_num_pages > 1 ): ?>      
                            <div class="text-center margin-40 wm_loadmore_archive_all">
                                <a href="#." class="btn btn-theme-fix btn-gray wm_loadmore_archive_link js_wm_loadmore_archive" data-load-term="<?php echo $tax_term->term_id; ?>" data-load-tax="<?php echo esc_attr($tax_term->taxonomy); ?>" data-load-tab="video"><?php _e('Load More'); ?></a>
                            </div>
                            <?php endif; ?>
                        </div>
						<?php endif; ?>  
						<?php if( $aud_posts->have_posts()  ): ?>
                        <div class="tab-pane fade" id="Podcast" role="tabpanel" aria-labelledby="Podcast-tab">
							<?php while ( $aud_posts->have_posts() ) : $aud_posts->the_post(); ?>
								<?php get_template_part( 'template-parts/post/archive', 'item' ); ?>
							<?php endwhile;?>
                            <?php wp_reset_postdata();  ?>
							<?php if ( $aud_posts->max_num_pages > 1 ): ?>      
                            <div class="text-center margin-40 wm_loadmore_archive_all">
                                <a href="#." class="btn btn-theme-fix btn-gray wm_loadmore_archive_link js_wm_loadmore_archive" data-load-term="<?php echo $tax_term->term_id; ?>" data-load-tax="<?php echo esc_attr($tax_term->taxonomy); ?>" data-load-tab="audio"><?php _e('Load More'); ?></a>
                            </div>
                            <?php endif; ?>
                        </div>
						<?php endif; ?>  
						<?php if( $pdf_posts->have_posts()  ): ?>
                        <div class="tab-pane fade" id="Downloads" role="tabpanel" aria-labelledby="Downloads-tab">
							<?php while ( $pdf_posts->have_posts() ) : $pdf_posts->the_post(); ?>
								<?php get_template_part( 'template-parts/post/archive', 'item' ); ?>
							<?php endwhile;?>
                            <?php wp_reset_postdata();  ?>
							<?php if ( $pdf_posts->max_num_pages > 1 ): ?>      
                            <div class="text-center margin-40 wm_loadmore_archive_all">
                                <a href="#." class="btn btn-theme-fix btn-gray wm_loadmore_archive_link js_wm_loadmore_archive" data-load-term="<?php echo $tax_term->term_id; ?>" data-load-tax="<?php echo esc_attr($tax_term->taxonomy); ?>" data-load-tab="pdf"><?php _e('Load More'); ?></a>
                            </div>
                            <?php endif; ?>
                        </div>
						<?php endif; ?> 
                    </div>
                </div>
                    
            </div>
			<?php if(!is_tag()): ?>
				<div class="col-md-12 col-lg-5 articles-secton">
					<div class="article-block">
						 <?php if (function_exists('wpp_get_mostpopular')): ?>
						<div class="head-section">
							<h2>Trending Articles</h2>
						</div>
						<div class="body-section">
						   <?php
								$args = array(
									'post_format' => 1,
									'limit' => 5,
									'stats_date' => 1,
									'stats_author' => 1,
									'range' => 'all',
									'taxonomy' => $tax_term->taxonomy,
									'term_id' => $tax_term->term_id,
									'post_type' => 'post,post_format_article',
									'wpp_start' => '<ul class="wm-wpp-trending">',
									'post_html' => '<li class="box-article">'
									. '<span class="numbers"></span>'
									. '<span>{title} <br> <i class="wm-trending-meta">{author} • {date}</i></span>'
									. '</li>'
								);
								wpp_get_mostpopular($args);
							?>
						</div>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?> 
        </div>
        
        
        
    </div>   
</div>   
<?php get_footer(); ?>