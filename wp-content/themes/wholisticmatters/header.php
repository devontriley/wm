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

<body <?php body_class(); ?> data-spy="scroll" data-target=".sidebar-list" data-offset="150">

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MRLWL4F&gtm_auth=WK7bGF4PegQPQj4jljz3-g&gtm_preview=env-2&gtm_cookies_win=x"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div class="search-overlay"></div>

    <header class="sticky-top advance-open">
        <nav class="navbar navbar-expand-lg navbar-expand-md navbar-light primary-nav">
            <a class="navbar-brand" href="<?php echo site_url('/'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/wm-logo.svg" alt="Logo" width="250" height="29"></a>
            
            <div class="mob-navbar-header">
				<?php if(!is_search()): ?>
				<a href="Javascript:;" class="search-head">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/Searchicon.svg" alt="Search" class="wm_open_search">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/close-x.png" alt="Close Search" class="wm_close_search">
				</a>
				<?php endif; ?>
				<?php if( is_user_logged_in() ): ?>
					<span class="member_acc_link">
						<a href="<?php echo site_url('/member-account'); ?>" title="<?php esc_attr_e('Goto My Account'); ?>"><i class="fas fa-user-circle fa-lg"></i></a>
					</span>
				<?php endif; ?>
				<button type="button" class="wm_main_nav_toggle"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
			</div>
            
            <div class="main_nav navbar-collapse" >
				<div class="main_nav_header">
					<a class="navbar-brand" href="<?php echo site_url('/'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/logo.svg" alt="Logo"></a>
					<div class="mob-navbar-header">
						<?php if(!is_search()): ?>
						<a href="Javascript:;" class="search-head">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/Searchicon.svg" alt="Search" class="wm_open_search">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/close-x.png" alt="Close Search" class="wm_close_search">
						</a>
						<?php endif; ?>
						<?php if( is_user_logged_in() ): ?>
							<span class="member_acc_link">
								<a href="<?php echo site_url('/member-account'); ?>" title="<?php esc_attr_e('Goto My Account'); ?>"><i class="fas fa-user-circle fa-lg"></i></a>
							</span>
						<?php endif; ?>
						<button type="button" class="wm_main_nav_toggle"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
					</div>
				</div>
				<?php echo '<div class="wm_nav_secondary_links_xs">'; get_template_part('navbar-search'); echo '</div>';  ?>
                <?php
                   wp_nav_menu( array(
                     'theme_location' => 'primary',
                     'container'      => false,
                     'menu_class'     => 'nav navbar-nav mr-auto',
                     'fallback_cb'    => '__return_false',
                     'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                     'depth'          => 3,
                     'walker'         => new bootstrap_4_walker_nav_menu()
                  ) );
                ?>
				<?php  get_template_part('navbar-search');  ?>
				<div class="main_nav_footer">
					<?php get_template_part('template-parts/common', 'footer'); ?>
				</div>
            </div>
        </nav>
        
		<?php if(!is_search()){ get_template_part('navbar-search-box'); } ?>
    </header>