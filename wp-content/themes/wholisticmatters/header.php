<?php 
$wm_settings = Wholistic_Matters::get_settings();
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<?php wp_head(); ?>

    <!-- Google Recaptcha -->

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- Google Tag Manager -->

    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl+ '&gtm_auth=WK7bGF4PegQPQj4jljz3-g&gtm_preview=env-2&gtm_cookies_win=x';f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-MRLWL4F');</script>
    <!-- End Google Tag Manager -->


    <!-- Sharpspring Tracking Code -->

    <script type="text/javascript">
        var _ss = _ss || [];
        _ss.push(['_setDomain', 'https://koi-3QNF1WFNS0.marketingautomation.services/net']);
        _ss.push(['_setAccount', 'KOI-41PHP9GZ36']);
        _ss.push(['_trackPageView']);
        (function() {
            var ss = document.createElement('script');
            ss.type = 'text/javascript'; ss.async = true;
            ss.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'koi-3QNF1WFNS0.marketingautomation.services/client/ss.js?ver=1.1.1';
            var scr = document.getElementsByTagName('script')[0];
            scr.parentNode.insertBefore(ss, scr);
        })();
    </script>

    <!-- Bugherd -->

    <script type='text/javascript'>
    (function (d, t) {
      var bh = d.createElement(t), s = d.getElementsByTagName(t)[0];
      bh.type = 'text/javascript';
      bh.src = 'https://www.bugherd.com/sidebarv2.js?apikey=idjskgpcxxp7mfmbiwhkfa';
      s.parentNode.insertBefore(bh, s);
      })(document, 'script');
    </script>

</head>

<?php $promobar = get_field('promobar', 'option'); ?>

<body <?php body_class( ($promobar['promobar_enabled'] && !isset($_COOKIE['wm-hide-promobar'])) ? 'promobar-enabled' : '' ); ?> data-spy="scroll" data-target=".sidebar-list" data-offset="150">

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MRLWL4F&gtm_auth=WK7bGF4PegQPQj4jljz3-g&gtm_preview=env-2&gtm_cookies_win=x" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

<div class="search-overlay"></div>

<?php if(!is_search()){ get_template_part('navbar-search-box'); } ?>

<header id="primaryHeader" class="primaryHeader">

    <?php
    if(!isset($_COOKIE['wm-hide-promobar']))
    {
        if($promobar)
        {
            $promobarEnabled = $promobar['promobar_enabled'];

            if($promobarEnabled) { ?>

                <div class="primaryHeader__notice" style="background-color: <?php echo $promobar['promobar_background_color'] ?>">
                    <img class="icon" src="<?php bloginfo('template_directory'); ?>/images/Wav-icon.svg" />
                    <p><?php echo $promobar['promobar_text'] ?></p>
                    <a href="<?php echo $promobar['promobar_link_url'] ?>" class="learn-more" style="color: <?php echo $promobar['promobar_link_color'] ?>"><?php echo $promobar['promobar_link_text'] ?></a>
                    <a href="#" class="close">
                        <svg width="15px" height="15px" viewBox="0 0 14.801 14.801">
                            <defs><style>.a{fill:none;stroke:<?php echo $promobar['promobar_link_color'] ?>;stroke-linecap:round;stroke-width:1.5px;}</style></defs>
                            <g transform="translate(1.061 1.061)">
                                <line class="a" x2="12.68" y2="12.68" transform="translate(0 0)"/>
                                <line class="a" y1="12.68" x2="12.68" transform="translate(0 0)"/>
                            </g>
                        </svg>
                    </a>
                </div>

            <?php }
        }
    }
    ?>

    <div class="primaryHeader__inner">
        <div class="primaryHeader__logo">
            <a href="<?php echo site_url('/'); ?>">
                <img src="<?php bloginfo('template_url'); ?>/images/wm-logo.svg" alt="Logo">
            </a>
        </div>

        <div class="primaryHeader__nav">
            <?php if(!is_user_logged_in()) { ?>
                <div class="primaryHeader__mobile-links">
                    <a href="#" class="btn btn-outline-primary login_popup">Login</a>
                    <a href="#" class="btn btn-primary signup_popup">Sign Up</a>
                </div>
            <?php } ?>

            <nav id="primaryNav" role="navigation">
                <ul class="primaryNav__top-list">
                    <li class="hasMega">
                        <span>Discover</span>
                        <div class="primaryNav__dropdown mega">
                            <div class="primaryNav__dropdown-inner">
                                <div class="primaryNav__dropdown-column">
                                    <h3>Key Topics</h3>
                                    <ul>
                                        <li><a href="<?php bloginfo('url'); ?>/category/cardiometabolic-control/">Cardiometabolic Control</a></li>
                                        <li><a href="<?php bloginfo('url'); ?>/category/digestive-health/">Digestive Health</a></li>
                                        <li><a href="<?php bloginfo('url'); ?>/category/epigenetics-health/">Epigenetics</a></li>
                                        <li><a href="<?php bloginfo('url'); ?>/category/inflammation/">Inflammation</a></li>
                                        <li><a href="<?php bloginfo('url'); ?>/category/lifestyle-health-wellness/">Lifestyle Health &amp; Wellness</a></li>
                                        <li><a href="<?php bloginfo('url'); ?>/view-all-topics/" class="more">View All Topics</a></li>
                                    </ul>
                                </div>

                                <div class="primaryNav__dropdown-column">
                                    <h3>Spotlight Topics</h3>
                                    <ul>
                                        <li><a href="<?php bloginfo('url'); ?>/spotlight-topic/detox/">Detoxification</a></li>
                                        <li><a href="<?php bloginfo('url'); ?>/spotlight-topic/hemp-the-endocannabinoid-system/">Hemp &amp; the Endocannabinoid System</a></li>
                                        <li><a href="<?php bloginfo('url'); ?>/spotlight-topic/omega-3-fatty-acids/">Omega-3 Fatty Acids</a></li>
                                        <li><a href="<?php bloginfo('url'); ?>/spotlight-topic/organic-farming-whole-foods/">Organic Farming &amp; Whole Foods</a></li>
                                        <li><a href="<?php bloginfo('url'); ?>/spotlight-topic/subclinical-magnesium-deficiency/">Plant-based Magnesium</a></li>
                                        <li><a href="<?php bloginfo('url'); ?>/spotlight-topics/" class="more">View All</a></li>
                                    </ul>
                                </div>

                                <div class="primaryNav__dropdown-column">
                                    <h3>Media Base</h3>
                                    <ul>
                                        <li><a href="<?php bloginfo('url'); ?>/articles/">Articles</a></li>
                                        <li><a href="<?php bloginfo('url'); ?>/videos/">Videos</a></li>
                                        <li><a href="<?php bloginfo('url'); ?>/wholistic-matters-podcast-series/">Podcasts</a></li>
                                        <li><a href="<?php bloginfo('url'); ?>/resources/">Resources</a></li>
                                    </ul>
                                </div>

                                <div class="primaryNav__dropdown-column">
                                    <h3>Practitioner Specialty</h3>
                                    <ul>
                                        <li><a href="<?php bloginfo('url'); ?>/practitioner-specialty/acupuncture/">Acupuncture</a></li>
                                        <li><a href="<?php bloginfo('url'); ?>/practitioner-specialty/chiropractic/">Chiropractic</a></li>
                                        <li><a href="<?php bloginfo('url'); ?>/practitioner-specialty/functional-medicine/">Functional Medicine</a></li>
                                        <li><a href="<?php bloginfo('url'); ?>/practitioner-specialty/herbalist/">Herbalist</a></li>
                                        <li><a href="<?php bloginfo('url'); ?>/practitioner-specialty/integrative-medicine/">Integrative Medicine</a></li>
                                        <li><a href="<?php bloginfo('url'); ?>/practitioner-specialty/naturopathic/">Naturopathic</a></li>
                                        <li><a href="<?php bloginfo('url'); ?>/practitioner-specialty/nutrition/">Nutrition</a></li>
                                        <li><a href="<?php bloginfo('url'); ?>/practitioner-specialty/veterinary/">Veterinary</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li>
                        <span>Interactive Tools</span>
                        <div class="primaryNav__dropdown">
                            <ul>
                                <li><a href="<?php bloginfo('url'); ?>/interactive-tools/vitamin-advisor">Vitamin Advisor</a></li>
                                <li><a href="<?php bloginfo('url'); ?>/interactive-tools/drug-nutrient-interaction-tool">Drug-Nutrient Interaction</a></li>
                                <li><a href="<?php bloginfo('url'); ?>/interactive-tools/herbal-medicinals">Herbal Medicinals</a></li>
                                <li class="forHCP">
                                    <p>— Free With HCP Account —</p>
                                    <a href="<?php bloginfo('url'); ?>/interactive-tools/anatomic-biodigital-library">Anatomic / BioDigital Library</a>
                                    <a href="<?php bloginfo('url'); ?>/interactive-tools/clinical-practice-support">Clinical Practice Support</a>
                                </li>
                                <?php if(!is_user_logged_in()){?>
                                    <li class="link"><a href="<?php bloginfo('url'); ?>/interactive-tools">Learn More & Gain Access</a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <span>Professional Education</span>
                        <div class="primaryNav__dropdown">
                            <ul>
                                <li><a href="<?php bloginfo('url'); ?>/continuing-education">Continuing Ed</a></li>
                                <li class="forHCP">
                                    <p>— Free With HCP Account —</p>
                                    <a href="<?php bloginfo('url'); ?>/clinical-practicum">Clinical Practicum</a>
                                    <a href="<?php bloginfo('url'); ?>/white-papers">White Papers</a>
                                </li>
                            </ul>
                        </div>
                    </li>

<!--                    <li>-->
<!--                        <span>Culinary Wellness</span>-->
<!--                        <div class="primaryNav__dropdown">-->
<!--                            <ul>-->
<!--                                <li><a href="--><?php //bloginfo('url'); ?><!--/culinary-wellness">Overview</a></li>-->
<!--                                <li><a href="--><?php //bloginfo('url'); ?><!--/recipes">Recipes</a></li>-->
<!--                                <li><a href="--><?php //bloginfo('url'); ?><!--/cooking-skills-video">Skill Videos</a></li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                    </li>-->
                </ul>
            </nav>
        </div>

        <div class="primaryHeader__utilities">
            <div class="primaryHeader__utilities-search">
                <a href="#">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/Searchicon.svg" alt="Search" class="wm_open_search">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/close-x.png" alt="Close Search" class="wm_close_search">
                </a>
            </div>

            <?php if(is_user_logged_in()){ ?>
                <div class="primaryHeader__utilities-member-link">
                    <a href="<?php echo site_url('/member-account'); ?>" title="<?php esc_attr_e('Goto My Account'); ?>">
                        <i class="fas fa-user-circle fa-lg"></i>
                    </a>
                </div>
            <?php } ?>

            <div class="primaryHeader__utilities-links">
                <?php if(is_user_logged_in()){ ?>
                    <?php $current_user = wp_get_current_user(); ?>
                    <a href="<?php echo site_url('/member-account'); ?>" class="login-link">
                        <span>Hi <?php echo $current_user->display_name; ?></span>&nbsp;<i class="fas fa-user-circle fa-lg"></i>
                    </a>
                    <a href="<?php echo esc_url( wp_logout_url(site_url('/member-account')) ); ?>" class="logout-link"><?php _e('Logout'); ?></a>
                <?php } else { ?>
                    <a href="<?php echo site_url('/member-account'); ?>" class="btn btn-link">Login</a>
                    <a href="#" class="btn btn-primary signup_popup">Sign Up</a>
                <?php } ?>
            </div>

            <div class="primaryHeader__utilities-hamburger">
                <a href="#">
                    <img src="<?php bloginfo('template_directory') ?>/images/hamburger.svg" class="hamburger" />
                    <img src="<?php bloginfo('template_directory') ?>/images/nav-x.svg" class="close-nav" />
                </a>
            </div>
        </div>
    </div>
</header>