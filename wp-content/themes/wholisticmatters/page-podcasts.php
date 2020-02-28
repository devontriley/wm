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

                <a class="google-play" href="https://play.google.com/music/m/Iexe42hoohnnqiqijbwdkwd6ldm?t=WholisticMatters_Podcast_Series" target="_blank">
                    <svg viewBox="0 0 28.751 32.898"><defs><style>.a{fill:url(#a);}.b{fill:url(#b);}.c{fill:url(#c);}.d{fill:url(#d);}</style><linearGradient id="a" y1="0.5" x2="1" y2="0.5" gradientUnits="objectBoundingBox"><stop offset="0" stop-color="#63be6b"/><stop offset="0.506" stop-color="#5bbc6a"/><stop offset="1" stop-color="#4ab96a"/></linearGradient><linearGradient id="b" y1="0.5" x2="0.999" y2="0.5" gradientUnits="objectBoundingBox"><stop offset="0" stop-color="#3ec6f2"/><stop offset="1" stop-color="#45afe3"/></linearGradient><linearGradient id="c" y1="0.5" x2="1" y2="0.5" gradientUnits="objectBoundingBox"><stop offset="0" stop-color="#faa51a"/><stop offset="0.387" stop-color="#fab716"/><stop offset="0.741" stop-color="#fac412"/><stop offset="1" stop-color="#fac80f"/></linearGradient><linearGradient id="d" y1="0.5" x2="1" y2="0.5" gradientUnits="objectBoundingBox"><stop offset="0" stop-color="#ec3b50"/><stop offset="1" stop-color="#e7515b"/></linearGradient></defs><g transform="translate(0 0.001)"><path class="a" d="M18.441,10.027,1.057.091A.7.7,0,0,0,.352.1.7.7,0,0,0,0,.7s.007.916.014,2.424L12.677,15.791Z" transform="translate(0 0)"/><path class="b" d="M.2,44.4c.021,5.44.085,18.646.113,25.22L12.87,57.063Z" transform="translate(-0.186 -41.272)"/><path class="c" d="M195.521,147.987l-9.95-5.687-5.771,5.764,6.511,6.511,9.217-5.37a.7.7,0,0,0,.352-.606A.714.714,0,0,0,195.521,147.987Z" transform="translate(-167.13 -132.273)"/><path class="d" d="M1.7,236.75c.014,2.347.021,3.848.021,3.848a.687.687,0,0,0,.352.606.7.7,0,0,0,.7,0l17.99-10.493L14.257,224.2Z" transform="translate(-1.58 -208.402)"/></g></svg>
                </a>
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

    <!-- HERE IS WHERE THE TAB GOES -->

    <div class="podcast-tabs">
        <div class="tab-header">
            <div class="tab-header-item seasons" data-tab="seasons" href="<?php echo site_url('/podcasts-test/'); ?>#seasons">
                <span>Seasons</span>
            </div>

            <div class="tab-header-item" data-tab="qa" href="<?php echo site_url('/podcasts-test/'); ?>#qa">
                <span>Q&A Segment</span>
            </div>

            <div class="tab-header-item" data-tab="press" href="<?php echo site_url('/podcasts-test/'); ?>#press">
                <span>Press Kit</span>
            </div>
        </div>

        <div class="tab-body">
            <div class="tab-body-item seasons fadeIn" data-tab="seasons">
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
                                    <a class="img-link" href="/series/<?php echo($seasonSlug); ?>/"></a>
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

            <div class="tab-body-item fadeInDown" data-tab="qa">
                <svg class="pencil-man" viewBox="0 0 110.597 183.469">
                    <g transform="translate(24.948 14.247)">
                        <g transform="translate(0 16.487)">
                            <path class="a" d="M2319.649-607.806s1.513-2.954,1.183-3.825-1.742-3.964-1.742-3.964l-.429-.755s-1.05.07-.079,2.138-.024,1.351-.024,1.351L2317-614.356l-2.041-1.673-.815-.868s-.427-.529-.63-.56c-.592-.088-.447.43-.447.43l2.892,3.669-3.545-2.584s-.507-.248-.725-.027-.061.328-.061.328l3.344,3.953L2313-612.8s-.5-.23-.724-.024c-.241.227-.312.28-.312.28l7.03,5.41Z" transform="translate(-2311.297 617.467)"/>
                            <path class="a" d="M2314.555-606.334l-2.6-1.659a2.367,2.367,0,0,0-.916-.473.427.427,0,0,0-.484.361l3.677,2.921Z" transform="translate(-2310.558 610.964)"/>
                        </g>
                        <g transform="translate(42.185)">
                            <path class="a" d="M2534.486-637.913l-6.294-15.215s-.787,12.351,2.181,16.691S2534.486-637.913,2534.486-637.913Z" transform="translate(-2509.948 659.724)"/>
                            <g transform="translate(14.531)">
                                <path class="a" d="M2519.354-666.807s-2.674-.823-2.965-1.565-1.178-3.538-1.178-3.538l-.157-.738s.708-.634,1.283,1.251.8.807.8.807l.127-1.913.341-2.335.019-1.056a1.906,1.906,0,0,1,.08-.747c.327-.434.532-.027.532-.027l.271,4.1.774-3.86s.181-.48.448-.483c.252,0,.228.16.228.16l.143,4.562.623-1.946s.189-.463.45-.481c.284-.02.362-.032.362-.032l-1.369,7.831Z" transform="translate(-2515.054 676.911)"/>
                                <path class="a" d="M2530.126-671.366l.7-2.686a2.285,2.285,0,0,1,.312-.881.366.366,0,0,1,.519-.092l-.666,4.149Z" transform="translate(-2525.946 675.599)"/>
                            </g>
                            <rect class="b" width="3.704" height="4.084" transform="translate(17.58 15.114) rotate(-20.174)"/>
                            <path class="c" d="M2471.176-597.9l11.573-12.884-2.264-10.843s4.14-2.4,4.934-1.5c5.5,6.247,6.14,18.809,6.14,18.809l-21.87,22.742s1-2.363-5.792-4.376C2458.972-587.413,2470.271-596.807,2471.176-597.9Z" transform="translate(-2462.659 638.19)"/>
                        </g>
                        <path class="d" d="M2515.869-102.733l.281,3.273.6,2.718,1.1.731.827.249.24.46,2.858,1.891a4.973,4.973,0,0,0,3.177.193c.45-.108-.175-1.332-.333-1.516a22.59,22.59,0,0,0-2.278-2.223l-2.23-2.745-2.522-3.437Z" transform="translate(-2458.926 262.274)"/>
                        <path class="d" d="M2396.1-114.5l.715,1.311.386,1.477-.052,2.355-1.27.187-.962-.2-.627.441s-3.6.719-4.953.769c-2.244.078-3.474-.149-3.915-.583-.247-.242.8-.72,1.142-.771a13.186,13.186,0,0,0,4.085-1.591l1.639-1.86.313-1.315Z" transform="translate(-2364.629 270.479)"/>
                        <path class="e" d="M2430.933-371.483l20.646,77.724-5.246.334-10.02-24.728-2.426-7.457-11.91-29.254-2.293-16.091Z" transform="translate(-2389.418 456.193)"/>
                        <path class="e" d="M2401.223-308.92l-1.479-29.88,1.3-13.694,1.582-18.791-2.394-12.58-8.2,1.313-.926,20.264.508,19.218.4,7.243,3.095,28.519Z" transform="translate(-2368.767 465.14)"/>
                        <path class="a" d="M2342.459-575.98s-4.081-2.66-6.872-11.368c-.943-2.94-1.011-.2-1.823,2.682s2.385,9.31,7.37,13.12S2342.459-575.98,2342.459-575.98Z" transform="translate(-2327.236 613.099)"/>
                        <rect class="b" width="4.083" height="3.288" transform="translate(5.556 28.319) rotate(-14.365)"/>
                        <path class="f" d="M2361.436-544.76s-24.345-4.895-25.6-6.278c-5.093-5.618-11.307-20.6-11.307-20.6l6.868-2.775s6.365,12.4,7.014,13.984c.46,1.123,9.984,2.884,17.3,1.9C2359.214-559,2361.216-545.652,2361.436-544.76Z" transform="translate(-2320.655 602.84)"/>
                        <path class="c" d="M2385.7-461.47l2.59,4.977,1.032-12.956,3.367,11.812,19.4-2.613s-3.811-19.134-5.651-26.961l6.227-19.649s5.3-13.851-3.351-14.511-18.624-1.207-18.624-1.207S2380.432-486.827,2385.7-461.47Z" transform="translate(-2363.773 565.382)"/>
                        <path class="g" d="M2427.019-509.071s-6.091,13.871-2.328,28.043c.3,1.115,1.739,1.776,1.739,1.776l1.676-1.831S2426.127-497.379,2427.019-509.071Z" transform="translate(-2392.15 555.621)"/>
                        <path class="g" d="M2437.323-516.136l.485,2.925,5.217-4.422.04-.724Z" transform="translate(-2402.165 562.332)"/>
                        <path class="g" d="M2429.711-520.441l-1.659,5.361,1.937-2.165Z" transform="translate(-2395.465 563.837)"/>
                        <path class="a" d="M2440.9-531.838a18.262,18.262,0,0,1-1.049,3.048c-.635,1.232-5.619,2.59-6.38,2.728s.4-3.786.448-4.688c.038-.691.469-.45-.01-1.474Z" transform="translate(-2399.194 572.352)"/>
                        <path class="h" d="M2418.63-521.643l-1.477,4.122-1.895,15.8-2.722-12.42,2.239-2.148-1.215-2,2.679-3.26Z" transform="translate(-2384.253 564.706)"/>
                        <path class="c" d="M2402.915-476.4l2.532,7.638,15.028,3.556s1.33-11.742-.51-19.568l6.227-19.649s5.3-13.851-3.351-14.511c-1.219-.092-2.463-.182-3.7-.269-1.75-.123-5.016,4.9-5.8,6.343-.843,1.544-6.312,15.557-6.312,15.557Z" transform="translate(-2377.3 562.944)"/>
                        <path class="i" d="M2429.96-520.413l3.323.184-2.762,4.758-3.288,1.956.021,3.723-8.551,12.2,5.584-16.085Z" transform="translate(-2388.709 563.818)"/>
                        <path class="h" d="M2430.106-520.413l3.322.184-2.751,4.544-3.283,1.863.03,3.561-8.52,11.649,5.545-15.372Z" transform="translate(-2388.854 563.818)"/>
                        <path class="g" d="M2432.234-510.253l.881-.1-.088,2.169-.638.571-.889-.353Z" transform="translate(-2397.957 556.544)"/>
                        <path class="j" d="M2421.8-360.1l7.764.284,1.417,8.725-5.164.006s-2.734.012-3.173-2.311S2421.8-360.1,2421.8-360.1Z" transform="translate(-2390.944 447.969)"/>
                        <path class="j" d="M2383.763-352.8l1.888.225.5-7.016-2.69-.286C2383.464-357.555,2383.557-355.189,2383.763-352.8Z" transform="translate(-2363.242 447.808)"/>
                        <g transform="translate(28.84 22.178)">
                            <path class="a" d="M2435.151-548.7c.656,4.408.794,6.661.69,6.96-.73,2.053-6.46,1.023-6.414-.187a31.811,31.811,0,0,0-1.925-7.027C2427.1-549.662,2434.763-551.312,2435.151-548.7Z" transform="translate(-2423.898 563.107)"/>
                            <path class="k" d="M2432.872-550.111a13.93,13.93,0,0,0-3.552.735c.575,1.274,1.172,2.524,1.642,3.326,1.314,2.23,3.606,2.529,5.112,2.89a3.616,3.616,0,0,0,1.112.051c-.037-.782-.24-2.417-.711-5.589C2436.3-549.891,2434.616-550.2,2432.872-550.111Z" transform="translate(-2425.222 563.11)"/>
                            <path class="a" d="M2426.946-587.863l4.963,10.924s1.175,2.588.356,3.408a7.232,7.232,0,0,1-5.059,1.481c-1.5-.357-3.8-.657-5.111-2.889s-3.616-7.961-3.616-7.961-.037-2.216,3.923-2.673S2426.946-587.863,2426.946-587.863Z" transform="translate(-2417.388 590.382)"/>
                            <path class="l" d="M2424.783-596.907a2.165,2.165,0,0,1,2.069.65,2.445,2.445,0,0,1-.279,2.863,34.215,34.215,0,0,1-5.993,2.721,3.868,3.868,0,0,1-2.759-.347c-.589-.433.617-2.485,1.806-2.653C2422.651-594.1,2422.786-596.593,2424.783-596.907Z" transform="translate(-2416.801 596.945)"/>
                            <path class="l" d="M2416.791-577.969l2.144,4.72.764,2.667-.556.251-1.017.462s-4.609-5.72-3.371-7.174S2416.529-578.3,2416.791-577.969Z" transform="translate(-2414.544 583.402)"/>
                            <path class="a" d="M2424.448-553.782a.807.807,0,0,1-.4,1.074l-.433.2a.816.816,0,0,1-1.077-.4l-.787-1.728a.82.82,0,0,1,.406-1.08l.432-.194a.811.811,0,0,1,1.077.4Z" transform="translate(-2419.699 567.349)"/>
                        </g>
                    </g>
                    <g transform="translate(0 1.536)">
                        <path class="j" d="M2226.625-687.959a4.846,4.846,0,0,0-2.947,6.189l.721,2.032a4.845,4.845,0,0,0,6.19,2.946l89.339-31.7a4.847,4.847,0,0,0,2.948-6.189l-.721-2.032a4.849,4.849,0,0,0-6.189-2.947Z" transform="translate(-2222.624 720.719)"/>
                        <path class="g" d="M2226.948-677.757h0a5.631,5.631,0,0,1-5.3-3.744l-.72-2.032a5.629,5.629,0,0,1,3.419-7.18l89.341-31.7a5.6,5.6,0,0,1,1.88-.325,5.637,5.637,0,0,1,5.3,3.743l.721,2.033a5.63,5.63,0,0,1-3.419,7.179l-89.339,31.7A5.6,5.6,0,0,1,2226.948-677.757Zm88.62-43.432a4.059,4.059,0,0,0-1.361.236l-89.341,31.7a4.075,4.075,0,0,0-2.475,5.2l.721,2.032a4.076,4.076,0,0,0,3.835,2.711,4.057,4.057,0,0,0,1.363-.237l89.34-31.7a4.076,4.076,0,0,0,2.476-5.2l-.721-2.032A4.082,4.082,0,0,0,2315.569-721.189Z" transform="translate(-2220.605 722.741)"/>
                    </g>
                    <g transform="translate(95.305)">
                        <path class="j" d="M2581.188-722.6c.4,1.131.406,2.255.009,2.519q-4.82,2.987-9.643,5.967l-3.521-9.923q5.621-.723,11.248-1.448c.473-.044,1.18.835,1.578,1.963C2580.97-723.209,2581.078-722.9,2581.188-722.6Z" transform="translate(-2566.98 726.258)"/>
                        <path class="g" d="M2568.4-714.965l-4.165-11.736,4.429-.57q3.885-.5,7.773-1a1.219,1.219,0,0,1,.134-.008c1.033,0,1.871,1.337,2.275,2.483.062.169.124.345.186.52l.141.4c.429,1.209.61,2.829-.291,3.428-1.831,1.134-3.64,2.254-5.45,3.373Zm-2.059-10.442,2.877,8.11,3.4-2.1q2.663-1.647,5.326-3.3a3.366,3.366,0,0,0-.229-1.663l-.143-.4q-.092-.259-.185-.518a3.37,3.37,0,0,0-.872-1.442c-2.533.328-5.093.657-7.651.986Z" transform="translate(-2564.237 728.279)"/>
                    </g>
                </svg>

                <?php $qacopy = get_field('qa_intro_copy'); ?>
                <p class="eyebrow">Q&A Segment</p>
                <h2>Submit a question to be discussed on the podcast</h2>
                <?php if($qacopy):?>
                    <p class="copy">
                        <?php echo($qacopy); ?>
                    </p>
                <?php endif; ?>

                <!-- TODO: Dev set up with sharpspring and test -->
                <div class="form">
                    <form class="qaForm" action="" method="post">

                        <input id="hunniepot" type="hidden" name="hunniepot" value="" />

                        <div class="Data-one">
                            <div class="row">
                                <div class="col-sm-12">
                                    <fieldset class="form-group">
                                        <label for="name" class="bmd-label-floating"><?php _e( 'Name', 'wholistic-matters' ); ?></label>
                                        <input type="text" name="name" class="form-control" id="name">
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <fieldset class="form-group">
                                        <label for="email" class="bmd-label-floating"><?php _e( 'Email Address', 'wholistic-matters' ); ?></label>
                                        <input type="email" name="email" class="form-control" id="email">
                                    </fieldset>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <fieldset class="form-group">
                                        <label for="subject" class="bmd-label-floating"><?php _e( 'Subject', 'wholistic-matters' ); ?></label>
                                        <input type="subject" name="subject" class="form-control" id="subject">
                                    </fieldset>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <fieldset class="form-group">
                                        <label for="message" class="bmd-label-floating"><?php _e( 'What is your question?', 'wholistic-matters' ); ?></label>
                                        <textarea class="form-control" name="question" id="question"></textarea>
                                    </fieldset>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <fieldset class="form-group margin-fix">
                                        <div class="checkbox-btn">
                                            <input id="_wm_newsletter" type="checkbox" name="_wm_newsletter" value="yes" checked=""><label for="_wm_newsletter">Receive the latest WholisticMatters News</label>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>

                        <div class="g-recaptcha" data-sitekey="6LdYwcsUAAAAAEDkzWNY55E8cBKAhRb-MVQliGqa"></div>

                        <input type="hidden" class="hiddenRecaptcha required" name="hiddenRecaptcha" id="hiddenRecaptcha">

                        <div class="row" id="finish">
                            <div class="col-sm-12">
                                <fieldset class="form-group register_legal_info">
                                    <input type="submit" class="btn btn-theme-fix" value="<?php _e( 'Submit!', 'wholistic-matters' ); ?>">
                                </fieldset>
                            </div>
                        </div>

                        <!-- Honeypot -->
                        <input type="text" style="border:none;height:0;font-size:0;position:absolute;left:-9999px;" id="foobar" name="foobar" placeholder="Foobar" autocomplete="off">
                    </form>
                </div>
            </div>

            <div class="tab-body-item fadeInDown" data-tab="press">
                <div class="main-content">
                    <div class="primary">
                        <?php
                            $aboutContent = get_field('about');
                            $productionContent = get_field('production');
                            $castCrew = get_field('cast_and_crew');
                            $creator = get_field('creator');

                            if($aboutContent){?>
                                <h3>About the WholisticMatters Podcast Series</h3>
                                <p class="content">
                                    <?php echo($aboutContent); ?>
                                </p><?php
                            }

                            if($productionContent){?>
                                <h3>The Production</h3>
                                <p class="content">
                                    <?php echo($productionContent); ?>
                                </p><?php
                            }

                            if($castCrew){?>
                                <h3>Cast & Crew</h3>
                                <p class="content">
                                    <?php echo($castCrew); ?>
                                </p><?php
                            }

                            if($creator){?>
                                <h3>The Creator</h3>
                                <p class="content">
                                    <?php echo($creator); ?>
                                </p><?php
                            }
                        ?>
                    </div>

                    <div class="sidebar">
                         <?php
                            $seasons = WMHelper::getSeries();
                            $seasons = $seasons['terms'];
                            $totalSeasons = count($seasons);

                            for ($i = 0; $i <= $totalSeasons; $i++) {
                                $season = $seasons[$i];
                                $seasonName = $season->name;
                                $seasonNumber = ($totalSeasons - $i);
                                $pressKit = get_field('press_kit_file', $season);

                                if($pressKit){ ?>
                                    <h3>Downloadable Press Kit</h3>
                                    <a class="btn" href="<?php echo($pressKit);?>">
                                        Download Full Press Kit
                                    </a><?php
                                }
                            }

                             $website = get_field('website');
                             $email = get_field('email');
                             $downloadSubscribe = get_field('download_subscribe_copy');
                             $schedule = get_field('schedule');
                             $socialMedia = get_field('social_media');
                         ?>

                        <h3>Podcast Details:</h3>

                        <?php if($website){ ?>
                            <h4>Website:</h4>
                            <a class="content" href="<?php echo($website);?>">
                                <?php echo($website);?>
                            </a><?php
                        } ?>

                        <?php if($email){ ?>
                            <h4>Email:</h4>
                            <a class="content" href="mailto:<?php echo($email);?>">
                                <?php echo($email);?>
                            </a><?php
                        } ?>

                        <?php if($downloadSubscribe){ ?>
                            <h4>Download/Subscribe:</h4>
                            <p class="content">
                                <?php echo($downloadSubscribe); ?>
                            </p><?php
                        } ?>

                        <?php if($schedule){ ?>
                            <h4>Schedule:</h4>
                            <p class="content">
                                <?php echo($schedule); ?>
                            </p><?php
                        } ?>

                        <?php if($socialMedia){ ?>
                            <h4>Social Media</h4>
                            <div class="content sm">
                                <?php echo($socialMedia); ?>
                            </div><?php
                        } ?>

                        <?php
                        $trailerAudio = get_field('trailer_audio');
                        $transcript = get_field('trailer_transcript');
                        ?>

                        <?php if($trailerAudio): ?>
                            <h3>Season <?php echo($totalSeasons) ?> Trailer</h3>
                            <div class="audio-album">
                                <?php echo do_shortcode('[audio mp3="'. $trailerAudio .'"][/audio]'); ?>
                            </div>
                            <a class="content" target="_BLANK" href="<?php echo($trailerAudio);?>">Download (mp3)</a>

                            <?php if($transcript): ?>
                                <a class="content" target="_BLANK" href="<?php echo($transcript)?>">Transcript (PDF)</a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <?php

                $quotes = get_field('quotes');
                if($quotes): ?>
                    <div class="quotes">
                        <?php
                        $typeArray = [];
                        foreach($quotes as $quote):
                            $type = $quote['quote_type'];
                            array_push($typeArray, $type);
                        endforeach;

                        if(in_array('castcrew', $typeArray)): ?>
                            <div class="cast-crew">
                            <h3>Cast & Crew Quotes:</h3>
                            <?php
                                while(have_rows('quotes')):the_row();
                                    $type = get_sub_field('quote_type');
                                    $text = get_sub_field('quote_text');
                                    $byline = get_sub_field('byline');

                                    if($type == 'castcrew'): ?>
                                        <p class="quote"><?php echo($text); ?></p>
                                        <p class="byline"><?php echo($byline) ?></p>
                                    <?php
                                    endif;
                                endwhile;
                            ?>
                            </div>
                        <?php endif;

                        if(in_array('listener', $typeArray)): ?>
                            <div class="listener">
                                <h3>Listener Quotes:</h3>
                                <?php
                                    while(have_rows('quotes')):the_row();
                                        $type = get_sub_field('quote_type');
                                        $text = get_sub_field('quote_text');
                                        $byline = get_sub_field('byline');

                                        if($type == 'listener'): ?>
                                            <p class="quote"><?php echo($text); ?></p>
                                            <p class="byline"><?php echo($byline) ?></p>
                                        <?php
                                        endif;
                                    endwhile;
                                ?>
                            </div>
                        <?php endif;?>
                    </div>
                <?php endif;?>

                <?php
                $gallery = get_field('image_gallery');

                if($gallery): ?>
                    <div class="images">
                        <h3>Image Downloads</h3>
                            <ul>
                                <?php foreach( $gallery as $image ): ?>
                                    <li>
                                        <a target="_BLANK" href="<?php echo esc_url($image['url']); ?>">
                                            <img src="<?php echo esc_url($image['sizes']['large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                            <p><?php echo esc_html($image['caption']); ?></p>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                    </div>
                <?php endif; ?>
            </div>
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
                your life
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