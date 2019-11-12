<?php //include(__DIR__ . '/../template-parts/newsletter-signup.php'); ?>

<div class="newsletter-signup-block">
    <div class="container my-3 my-sm-5">
        <div class="row align-items-center">
            <div class="col p-4 p-sm-5 order-lg-2 content">
                <p class="h1">Subscribe to insights.</p>
                <p>Receive clinically driven nutrition insights you can trust.</p>
                <form class="newsletter-signup-form">
                    <div class="fields">
                        <input type="text" name="fname" placeholder="First Name" class="half" required />
                        <input type="text" name="lname" placeholder="Last Name" class="half" required />
                        <input type="email" name="email" placeholder="Enter your email address" required />
                        <input type="submit" value="Subscribe to Newsletter" class="btn btn-theme" />
                    </div>
                    <div class="message"></div>
                </form>
            </div>
            <div class="col-auto pl-4 pl-sm-5 text-center image">
                <img src="<?php bloginfo('template_directory'); ?>/images/newsletter/WM-EncasedPullaway.svg" alt="WM" />
            </div>
        </div>
    </div>
</div>