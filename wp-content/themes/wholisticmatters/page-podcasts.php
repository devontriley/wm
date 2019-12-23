<?php 
/*Template Name: Podcasts Page */
get_header(); ?>

<div class="boxed no-padding podcasts-page">
    <!-- HERO -->
    <div class="banner-inner">
        <div class="data-banner">
            <p class="eyebrow">Podcast</p>

            <h1 class="banner_heading">
                <?php the_title(); ?>
            </h1>

            <div class="content">
                <?php the_content(); ?>
            </div>
        </div>

        <div class="podcasts-subscribe-container">
            <div class="btn podcasts-subscribe">
                Subscribe
            </div>

            <div class="sub-types">
                <a class="apple-music" href="https://podcasts.apple.com/us/podcast/wholistic-matters-podcast-series/id1312406856?mt=2" target="_blank">
                    <svg viewBox="0 0 26.087 32"><g transform="translate(-50.594 -117.805)"><path d="M298.2,120.387a6.351,6.351,0,0,1,4.66-2.582,6.337,6.337,0,0,1-1.534,4.743,5.011,5.011,0,0,1-4.419,2.079A5.511,5.511,0,0,1,298.2,120.387Z" transform="translate(-233.008 0)"/><path d="M63.861,265.7c1.082,0,3.089-1.521,5.7-1.521a7.121,7.121,0,0,1,6.267,3.274,7.116,7.116,0,0,0-3.461,6.2,7.267,7.267,0,0,0,4.311,6.662S73.668,289,69.6,289c-1.87,0-3.323-1.289-5.293-1.289-2.007,0-4,1.337-5.3,1.337-3.717,0-8.413-8.231-8.413-14.848,0-6.51,3.975-9.925,7.7-9.925C60.721,264.274,62.6,265.7,63.861,265.7Z" transform="translate(0 -139.242)"/></g></svg>
                </a>

                <a class="spotify" href="https://open.spotify.com/show/3l2qY0hjwTgJyNS7zDn0NT" target="_blank">
                    <svg viewBox="0 0 32 32"><g transform="translate(-29.555 -188.083)"><path d="M45.555,188.083a16,16,0,1,0,16,16A16,16,0,0,0,45.555,188.083Zm7.338,23.078a1,1,0,0,1-1.371.332c-3.757-2.3-8.486-2.815-14.056-1.543a1,1,0,1,1-.444-1.944c6.095-1.393,11.323-.794,15.54,1.783A1,1,0,0,1,52.893,211.161Zm1.958-4.357a1.248,1.248,0,0,1-1.716.411,21,21,0,0,0-15.943-1.865,1.247,1.247,0,1,1-.725-2.387,23.342,23.342,0,0,1,17.974,2.126A1.247,1.247,0,0,1,54.851,206.8Zm.169-4.536c-5.158-3.063-13.665-3.345-18.588-1.85a1.5,1.5,0,1,1-.869-2.864c5.652-1.716,15.047-1.384,20.984,2.14a1.5,1.5,0,0,1-1.528,2.574Z" transform="translate(0)"/></g></svg>
                </a>

<!--                <a class="google-play" href="#" target="_blank">-->
<!--                    <svg viewBox="0 0 28.751 32.898"><defs><style>.a{fill:url(#a);}.b{fill:url(#b);}.c{fill:url(#c);}.d{fill:url(#d);}</style><linearGradient id="a" y1="0.5" x2="1" y2="0.5" gradientUnits="objectBoundingBox"><stop offset="0" stop-color="#63be6b"/><stop offset="0.506" stop-color="#5bbc6a"/><stop offset="1" stop-color="#4ab96a"/></linearGradient><linearGradient id="b" y1="0.5" x2="0.999" y2="0.5" gradientUnits="objectBoundingBox"><stop offset="0" stop-color="#3ec6f2"/><stop offset="1" stop-color="#45afe3"/></linearGradient><linearGradient id="c" y1="0.5" x2="1" y2="0.5" gradientUnits="objectBoundingBox"><stop offset="0" stop-color="#faa51a"/><stop offset="0.387" stop-color="#fab716"/><stop offset="0.741" stop-color="#fac412"/><stop offset="1" stop-color="#fac80f"/></linearGradient><linearGradient id="d" y1="0.5" x2="1" y2="0.5" gradientUnits="objectBoundingBox"><stop offset="0" stop-color="#ec3b50"/><stop offset="1" stop-color="#e7515b"/></linearGradient></defs><g transform="translate(0 0.001)"><path class="a" d="M18.441,10.027,1.057.091A.7.7,0,0,0,.352.1.7.7,0,0,0,0,.7s.007.916.014,2.424L12.677,15.791Z" transform="translate(0 0)"/><path class="b" d="M.2,44.4c.021,5.44.085,18.646.113,25.22L12.87,57.063Z" transform="translate(-0.186 -41.272)"/><path class="c" d="M195.521,147.987l-9.95-5.687-5.771,5.764,6.511,6.511,9.217-5.37a.7.7,0,0,0,.352-.606A.714.714,0,0,0,195.521,147.987Z" transform="translate(-167.13 -132.273)"/><path class="d" d="M1.7,236.75c.014,2.347.021,3.848.021,3.848a.687.687,0,0,0,.352.606.7.7,0,0,0,.7,0l17.99-10.493L14.257,224.2Z" transform="translate(-1.58 -208.402)"/></g></svg>-->
<!--                </a>-->
            </div>
        </div>
    </div>

    <?php $aud_posts  = WMHelper::getPosts( 'audio', array('order' => 'DESC') ); ?>
    <?php if( $aud_posts->have_posts()  ): ?>
        <?php while ( $aud_posts->have_posts() ) : $aud_posts->the_post(); ?>
            <?php $link = get_the_permalink(); ?>
            <a id="stream-latest" href="<?php echo($link); ?>">Stream Latest Episode</a>
            <?php break; ?>
        <?php endwhile;?>
        <?php wp_reset_postdata();  ?>
    <?php endif; ?>

    <!-- SEASONS MODULES - ORDERED FROM NEWEST TO OLDEST -->
    <div class="podcast-seasons">
        <?php
            $seasons = WMHelper::getSeries();
            $seasons = $seasons['terms'];
            $totalSeasons = count($seasons);

            for ($i = 0; $i <= $totalSeasons; $i++) {
                $season = $seasons[$i];
                $seasonName = $season->name;
                $seasonHost = WMHelper::get_term_meta_text( $season->term_id, 'wm_series_host' );
                $seasonDesc = $season->description;
                $seasonImg = wp_get_attachment_image_src( $season->term_image, 'wm-topic' );
                $seasonThumb = isset($seasonImg[0]) ? $seasonImg[0] : $seasonThumb;
                $seasonNumber = ($totalSeasons - $i);
                $seasonSlug = $season->slug;
                $coverImage = get_field('podcast_season_cover', $season);

                if($seasonName) {?>
                    <div class="season-container">
                        <div class="img-block">
                            <img src="<?php echo($coverImage); ?>"/>
                        </div>

                        <div class="text-block">
                            <div class="text-inner">
                                <p class="eyebrow">Season <?php echo($seasonNumber); ?></p>
                                <h2><?php echo($seasonName); ?></h2>
                                <p class="host">Hosted By: <?php echo($seasonHost); ?></p>
                                <div class="content"><?php echo($seasonDesc); ?></div>
                                <!-- needs the correct linking -->
                                <a class="btn" href="/series/<?php echo($seasonSlug); ?>/">Listen Now</a>
                            </div>
                        </div>
                    </div> <?php
                }
            }
        ?>
    </div>

    <!-- MEET YOUR HOST -->
    <div class="meet-your-host">
        <?php
            $seasons = WMHelper::getSeries();
            $seasons = $seasons['terms'];
            $totalSeasons = count($seasons);
            $currentSeason = $seasons[0];
            $currentSeasonHost = WMHelper::get_term_meta_text( $currentSeason->term_id, 'wm_series_host' );
            $hostImage = get_field('meet_your_host_image');
            $hostIntro = get_field('meet_your_host_intro');
            $hostJobTitle = get_field('host_job_title');
            $hostEmployer = get_field('host_workplace');
        ?>

        <img class="host-img" src="<?php echo($hostImage); ?>">
        <p class="eyebrow">Meet Your Host</p>
        <h2>
            Season <?php echo($totalSeasons); ?>: <br>
            <?php echo($currentSeasonHost); ?>
        </h2>
        <div class="content">
            <?php echo($hostIntro); ?>
        </div>
        <div class="host-job-info">
            <p class="job-title"><?php echo($hostJobTitle); ?></p>
            <p class="employer"><?php echo($hostEmployer); ?></p>
        </div>
    </div>
</div>

<?php if(! is_user_logged_in()) { ?>
<!--     join wm module -->
    <div class="podcasts-page fiftyfifty">
        <div class="img-block">
            <img src="https://wholisticmatters.com/wp-content/uploads/2019/12/Rectangle-515.png"/>
        </div>

        <div class="text-block">
            <h2>Join WholisticMatters & Gain Full Access</h2>
            <p class="copy">
                Create a free WholisticMatters account for full access to premium articles, holistic nutrition resources
                and education focused interactive tools to help you integrate holistic nutrition into your practice and
                your life.
            </p>
            <a class="btn signup_popup">
                Create Your Free Account
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="10" viewBox="0 0 16 10">
                    <defs>
                        <style>.a{fill:#fff;fill-rule:evenodd;}</style>
                    </defs>
                    <path class="a" d="M14.589,9.333,9.571,13.49,10,14l6-5.014L10,4l-.43.509,5.019,4.157H0v.667H14.589Z" transform="translate(0 -4)"/>
                </svg>
            </a>
        </div>
    </div>
<?php } ?>

<?php get_footer(); ?>