<?php 
/*Template Name: NEW Continuing Education Page */

get_header();

$courseCategoryParents = get_terms(array(
    'taxonomy' => 'course-categories',
    'parent' => 0
));
?>

<div class="boxed">

    <div class="container">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <?php
            $feat_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'wp-topic');
            $feat_image = $feat_image !== false ? $feat_image[0] : '';
            ?>
            <div class="main_banner pos_right">
                <div class="row">
                    <div class="col-md-7">
                        <div class="banner_desc_container">
                            <?php the_title( '<h1 class="banner_heading">', '</h1>' ); ?>
                            <div class="banner_desc">
                                <h2 class="banner_subheading">Explore Our Complimentary Continuing Education</h2>
                                <p>
                                    Keep your education growing and earn NYCC-approved credit hours from online courses sponsored by WholisticMatters.com, powered by Standard Process Inc. Once registered, you will need to Search, Request, Register, then Launch, and you'll be on your way to continuing your education.
                                </p>
                            </div>
                            <a class="btn btn-theme-fix" href="https://spuniversity.csod.com/selfreg/register.aspx?p=spuniversity&c=newaccount" target="_blank" rel="noreferrer">Get started</a>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="featured_image">
                            <img src="<?php echo bloginfo('template_directory'); ?>/images/Laptop-Desktop.png" class="img-fluid" />
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; endif; ?>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-7">
                <h2 class="section_heading_alt">Current Courses Available</h2>
                <div class="tabs-me wm-archive-tabs">
                    <span class="tabs_links_lbl">View:</span>
                    <span class="tabs-links">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <?php foreach($courseCategoryParents as $k => $v) { ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo ($k === 0) ? 'active' : '' ?>"
                                       id="tab<?php echo $k + 1 ?>"
                                       data-toggle="tab"
                                       href="#tabContent<?php echo $k + 1 ?>"
                                       role="tab"
                                       aria-controls="tabContent<?php echo $k + 1 ?>"
                                       aria-selected="true">
                                        <?php echo $v->name ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </span>

                    <div class="tab-content accordion" id="myTabContent">

                        <?php foreach($courseCategoryParents as $parentKey => $parentVal) {
                            $parentIndex = $parentKey + 1; ?>

                            <div class="tab-pane fade show <?php echo ($parentIndex === 1) ? 'active' : '' ?>" id="tabContent<?php echo $parentIndex ?>" role="tabpanel" aria-labelledby="tab<?php echo $parentIndex ?>">

                            <?php
                            $courseCategories = get_terms(array(
                                'taxonomy' => 'course-categories',
                                'parent' => $parentVal->term_id,
                                'orderby' => 'menu_order',
                                'order' => 'ASC'
                            ));

                            if(count($courseCategories) > 0)
                            {
                                foreach($courseCategories as $courseKey => $courseVal) {
                                    $courseIndex = $courseKey + 1;

                                    $coursePosts = new WP_Query(array(
                                        'post_type' => 'courses',
                                        'tax_query' => array(
                                            array(
                                                'taxonomy' => 'course-categories',
                                                'field' => 'term_id',
                                                'terms' => $courseVal->term_id
                                            )
                                        )
                                    ));

                                    if(count($coursePosts->posts) > 0) { ?>

                                            <h2 class="section_heading" data-toggle="collapse" data-target="#tabContent<?php echo $parentIndex ?>Expand<?php echo $courseIndex ?>" aria-expanded="false" aria-controls="tabContent<?php echo $parentIndex ?>Expand<?php echo $courseIndex ?>">
                                                <span><?php echo $courseVal->name ?></span>
                                                <span class="arrow">></span>
                                            </h2>

                                            <br />

                                            <div id="tabContent<?php echo $parentIndex ?>Expand<?php echo $courseIndex ?>" class="collapse" data-parent="#myTabContent">

                                            <?php
                                            if($courseVal -> description) { ?>
                                                <div class="card p-4 mb-3" style="font-size: 14px; background: #f7fcf3; color: #555; border: none;">
                                                    <?php echo $courseVal->description ?>
                                                </div>
                                            <?php }

                                            foreach($coursePosts->posts as $postKey => $postVal) {
                                                $postIndex = $postKey + 1; ?>
                                                    <h4><?php echo $postVal->post_title ?></h4>
                                                    <?php echo apply_filters('the_content', get_post_field('post_content', $postVal->ID)) ?>
                                            <?php } ?>

                                            </div>

                                    <?php } ?>

                                <?php }
                            } ?>
                            </div><!-- .tab-pane -->
                        <?php } ?>

                    </div><!-- .tab-content -->

                </div>
            </div>

            <div class="col-md-12 col-lg-5 articles-secton copy-block">
                <?php
                foreach($courseCategoryParents as $parentKey => $parentVal)
                {
                    $sidebarHeader = get_field('sidebar_header', $parentVal);
                    $sidebarCopy = get_field('sidebar_copy', $parentVal);
                    $registerLink = get_field('register_link', $parentVal); ?>

                    <div class="article-block <?php if($parentKey !== 0){ echo 'd-none'; }?>" data-accordion-parent="tabContent<?php echo $parentKey + 1 ?>">
                        <div class="head-section">
                            <h2 class="text-center"><?php echo $sidebarHeader ?></h2>
                        </div>
                        <div class="body-section">
                            <?php echo $sidebarCopy ?>
                            <a href="<?php echo $registerLink ?>" target="_blank" rel="noreferrer" class="btn btn-theme-fix">Register</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php
    foreach($courseCategoryParents as $parentKey => $parentVal)
    {
        $infoBoxes = get_field('additional_info_boxes', $parentVal);

        if($infoBoxes)
        {
            foreach($infoBoxes as $infoBoxKey => $infoBoxVal) {
                $infoBoxIndex = $infoBoxKey + 1; ?>

                <div class="image-text-module container" data-accordion-parent="tabContent<?php echo $parentKey + 1 ?>">
                    <div class="row">
                        <div class="copy col-md-12 col-lg-7">
                            <h2><?php echo $infoBoxVal['header'] ?></h2>
                            <?php echo $infoBoxVal['copy'] ?>
                        </div>
                        <div class="image col-md-12 col-lg-5">
                            <div class="image-wrapper">
                                <?php $imageWidth = strval($infoBoxVal['image_width']); ?>
                                <img class="mobile-margin" src="<?php echo $infoBoxVal['image']['url'] ?>" style="<?php if($imageWidth){ echo 'max-width: ' . $imageWidth . '%'; } ?>" />
                            </div>
                        </div>
                    </div>
                </div>

            <?php }
        }
    }
    ?>

    <div class="image-text-module container">
        <div class="row">
            <div class="image col-md-12 col-lg-5">
                <div class="image-wrapper">
                    <img class="img-fill" src="<?php echo bloginfo('template_directory'); ?>/images/clinical-education/hands.png" />
                </div>
            </div>
            <div class="copy col-md-12 col-lg-7">
                <h2>Get Started Today</h2>
                <p>
                    If this is your first time, get started by registering. If you're a returning user, continue by logging in. Once registered, you will need to Search, Request, Register, then Launch, and you’ll be on your way to continuing your education.
                </p>
                <a href="https://spuniversity.csod.com/selfreg/register.aspx?p=spuniversity&c=newaccount" target="_blank" rel="noreferrer" class="btn btn-primary">Register</a>
                <a href="https://spuniversity.csod.com/client/spuniversity/default.aspx" target="_blank" rel="noreferrer" class="btn btn-outline-primary">Login</a>
            </div>
        </div>
    </div>

</div>

<?php
foreach($courseCategoryParents as $parentKey => $parentVal)
{
    $additionalCopy = get_field('course_additional_copy', $parentVal);

    if($additionalCopy) { ?>

        <div class="course-additional-copy full-width-grey" data-accordion-parent="tabContent<?php echo $parentKey + 1 ?>">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <?php echo $additionalCopy ?>
                    </div>
                </div>
            </div>
        </div>

    <?php }
}
?>
	
<?php get_footer(); ?>