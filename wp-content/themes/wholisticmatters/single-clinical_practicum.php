<?php
/**
 * The template for displaying all single posts
 *
 */

get_header(); ?>

<?php
$meta_prefix = WM_META_PREFIX;

$feat_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
$feat_image = $feat_image !== false ? $feat_image[0] : '';
if(!$feat_image) {
    $feat_image = get_bloginfo('template_directory').'/images/article-thumbnail-placeholder.png';
}

$embed_files = rwmb_meta( $meta_prefix.'embed_file', array( 'limit' => 1 )  );
$embed_file = reset( $embed_files );
?>

    <div id="site-content" class="site-content">
        <main class="boxed no-padding" id="site-main">
            <?php while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="album-block">
                        <?php do_action('wm_floating_links'); ?>
                        <div class="sm-wrapp">
                            <div class="album-data">
                                <div class="image-side-album"  style="<?php echo 'background-image:url(\''. $feat_image .'\');'?>" >
                                </div>
                                <div class="content-side-album">
                                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                                    <?php if($embed_file) { ?>
                                        <a href="<?php echo esc_url($embed_file['url']); ?>" class="btn btn-theme-fix margin-20" download>Download</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="sm-wrapp">
                        <div class="section-album">
                            <div class="entry-header">
                                <div class="detail-head">
                                    <?php
                                    /* translators: used between list items, there is a space after the comma */
                                    $separate_meta = __( ' • ' );
                                    // Get Categories for posts.
                                    $categories_list = get_the_category_list( $separate_meta );

                                    // Get Tags for posts.
                                    $tags_list = get_the_tag_list( '', $separate_meta );
                                    ?>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <span class="pmeta_key_topics">Key Topics: <?php echo $categories_list;?></span>
                                        </div>
                                        <div class="col-sm-6 text-right">
                                            <span><?php the_date(); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row article-tags">
                                    <div class="col-sm-12">
                                        <div class="tags">
                                            <span><img src="<?php echo get_template_directory_uri(); ?>/images/tag-ico.svg" alt="image"></span>
                                            <span class="pmeta_tags">
								                <?php echo $tags_list; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="short-btn single-post-links">
                                            <?php do_action('wm_single_share'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .entry-header -->

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="data-with-post margin-20 entry-content">
                                        <?php if($embed_file){ ?>
                                            <h4><?php _e('About this PDF'); ?></h4>
                                        <?php } ?>
                                        <?php
                                        /* translators: %s: Name of current post */
                                        the_content( sprintf(
                                            __( 'Continue reading<span class="screen-reader-text"> "%s"</span>' ),
                                            get_the_title()
                                        ) );

                                        wp_link_pages( array(
                                            'before'      => '<div class="page-links">' . __( 'Pages:' ),
                                            'after'       => '</div>',
                                            'link_before' => '<span class="page-number">',
                                            'link_after'  => '</span>',
                                        ) );
                                        ?>
                                    </div><!-- .entry-content -->
                                </div>
                            </div>

                            <?php
                            global $post;
                            $related_posts  = new WP_Query( array(
                                'post_type' => 'post',
                                'posts_per_page' => 5,
                                'post_status' => 'publish',
                                'post__not_in' => array( get_the_ID() ),
                                'orderby' => 'rand', // date?
                                'tax_query' => array( //only default format
                                    'relation' => 'AND',
                                    array(
                                        'taxonomy' => 'category',
                                        'field' => 'term_id',
                                        'terms' =>  wp_get_post_categories(get_the_ID())
                                    ),
                                    array(
                                        'taxonomy' => 'post_format',
                                        'field' => 'slug',
                                        'terms' => array(
                                            'post-format-link'
                                        ),
                                        'operator' => 'IN'
                                    )
                                )
                            ) );
                            ?>
                            <?php if( $related_posts->have_posts()  ): ?>
                                <div class="row related-posts">
                                    <div class="col-sm-12">
                                        <div class="inner-heading">
                                            <h2 class="section_heading"><?php _e('Related Resources'); ?></h2>
                                        </div>
                                        <?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
                                            <?php get_template_part( 'template-parts/post/archive', 'item' ); ?>
                                        <?php endwhile;?>
                                    </div>
                                </div>
                                <?php wp_reset_postdata();  ?>
                            <?php endif; ?>

                        </div>
                    </div>

                </article><!-- #post-## -->

            <?php endwhile; ?>
        </main><!-- #site-main -->
    </div><!-- .site-content -->

<?php
$feat_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
$feat_image = $feat_image !== false ? $feat_image[0] : '';
?>

<script type="application/ld+json">
{
  "@type": "NewsArticle",
  "headline": "<?php the_title() ?>",
  "image": "<?php echo $feat_image ?>",
  "datePublished": "<?php echo get_the_date() ?>",
  "dateModified": "<?php the_modified_date() ?>",
  "description": "<?php echo htmlspecialchars(WM_get_post_excerpt( get_the_excerpt(), 150 )) ?>",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "<?php the_id() ?>"
  },
  "author": {
    "@type": "Organization",
    "name": "WholisticMatters"
  },
  "publisher": {
    "@type": "Organization",
    "name": "WholisticMatters"
  },
  "logo": {
    "@type": "ImageObject",
    "url": "https://wholisticmatters.com/wp-content/themes/wholisticmatters/images/logo.svg"
  },
  "citation": {
    "@type": "",
    "@id": ""
  }
}
</script>

<?php get_footer(); ?>