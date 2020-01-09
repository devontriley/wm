<?php // Template Name: White Papers ?>

<?php get_header(); ?>
    <div class="boxed">
        <!---Boxed-->
        <div class="container">
            <div class="banner-inner">
                <div class="data-banner">
                    <!--<div class="badge-banner"></div>-->
                    <div class="detail-data">
                        <h1>White Papers</h1>
                        <p>The White Papers series is designed to provide authoritative reports to guide health care practitioners through key issues and insights in clinical nutrition.</p>
                    </div>
                </div>
                <div class="image-banner">
                    <img width="377" height="275" src="<?php bloginfo('template_directory'); ?>/images/white-papers.jpg" class="attachment-wm-topic size-wm-topic" alt="Person using ipad">
                </div>
            </div>

            <div class="sm-wrapp">
                <div class="row">
                    <div class="col-12">
                        <?php
                        $feat_posts  = WMHelper::getFeaturedPosts(get_post_type_object('white_papers'));

                        if( $feat_posts->have_posts()  ):  ?>
                            <h2 class="section_heading"><?php _e('Featured Content'); ?></h2>
                            <br>
                            <?php while ( $feat_posts->have_posts() ) : $feat_posts->the_post(); ?>
                                <?php get_template_part( 'template-parts/post/archive', 'item' ); ?>
                            <?php endwhile;?>
                            <?php wp_reset_postdata();  ?>
                        <?php endif; ?>

                        <div class="tabs-me wm-archive-tabs">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <?php
                                    $wpPosts = new WP_Query(array(
                                        'post_type' => 'white_papers',
                                        'posts_per_page' => -1
                                    ));

                                    if ( $wpPosts->have_posts() ) : while ( $wpPosts->have_posts() ) : $wpPosts->the_post(); ?>
                                        <?php get_template_part( 'template-parts/post/archive', 'item' ); ?>
                                    <?php endwhile; ?>
                                        <?php if ( $cpPosts->max_num_pages > 1 ): ?>
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
            </div>
        </div><!-- .container -->
    </div><!-- .boxed -->
<?php get_footer(); ?>