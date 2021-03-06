
<?php get_header(); ?>
    <div class="boxed">
        <!---Boxed-->
        <div class="container">
            <div class="banner-inner">
                <div class="data-banner">
                    <!--<div class="badge-banner"></div>-->
                    <div class="detail-data">
                        <h2>Clinical Practicum</h2>
                        <p>The Clinical Practicum series is designed to provide clinical case studies to health care practitioners to support and prepare for the practical application of clinical nutrition insights.</p>
                    </div>
                </div>
                <div class="image-banner">
                    <img width="377" height="275" src="<?php bloginfo('template_directory'); ?>/images/clinical-practicum.jpg" class="attachment-wm-topic size-wm-topic" alt="Person drawing on graph">
                </div>
            </div>

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

                    <div class="tabs-me wm-archive-tabs">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                                    <?php get_template_part( 'template-parts/post/archive', 'item' ); ?>
                                <?php endwhile; ?>
                                    <?php if ( $wp_query->max_num_pages > 1 ): ?>
                                        <div class="text-center margin-40 wm_loadmore_archive_all">
                                            <a href="#." class="btn btn-theme-fix btn-gray wm_loadmore_archive_link js_wm_loadmore_archive" data-load-term="<?php echo $tax_term->term_id; ?>" data-load-tax="<?php echo esc_attr($tax_term->taxonomy); ?>" data-load-tab="all" data-load-post_type="clinical_practicum"><?php _e('Load More'); ?></a>
                                        </div>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php get_template_part( 'template-parts/post/archive', 'none' ); ?>
                                <?php endif; ?>
                            </div>
                        </div><!-- #myTabContent -->
                    </div><!-- .tabs-me -->
                </div><!-- .col-md-12 -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .boxed -->
<?php get_footer(); ?>