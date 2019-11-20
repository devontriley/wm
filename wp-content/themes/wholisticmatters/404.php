<?php

 get_header(); ?>

<div class="container">
    <div class="row py-5">
        <!--
        <div class="col-md-12">
            <h1 class="text-center ptitle_404"><?php _e('404 Error'); ?></h1>
            <h4 class="text-center psubtitle_404"><?php _e('Oops! Looks like something went wrong.'); ?></h4>                    
            <p class="text-center para_404"><?php _e('Let\'s get you back on track'); ?></p>
            <div class="text-center"><a href="<?php echo get_option('home'); ?>" class="btn btn-theme-fix btn-green"><?php _e('Head Back'); ?></a></div>
        </div>
        -->

        <div class="col-md-6">

            <p style="color: #8D8D8D; letter-spacing: 1px; font-weight: 700; font-family: 'Aktiv';">404 ERROR CODE</p>

            <h1 style="font-family: 'Harriet'; color: #1A4D2C; font-weight: 900;">Looks like we found a few holes.</h1>

            <p class="copy">Let’s get you back on track. Here are some useful links:</p>

            <p class="copy">
                <a href="<?php bloginfo('url'); ?>/interactive-tools/">Interactive Tools</a><br />
                Our freely accessible interactive tools allow anyone to further their wholistic nutrition education in a memorable, easy-to-use way
            </p>

            <p class="copy">
                <a href="<?php bloginfo('url'); ?>">Media Base</a><br />
                Looking for something specific? Our media base is fully stocked with podcasts, PDFs, videos, and articles that are ready for download and usage anywhere, with anyone.
            </p>

            <p class="copy">
                <a href="<?php bloginfo('url'); ?>/spotlight-topics/">Spotlight & Key Topics</a><br />
                We bring all of clinical nutrition’s trending topics to you, right front and center. Spotlight topics allow you to quickly find what you need to share with your colleagues and patients.
            </p>

            <p class="copy">
                <a href="<?php bloginfo('url'); ?>/series/be-the-you-that-nature-intended/">Wholistic Matters Podcast Series</a><br />
                Our podcast brings what’s current in wholistic health matters straight to you. Join us as we go in-depth on all things wholistic health, with insights from industry leaders across functional medicine, integrative medicine, clinical nutrition, chiropractic, and more.
            </p>

            <p class="copy">
                <a href="<?php bloginfo('url'); ?>/continuing-education/">Continuing Education Opportunities</a><br />
                Our online continuing education opportunities allow you to keep your education on track and earn NYCC-approved credits. Our courses in functional nutrition, neuroinflammation, and herbal medicine are approved by the New York Chiropractic College for Chiropractors, Naturopathic Physicians, Acupuncture, and the American Clinical Board of Nutrition (Foundations of Herbal Medicine courses pending).
            </p>

<!--            <p class="copy">-->
<!--                <a href="">Subscribe to Insights</a><br />-->
<!--                Receive clinically driven nutrition insights you can trust.-->
<!--            </p>-->

        </div>

        <div class="col-md-6 image">

            <img src="<?php bloginfo('template_directory'); ?>/images/404/404_apple.svg" />

        </div>
    </div>    
</div>

<?php get_footer(); ?>