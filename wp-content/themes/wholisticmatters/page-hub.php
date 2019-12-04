<?php // Template Name: Hub Template
get_header(); ?>

    <div class="boxed">
        <div class="container">

            <div class="banner-inner">
                <div class="data-banner">
                    <div class="badge-banner">Clinically Driven, Evidence Based</div>
                    <div class="detail-data">
                        <p class="h2"><?php the_title(); ?></p>
                    </div>
                </div>
                <div class="image-banner">
                    <img width="377" height="275" src="<?php bloginfo('url'); ?>/wp-content/uploads/2019/04/DM_-71-377x275.jpg" class="attachment-wm-topic size-wm-topic" alt="">
                </div>
            </div>

            <div class="row my-4 my-md-5">
                <div class="hub-sidebar sidebar col-md-3">

                    <p class="sidebar-header">Page Navigation</p>

                    <?php
                    if(have_rows('modules')) :
                        $counter = 0;
                        echo '<div id="sidebar-list" class="sidebar-list list-group mb-md-4">';
                        while(have_rows('modules')) : the_row();
                        $sidebarTitle = get_sub_field('sidebar_title');
                        ?>

                        <a class="list-group-item list-group-item-action <?php if($counter == 0){ echo 'active'; }?>" href="#module-<?php echo $counter ?>"><?php echo $sidebarTitle ?></a>

                    <?php
                        $counter++;
                        endwhile;
                        echo '</div>';
                    endif; ?>

                    <div class="sidebar-subscribe">
                        <img class="mb-3" src="<?php bloginfo('template_directory'); ?>/images/newsletter/WM-EncasedPullaway.svg" alt="WM" width="50" />

                        <p class="sidebar-copy mb-3">Receive clinically guides nutrition insights you can trust.</p>

                        <a href="#" class="btn btn-primary newsletter-signup-modal-trigger">Subscribe</a>
                    </div>

                </div>

                <div class="main-copy col-md-9 pl-md-5">

                    <?php include('modules.php'); ?>

                </div>
            </div>

        </div>
    </div>

<?php get_footer(); ?>