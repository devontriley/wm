<?php
$data = array(
    'header' => get_sub_field('header'),
    'posts' => get_sub_field('posts')
);
?>

<div class="module-related-content">
    <?php if($data['header']) { ?>
        <h2 class="mb-5"><?php echo $data['header'] ?></h2>
    <?php } ?>

    <?php
    $args = array(
        'post_type' => 'post',
        'post__in' => $data['posts'],
        'orderby' => 'post__in',
        'order' => 'ASC'
    );
    $query = new WP_Query($args);

    if( $query->have_posts()  ):
        while ( $query->have_posts() ) : $query->the_post();
            get_template_part( 'template-parts/post/archive', 'item' );
        endwhile;
        wp_reset_postdata();
    endif;
    ?>
</div>
