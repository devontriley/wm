<?php 
/*Template Name: Account / Dashboard*/
get_header(); ?>

<div class="boxed">
        <!---Boxed-->
        <div class="sm-wrapp">
            <div class="bokmark-box">
                <h2 class="section_heading">Bookmarks</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat.</p>
                <a href="#." class="btn btn-theme-fix">+ Create New Folder</a>
            </div>
            <div class="search-filter">
                <fieldset class="form-group">
                    <label for="exampleInputEmail5" class="bmd-label-floating">Search Folders</label>
                    <input type="text" class="form-control" id="exampleInputEmail5" name="email_login">
                </fieldset>
                <i class="search-ico"><img src="<?php bloginfo('template_url'); ?>/images/search-ico.svg" alt="search-ico"></i>
            </div>
            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne"
                        aria-expanded="true" aria-controls="collapseOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link">
                                Quick Save <span>(15)</span>
                            </button>
                        </h5>
                        <ul>
                            <li><a href="#."><img src="<?php bloginfo('template_url'); ?>/images/edit.svg" alt="trash"></a></li>
                            <li><a href="#."><img src="<?php bloginfo('template_url'); ?>/images/trash.svg" alt="trash"></a></a></li>
                        </ul>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <div class="box-feature simple">
                                <div class="image-side">
                                    <img src="<?php bloginfo('template_url'); ?>/images/feature-1.png" alt="feature-1">
                                </div>
                                <div class="feature-data">
                                    <h2><a href="#.">Wholistic Health: The Advantage of Whole Food Nutrition</a></h2>
                                    <p>John Troup, PhD, talks about the whole food advantage and the power of whole
                                        foods in
                                        providing nutrition. What is functional nutrition…</p>
                                    <span class="datetime">Article • Feb 2, 2019 • 8 min read</span>
                                    <img src="<?php bloginfo('template_url'); ?>/images/Bookmark.svg" alt="Bookmark">
                                </div>
                            </div>
                            <div class="box-feature video">
                                <div class="image-side">
                                    <img src="<?php bloginfo('template_url'); ?>/images/feature-2.png" alt="feature-1">
                                    <a href="#." class="icon-feature"><i class="icon-wrapp"><img src="<?php bloginfo('template_url'); ?>/images/play-icon.svg"
                                                alt="Play"></i></a>
                                </div>
                                <div class="feature-data">
                                    <h2><a href="#.">The Role of Herbs in Detoxification</a></h2>
                                    <p>Naturopathic doctor Marisa Marciano discusses evidence-based herbal medicine in
                                        the
                                        context of detoxification. Why herbs?</p>
                                    <span class="datetime">Video • Feb 7, 2019 • 49 min watch</span>
                                    <img src="<?php bloginfo('template_url'); ?>/images/Bookmark.svg" alt="Bookmark">
                                </div>
                            </div>
                            <div class="box-feature document">
                                <div class="image-side">
                                    <img src="<?php bloginfo('template_url'); ?>/images/feature-3.png" alt="feature-1">
                                    <a href="#." class="icon-feature"><i class="icon-wrapp"><img src="<?php bloginfo('template_url'); ?>/images/document-down.svg"
                                                alt="Play"></i></a>
                                </div>
                                <div class="feature-data">
                                    <h2><a href="#.">Nutrients Infographic</a></h2>
                                    <p>Naturopathic doctor Marisa Marciano discusses evidence-based herbal medicine in
                                        the
                                        context of detoxification. Why herbs?</p>
                                    <span class="datetime">Video • Feb 7, 2019 • 49 min watch</span>
                                    <img src="<?php bloginfo('template_url'); ?>/images/Bookmark.svg" alt="Bookmark">
                                </div>
                            </div>
                            <div class="box-feature audio">
                                <div class="image-side">
                                    <img src="<?php bloginfo('template_url'); ?>/images/feature-4.png" alt="feature-1">
                                    <a href="#." class="icon-feature"><i class="icon-wrapp"><img src="<?php bloginfo('template_url'); ?>/images/audio.svg"
                                                alt="Play"></i></a>
                                </div>
                                <div class="feature-data">
                                    <h2><a href="#.">Nutrients Infographic</a></h2>
                                    <p>Naturopathic doctor Marisa Marciano discusses evidence-based herbal medicine in
                                        the
                                        context of detoxification. Why herbs?</p>
                                    <span class="datetime">Video • Feb 7, 2019 • 49 min watch</span>
                                    <img src="<?php bloginfo('template_url'); ?>/images/Bookmark.svg" alt="Bookmark">
                                </div>
                            </div>
                            <div class="box-feature simple">
                                <div class="image-side">
                                    <img src="<?php bloginfo('template_url'); ?>/images/feature-5.png" alt="feature-1">
                                </div>
                                <div class="feature-data">
                                    <h2><a href="#.">Wholistic Health: The Advantage of Whole Food Nutrition. This
                                            Title is
                                            extended to show a a three level title would look like</a></h2>
                                    <p>John Troup, PhD, talks about the whole food advantage and the power…</p>
                                    <span class="datetime">Article • Feb 2, 2019 • 8 min read</span>
                                    <img src="<?php bloginfo('template_url'); ?>/images/Bookmark.svg" alt="Bookmark">
                                    <span class="badge">PREMIUM</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header collapsed" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="false" aria-controls="collapseTwo">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed">
                                New Dietary Articles <span>(11)</span>
                            </button>
                        </h5>
                        <ul>
                            <li><a href="#."><img src="<?php bloginfo('template_url'); ?>/images/edit.svg" alt="trash"></a></li>
                            <li><a href="#."><img src="<?php bloginfo('template_url'); ?>/images/trash.svg" alt="trash"></a></a></li>
                        </ul>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                            <div class="box-feature simple">
                                <div class="image-side">
                                    <img src="<?php bloginfo('template_url'); ?>/images/feature-1.png" alt="feature-1">
                                </div>
                                <div class="feature-data">
                                    <h2><a href="#.">Wholistic Health: The Advantage of Whole Food Nutrition</a></h2>
                                    <p>John Troup, PhD, talks about the whole food advantage and the power of whole
                                        foods in
                                        providing nutrition. What is functional nutrition…</p>
                                    <span class="datetime">Article • Feb 2, 2019 • 8 min read</span>
                                    <img src="<?php bloginfo('template_url'); ?>/images/Bookmark.svg" alt="Bookmark">
                                </div>
                            </div>
                            <div class="box-feature video">
                                <div class="image-side">
                                    <img src="<?php bloginfo('template_url'); ?>/images/feature-2.png" alt="feature-1">
                                    <a href="#." class="icon-feature"><i class="icon-wrapp"><img src="<?php bloginfo('template_url'); ?>/images/play-icon.svg"
                                                alt="Play"></i></a>
                                </div>
                                <div class="feature-data">
                                    <h2><a href="#.">The Role of Herbs in Detoxification</a></h2>
                                    <p>Naturopathic doctor Marisa Marciano discusses evidence-based herbal medicine in
                                        the
                                        context of detoxification. Why herbs?</p>
                                    <span class="datetime">Video • Feb 7, 2019 • 49 min watch</span>
                                    <img src="<?php bloginfo('template_url'); ?>/images/Bookmark.svg" alt="Bookmark">
                                </div>
                            </div>
                            <div class="box-feature document">
                                <div class="image-side">
                                    <img src="<?php bloginfo('template_url'); ?>/images/feature-3.png" alt="feature-1">
                                    <a href="#." class="icon-feature"><i class="icon-wrapp"><img src="<?php bloginfo('template_url'); ?>/images/document-down.svg"
                                                alt="Play"></i></a>
                                </div>
                                <div class="feature-data">
                                    <h2><a href="#.">Nutrients Infographic</a></h2>
                                    <p>Naturopathic doctor Marisa Marciano discusses evidence-based herbal medicine in
                                        the
                                        context of detoxification. Why herbs?</p>
                                    <span class="datetime">Video • Feb 7, 2019 • 49 min watch</span>
                                    <img src="<?php bloginfo('template_url'); ?>/images/Bookmark.svg" alt="Bookmark">
                                </div>
                            </div>
                            <div class="box-feature audio">
                                <div class="image-side">
                                    <img src="<?php bloginfo('template_url'); ?>/images/feature-4.png" alt="feature-1">
                                    <a href="#." class="icon-feature"><i class="icon-wrapp"><img src="<?php bloginfo('template_url'); ?>/images/audio.svg"
                                                alt="Play"></i></a>
                                </div>
                                <div class="feature-data">
                                    <h2><a href="#.">Nutrients Infographic</a></h2>
                                    <p>Naturopathic doctor Marisa Marciano discusses evidence-based herbal medicine in
                                        the
                                        context of detoxification. Why herbs?</p>
                                    <span class="datetime">Video • Feb 7, 2019 • 49 min watch</span>
                                    <img src="<?php bloginfo('template_url'); ?>/images/Bookmark.svg" alt="Bookmark">
                                </div>
                            </div>
                            <div class="box-feature simple">
                                <div class="image-side">
                                    <img src="<?php bloginfo('template_url'); ?>/images/feature-5.png" alt="feature-1">
                                </div>
                                <div class="feature-data">
                                    <h2><a href="#.">Wholistic Health: The Advantage of Whole Food Nutrition. This
                                            Title is
                                            extended to show a a three level title would look like</a></h2>
                                    <p>John Troup, PhD, talks about the whole food advantage and the power…</p>
                                    <span class="datetime">Article • Feb 2, 2019 • 8 min read</span>
                                    <img src="<?php bloginfo('template_url'); ?>/images/Bookmark.svg" alt="Bookmark">
                                    <span class="badge">PREMIUM</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header collapsed" id="headingThree" data-toggle="collapse" data-target="#collapseThree"
                        aria-expanded="false" aria-controls="collapseThree">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed">
                                Folder Name <span>(26)</span>
                            </button>
                        </h5>
                        <ul>
                            <li><a href="#."><img src="<?php bloginfo('template_url'); ?>/images/edit.svg" alt="trash"></a></li>
                            <li><a href="#."><img src="<?php bloginfo('template_url'); ?>/images/trash.svg" alt="trash"></a></a></li>
                        </ul>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body">
                            <div class="box-feature simple">
                                <div class="image-side">
                                    <img src="<?php bloginfo('template_url'); ?>/images/feature-1.png" alt="feature-1">
                                </div>
                                <div class="feature-data">
                                    <h2><a href="#.">Wholistic Health: The Advantage of Whole Food Nutrition</a></h2>
                                    <p>John Troup, PhD, talks about the whole food advantage and the power of whole
                                        foods in
                                        providing nutrition. What is functional nutrition…</p>
                                    <span class="datetime">Article • Feb 2, 2019 • 8 min read</span>
                                    <img src="<?php bloginfo('template_url'); ?>/images/Bookmark.svg" alt="Bookmark">
                                </div>
                            </div>
                            <div class="box-feature video">
                                <div class="image-side">
                                    <img src="<?php bloginfo('template_url'); ?>/images/feature-2.png" alt="feature-1">
                                    <a href="#." class="icon-feature"><i class="icon-wrapp"><img src="<?php bloginfo('template_url'); ?>/images/play-icon.svg"
                                                alt="Play"></i></a>
                                </div>
                                <div class="feature-data">
                                    <h2><a href="#.">The Role of Herbs in Detoxification</a></h2>
                                    <p>Naturopathic doctor Marisa Marciano discusses evidence-based herbal medicine in
                                        the
                                        context of detoxification. Why herbs?</p>
                                    <span class="datetime">Video • Feb 7, 2019 • 49 min watch</span>
                                    <img src="<?php bloginfo('template_url'); ?>/images/Bookmark.svg" alt="Bookmark">
                                </div>
                            </div>
                            <div class="box-feature document">
                                <div class="image-side">
                                    <img src="<?php bloginfo('template_url'); ?>/images/feature-3.png" alt="feature-1">
                                    <a href="#." class="icon-feature"><i class="icon-wrapp"><img src="<?php bloginfo('template_url'); ?>/images/document-down.svg"
                                                alt="Play"></i></a>
                                </div>
                                <div class="feature-data">
                                    <h2><a href="#.">Nutrients Infographic</a></h2>
                                    <p>Naturopathic doctor Marisa Marciano discusses evidence-based herbal medicine in
                                        the
                                        context of detoxification. Why herbs?</p>
                                    <span class="datetime">Video • Feb 7, 2019 • 49 min watch</span>
                                    <img src="<?php bloginfo('template_url'); ?>/images/Bookmark.svg" alt="Bookmark">
                                </div>
                            </div>
                            <div class="box-feature audio">
                                <div class="image-side">
                                    <img src="<?php bloginfo('template_url'); ?>/images/feature-4.png" alt="feature-1">
                                    <a href="#." class="icon-feature"><i class="icon-wrapp"><img src="<?php bloginfo('template_url'); ?>/images/audio.svg"
                                                alt="Play"></i></a>
                                </div>
                                <div class="feature-data">
                                    <h2><a href="#.">Nutrients Infographic</a></h2>
                                    <p>Naturopathic doctor Marisa Marciano discusses evidence-based herbal medicine in
                                        the
                                        context of detoxification. Why herbs?</p>
                                    <span class="datetime">Video • Feb 7, 2019 • 49 min watch</span>
                                    <img src="<?php bloginfo('template_url'); ?>/images/Bookmark.svg" alt="Bookmark">
                                </div>
                            </div>
                            <div class="box-feature simple">
                                <div class="image-side">
                                    <img src="<?php bloginfo('template_url'); ?>/images/feature-5.png" alt="feature-1">
                                </div>
                                <div class="feature-data">
                                    <h2><a href="#.">Wholistic Health: The Advantage of Whole Food Nutrition. This
                                            Title is
                                            extended to show a a three level title would look like</a></h2>
                                    <p>John Troup, PhD, talks about the whole food advantage and the power…</p>
                                    <span class="datetime">Article • Feb 2, 2019 • 8 min read</span>
                                    <img src="<?php bloginfo('template_url'); ?>/images/Bookmark.svg" alt="Bookmark">
                                    <span class="badge">PREMIUM</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header collapsed" id="headingFour" data-toggle="collapse" data-target="#collapseFour"
                        aria-expanded="false" aria-controls="collapseFour">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed">
                                Folder Name <span>(2)</span>
                            </button>
                        </h5>
                        <ul>
                            <li><a href="#."><img src="<?php bloginfo('template_url'); ?>/images/edit.svg" alt="trash"></a></li>
                            <li><a href="#."><img src="<?php bloginfo('template_url'); ?>/images/trash.svg" alt="trash"></a></a></li>
                        </ul>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                        <div class="card-body">
                            <div class="box-feature simple">
                                <div class="image-side">
                                    <img src="<?php bloginfo('template_url'); ?>/images/feature-1.png" alt="feature-1">
                                </div>
                                <div class="feature-data">
                                    <h2><a href="#.">Wholistic Health: The Advantage of Whole Food Nutrition</a></h2>
                                    <p>John Troup, PhD, talks about the whole food advantage and the power of whole
                                        foods in
                                        providing nutrition. What is functional nutrition…</p>
                                    <span class="datetime">Article • Feb 2, 2019 • 8 min read</span>
                                    <img src="<?php bloginfo('template_url'); ?>/images/Bookmark.svg" alt="Bookmark">
                                </div>
                            </div>
                            <div class="box-feature video">
                                <div class="image-side">
                                    <img src="<?php bloginfo('template_url'); ?>/images/feature-2.png" alt="feature-1">
                                    <a href="#." class="icon-feature"><i class="icon-wrapp"><img src="<?php bloginfo('template_url'); ?>/images/play-icon.svg"
                                                alt="Play"></i></a>
                                </div>
                                <div class="feature-data">
                                    <h2><a href="#.">The Role of Herbs in Detoxification</a></h2>
                                    <p>Naturopathic doctor Marisa Marciano discusses evidence-based herbal medicine in
                                        the
                                        context of detoxification. Why herbs?</p>
                                    <span class="datetime">Video • Feb 7, 2019 • 49 min watch</span>
                                    <img src="<?php bloginfo('template_url'); ?>/images/Bookmark.svg" alt="Bookmark">
                                </div>
                            </div>
                            <div class="box-feature document">
                                <div class="image-side">
                                    <img src="<?php bloginfo('template_url'); ?>/images/feature-3.png" alt="feature-1">
                                    <a href="#." class="icon-feature"><i class="icon-wrapp"><img src="<?php bloginfo('template_url'); ?>/images/document-down.svg"
                                                alt="Play"></i></a>
                                </div>
                                <div class="feature-data">
                                    <h2><a href="#.">Nutrients Infographic</a></h2>
                                    <p>Naturopathic doctor Marisa Marciano discusses evidence-based herbal medicine in
                                        the
                                        context of detoxification. Why herbs?</p>
                                    <span class="datetime">Video • Feb 7, 2019 • 49 min watch</span>
                                    <img src="<?php bloginfo('template_url'); ?>/images/Bookmark.svg" alt="Bookmark">
                                </div>
                            </div>
                            <div class="box-feature audio">
                                <div class="image-side">
                                    <img src="<?php bloginfo('template_url'); ?>/images/feature-4.png" alt="feature-1">
                                    <a href="#." class="icon-feature"><i class="icon-wrapp"><img src="<?php bloginfo('template_url'); ?>/images/audio.svg"
                                                alt="Play"></i></a>
                                </div>
                                <div class="feature-data">
                                    <h2><a href="#.">Nutrients Infographic</a></h2>
                                    <p>Naturopathic doctor Marisa Marciano discusses evidence-based herbal medicine in
                                        the
                                        context of detoxification. Why herbs?</p>
                                    <span class="datetime">Video • Feb 7, 2019 • 49 min watch</span>
                                    <img src="<?php bloginfo('template_url'); ?>/images/Bookmark.svg" alt="Bookmark">
                                </div>
                            </div>
                            <div class="box-feature simple">
                                <div class="image-side">
                                    <img src="<?php bloginfo('template_url'); ?>/images/feature-5.png" alt="feature-1">
                                </div>
                                <div class="feature-data">
                                    <h2><a href="#.">Wholistic Health: The Advantage of Whole Food Nutrition. This
                                            Title is
                                            extended to show a a three level title would look like</a></h2>
                                    <p>John Troup, PhD, talks about the whole food advantage and the power…</p>
                                    <span class="datetime">Article • Feb 2, 2019 • 8 min read</span>
                                    <img src="<?php bloginfo('template_url'); ?>/images/Bookmark.svg" alt="Bookmark">
                                    <span class="badge">PREMIUM</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h2 class="section_heading">Account</h2>

            <form class="account-login" id="form-login-account">
                <div class="form-group">
                    <label class="label-border">Email <a href="#."><img src="<?php bloginfo('template_url'); ?>/images/edit.svg" alt="edit"></a></label>
                    <input type="email" name="email_login" class="form-control" placeholder="Email Address">
                </div>
                <div class="form-group">
                    <label class="label-border">Password <a href="#."><img src="<?php bloginfo('template_url'); ?>/images/edit.svg" alt="edit"></a></label>
                    <input type="password" name="password_login" class="form-control" placeholder="Password">
                </div>
                <div class="form-group">
                    <label class="label-border">Newsletter</label>
                    <div class="checkbox-btn margin-10">
                        <input id="checkbox1" type="checkbox" name="checkbox" value="1"><label for="checkbox1">Receive
                            the latest WholisticMatters News</label>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-theme-fix" value="Save Changes">
                </div>
            </form>
        </div>
    </div>
	
<?php get_footer(); ?>