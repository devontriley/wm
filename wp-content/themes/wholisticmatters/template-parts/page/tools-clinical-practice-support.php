<?php
/**
 * Template part for displaying interactive tools content
 *
 */

?>
<div class="container">
	<div class="row">
		<div class="col-md-12 tool-content">
			<?php the_content(); ?>
		</div>
	</div>
	<div class="inner-wrapp">

		<div class="left-tabs">
			<ul>
				<li>
					<a href="#Introduction">Introduction</a>
				</li>
				<li class="drop">
					<a href="#Reading" class="angle">Reading Material <i class="fas fa-angle-down"></i></a>
					<ul>
						<li><a href="#Sharing">Sharing Content with your patients</a></li>
						<li><a href="#Check">Check out some of our top content</a></li>
						<li><a href="#Herbal">Herbal Medicinals</a></li>
					</ul>
				</li>
                <li class="drop">
                    <a href="#Download" class="angle">Downloadable Resources <i class="fas fa-angle-down"></i></a>
                    <ul>
                        <li><a href="#Color">Color of Food</a></li>
                        <li><a href="#Other">Other Downloads for Your Practice</a></li>
                    </ul>
                </li>
				<li class="drop">
					<a href="#." class="angle">Utilizing Interactive Tools <i class="fas fa-angle-down"></i></a>
					<ul>
						<li><a href="#Drug">Drug-Nutrient Interaction Tool</a></li>
						<li><a href="#Vitamin">Vitamin Advisor</a></li>
						<li><a href="#Practical">Sharing Content with your patients</a></li>
					</ul>
				</li>
				<li>
					<a href="#Podcasts">Podcasts</a>
				</li>
				<li>
					<a href="#Practice">Practice Management</a>
				</li>
			</ul>
		</div>

		<div class="right-data">

			<h3 id="Introduction">Introduction</h3>

			<p>Looking for ways to integrate nutrition education in your office? At Wholistic Matters, we want to
				provide you all the tools you require to deliver important resources on whole food nutrition
				and how it plays an important role in optimizing an individual's personal health status. Here is
				an overview of the tools we have on the website that you can use in your office, social media,
				newsletters, and other methods of education. Plus, check out our practice management video series.</p>

			<h4>USER TIPS</h4>

			<ul>
				<li>If you are interested in utilizing specific tools in your office, use the floating menu on the left
                    to navigate through the page.</li>
				<li>Each tutorial contains written and video step-by-step directions.</li>
			</ul>

			<hr>

            <!-- READING MATERIALS -->

			<h3 id="Reading">Reading Material</h3>

			<p>From Ashwagandha to St. John's Wort, our collection of articles and blog series covers a wide
				variety of topics on whole food nutrition, herbal remedies, and lifestyle health and wellness.
				You have a few options for sharing this information with your patients.</p>

			<h4 id="Sharing">Sharing Content with your patients</h4>

			<ul>
				<li>Copy and paste the webpage link into your social media account to quickly and easily share
					an article with your followers.</li>
			</ul>

			<h4>Via Facebook</h4>

			<ul>
				<li>Click on the video you want to share. Under the video, click the
					"share" button. Then, click "copy".</li>
				<li>On Facebook, paste (CTRL/CMD+ V or right click + paste) the link into the "Write a
					Post" box. Write some text next to link if you want, or click "Share Now".</li>
			</ul>

			<h4>Via Twitter</h4>

			<ul>
				<li>Follow the same steps from above to copy the Youtube link.</li>
				<li>Paste into the "Whats Happening?" box. You"ll have about 280 characters to add a message. Add a
					#hashtag if you feel like it!</li>
				<li>Click "Tweet".</li>
				<li>Copy and paste and webpage link into your regular email newsletter.</li>
				<li>Print the article to provide a physical copy to your patients. This is a great opportunity to
					provide helpful information for patients in your practice who are waiting to seen.</li>
			</ul>

			<div class="video-frame">
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/WAprwXr6zvs"
                        frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen=""></iframe>
			</div>

			<?php
            //Key Topics Slider
            $key_topics = get_terms( 'category', array(
                'orderby'    => 'name',
                'hide_empty' => 0,
                'number' => 10,
				
            ) );
            if ( ! empty( $key_topics ) && ! is_wp_error( $key_topics ) ):  ?>

			<h4 id="Check">Check out some of our top content</h4>

			<ul>
				<?php  
				foreach ( $key_topics as $key_topic ): 
					if ( $key_topic->term_id == 1 )
						continue; // skip 'uncategorized'
					?>
					<li><a href="<?php echo get_term_link($key_topic, 'category')?>"><?php echo __('Search').' '.$key_topic->name; ?></a></li>
				 <?php endforeach; ?>
			</ul>
            <?php endif; ?>

			<h4 id="Herbal">Herbal Medicinals</h4>

			<p>On Wholistic Matters, there is a page completely devoted to
                <a href="<?php echo site_url('/interactive-tools/Herbal-Medicinals'); ?>">herbal medicinals</a>.
                Listed from A to Z for your convenience, each entry contains a plethora of
                information on individual herbs: family name, parts used, constituents, medicinal actions, traditional
                uses, evidence-based uses, mechanism of action and pharmacology, pharmacy, safety and toxicity concerns,
                and interactions. Freshen up on your herbal knowledge with this useful database!</p>

			<a href="<?php echo site_url('/interactive-tools/herbal-medicinals/'); ?>">Go to Herbal Medicinals</a>

            <hr><br />

            <!-- DOWNLOADABLE RESOURCES -->

            <h3 id="Download">Downloadable Resources</h3>

            <h4 id="Color">Color of Food</h4>

            <img src="<?php bloginfo('template_directory'); ?>/images/cps/COF%20Overview.png" />

            <br /><br />

            <p>The Color of Food series is designed to improve understanding of the significance of phytonutrient and nutrient gaps, the GAE connection, the whole food advantage, and the role of specialty crops and the Farm Bill to provide the tools needed to make conscious decisions about our health and the health of the people around us.</p>

            <p>Materials in the Color of Food series include:</p>

            <ul>
                <li>Featured Crops: Nutrient and Phytonutrient Profiles</li>
                <li>Adopting Nutritional Practices</li>
                <li>Color of Food Overview</li>
                <li>
                    <a href="<?php bloginfo('url'); ?>/fruits-and-vegetables/" target="_blank" rel="noreferrer noopener">Fruits and Vegetables</a>
                </li>
                <li>
                    <a href="<?php bloginfo('template_directory'); ?>/images/cps/Adopting%20Nutritional%20Practices.pdf" target="_blank" rel="noreferrer noopener">Adopting Nutritional Practices</a>
                </li>
                <li>
                    <a href="<?php bloginfo('template_directory'); ?>/images/cps/Color%20of%20Food.pdf" target="_blank" rel="noreferrer noopener">Color of Food</a>
                </li>
                <li>
                    <a href="<?php bloginfo('template_directory'); ?>/images/cps/Alfalfa.pdf" target="_blank" rel="noreferrer noopener">Alfalfa</a>
                </li>
                <li>
                    <a href="<?php bloginfo('template_directory'); ?>/images/cps/Barley.pdf" target="_blank" rel="noreferrer noopener">Barley</a>
                </li>
                <li>
                    <a href="<?php bloginfo('template_directory'); ?>/images/cps/Beetroot.pdf" target="_blank" rel="noreferrer noopener">Beetroot</a>
                </li>
                <li>
                    <a href="<?php bloginfo('template_directory'); ?>/images/cps/Buckwheat.pdf" target="_blank" rel="noreferrer noopener">Buckwheat</a>
                </li>
                <li>
                    <a href="<?php bloginfo('template_directory'); ?>/images/cps/Kidney%20Beans.pdf" target="_blank" rel="noreferrer noopener">Kidney Beans</a>
                </li>
                <li>
                    <a href="<?php bloginfo('template_directory'); ?>/images/cps/Oats.pdf" target="_blank" rel="noreferrer noopener">Oats</a>
                </li>
                <li>
                    <a href="<?php bloginfo('template_directory'); ?>/images/cps/Peavine.pdf" target="_blank" rel="noreferrer noopener">Peavine</a>
                </li>
                <li>
                    <a href="<?php bloginfo('template_directory'); ?>/images/cps/Spanish%20Black%20Radish.pdf" target="_blank" rel="noreferrer noopener">Spanish Black Raddish</a>
                </li>
                <li>
                    <a href="<?php bloginfo('template_directory'); ?>/images/cps/Swiss%20Chard.pdf" target="_blank" rel="noreferrer noopener">Swiss Chard</a>
                </li>
                <li>
                    <a href="<?php bloginfo('template_directory'); ?>/images/cps/Turnip%20Greens.pdf" target="_blank" rel="noreferrer noopener">Turnip Greens</a>
                </li>
                <li>
                    <a href="<?php bloginfo('url'); ?>/wp-content/uploads/2019/07/Brussel-Sprouts-DIGITAL.pdf" target="_blank" rel="noreferrer noopener">Brussel Sprouts</a>
                </li>
                <li>
                    <a href="<?php bloginfo('url'); ?>/wp-content/uploads/2019/07/Kale-DIGITAL.pdf" target="_blank" rel="noreferrer noopener">Kale</a>
                </li>
                <li>
                    <a href="<?php bloginfo('url'); ?>/color-of-food-top-crops-and-phytoactives/" target="_blank" rel="noreferrer noopener">Top Crops and Phytoactives</a>
                </li>
                <li>
                    <a href="<?php bloginfo('url'); ?>/color-of-food-phytonutrients-health-benefits-and-color/" target="_blank" rel="noreferrer noopener">Phytonutrients, Health Benefits, and Color</a>
                </li>
                <li>
                    <a href="<?php bloginfo('url'); ?>/color-of-food-crops-and-phytoactives/" target="_blank" rel="noreferrer noopener">Crops and Phytoactives</a>
                </li>
            </ul>

            <h4 id="Other">Other Downloads for Your Practice</h4>

            <ul>
                <li>
                    <a href="https://ss-usa.s3.amazonaws.com/c/308468766/media/5bec571fbed83/WM%20Medication%20Chart%20-%20Final.pdf">
                        "Are you taking one of these top 100 medications?"
                    </a>
                    - A useful chart that lists common medications
                    (generic and brand names), a description, and potential nutrient gaps for someone taking that
                    medication.
                </li>
                <li>
                    <a href="https://ss-usa.s3.amazonaws.com/c/308468766/media/5bec5737888bf/WM%20Undernutrition%20and%20Food%20Sources%20-%20FINAL.pdf">
                        "Nutrient Gap Symptoms and How to Address Them"
                    </a>
                    - A helpful graphic listing nutrient deficiencies
                    that could be causing certain symptoms and the whole foods that can be used to address the
                    deficiency.
                </li>

                <li>
                    <a href="https://ss-usa.s3.amazonaws.com/c/308468766/media/5cacf3d6384eb/Cruciferous%20Vegetables%20%281%29%20-%20Final.png">
                        "Novel Extracts in Cruciferous Vegetables"
                    </a>
                    - A simple graphic showing the types of glucosinolates found in foods like kale, broccoli, and
                    cabbage, focusing on glucoraphanin
                </li>

                <li>
                    <a href="https://ss-usa.s3.amazonaws.com/c/308468766/media/5cacf3ff8b5dc/WM%20Mg%20infographic%20-%20Final.pdf">
                        "Are You Getting Enough Magnesium?"
                    </a>
                    - An infographic showing the benefits of whole food magnesium, including effect of dose on optimal
                    absorption, dietary magnesium intake in the United States, and how magnesium can help with stress
                    control and foundational health
                </li>

                <li>
                    <a href="https://ss-usa.s3.amazonaws.com/c/308468766/media/5cacf3bc417e6/SystemsSelling_LeaveBehind_FNL_Digital.pdf">
                        "Preventing and Managing Inflammation Through Nutrition"
                    </a>
                    - A five-page PDF on inflammation, essential fatty acids, supporting the endocannabinoid system,
                    and botanicals for inflammation
                </li>

                <li>
                    <a href="https://ss-usa.s3.amazonaws.com/c/308468766/media/5cacf426d61d7/WM%20Fatty%20Acids%20-Final.png">
                        "Unfolding Fatty Acids"
                    </a>
                    - A graphic showing the polyunsaturated fatty acids - omega 6 and omega 3 - as types of unsaturated
                    fat that can be converted into ALA, EPA, and DHA
                </li>

                <li>
                    <a href="https://ss-usa.s3.amazonaws.com/c/308468766/media/5cacf433e02de/WM%20The%20numbers%20-%20Final.png">
                        "The Numbers: Fatty Acids"
                    </a>
                    - A graphic depicting trends in saturated and unsaturated fat consumption in the United States
                </li>
            </ul>

            <p>Download and share with your patients!</p>

            <hr><br />

            <!-- UTILIZING INTERACTIVE TOOLS -->

			<h3 id="Utilizing">Utilizing Interactive Tools</h3>

			<p>
                Two of our interactive tools, the
                <a href="<?php echo site_url('/Articles/2018/Drug-Supplement-Interaction-Checker'); ?>">
                    Drug-Nutrient Interaction Tool
                </a>
                and the
                <a href="<?php echo site_url('/Articles/2018/vitamin-checker'); ?>">
                    Vitamin Advisor
                </a>
                , provide you and your patients the opportunity to receive personalized, reliable information online.
                The Drug-Nutrient Interaction Tool provides a conclusive report on drug, food, and nutrient interactions
                specific to the person using the tool. The Vitamin Advisor utilizes a brief survey to provide recommendations
                on what nutritional supplements an individual might benefit from taking. Interested in integrating these tools?
            </p>

			<h4 id="Drug">Drug-Nutrient Interaction Tool</h4>

			<p>
                Drugs and nutrients sometimes interact with other drugs and nutrients, whether in the form of food or
                supplement. Those interactions can have positive or negative effects. Interested in identifying the
                interaction profile of your patient's regular drug and nutrient regimen? From caffeine to ibuprofen,
                vitamin A to penicillin, this tool will provide a conclusive interaction report personalized just for
                your patient. The Drug-Nutrient Interaction Tool is easy to use. Search for specific drugs, foods, and
                nutrients in the search bar, and the tool will create a conclusive list.
            </p>

            <p>
                You'll see a list of drug, food, and nutrient interactions (negative, supportive, and needs explanation)
                associated with the items on your list. If there is more than one, the tool will also provide a report
                on any potential interactions between the items in your list. Click on each entry for more information.
            </p>

			<a href="<?php echo site_url('/interactive-tools/drug-nutrient-interaction-tool/'); ?>">Go to Drug-Nutrient Interaction Tool</a>

			<div class="video-frame">
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/a-xTdO2HjG4"
                        frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen=""></iframe>
			</div>

			<h4 id="Vitamin">Vitamin Advisor</h4>

			<p>
                The Vitamin Advisor uses a brief survey (age, gender, health concerns, family history etc.) to provide
                recommendations on what nutritional supplements might be beneficial for the person taking the survey.
            </p>

			<a href="<?php echo site_url('/interactive-tools/vitamin-advisor/'); ?>">Go to Vitamin Advisor</a>

			<div class="video-frame">
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/ZPpH11CVUes"
                        frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen=""></iframe>
			</div>

			<p>Here are few other options for utilizing these tools.</p>

			<ul id="sharing2">
				<li>
                    Copy and paste the webpage link into your social media account to quickly and easily share the tool
                    with your followers.
                </li>
			</ul>

			<h4>Via Facebook</h4>

			<ul>
				<li>Click on the video you want to share. Under the video, click the
					"share" button. Then, click "copy".</li>
				<li>On Facebook, paste (CTRL/CMD+ V or right click + paste) the link into the "Write a
					Post" box. Write some text next to link if you want, or click"Share Now".</li>
			</ul>

			<h4>Via Twitter</h4>

			<ul>
				<li>Follow the same steps from above to copy the Youtube link.</li>
				<li>Paste into the "Whats Happening?" box. You'll have about 280 characters to add a message. Add a
					#hashtag if you feel like it!</li>
				<li>Click "Tweet".</li>
				<li>Copy and paste the webpage like into your your regular email newsletter.</li>
				<li>Discuss the tool's capabilities with your patients and use it with them in your practice.</li>
			</ul>

			<div class="video-frame">
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/RskqxbqXEeM"
                        frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen=""></iframe>
			</div>

            <hr><br />

            <!-- PODCASTS -->

			<h3 id="Podcasts">Podcasts</h3>

			<p>
                The Wholistic Matters Podcast series, hosted by John P. Troup, PhD, is a great resource for you and your
                patients to listen in on discussions with top health care practitioners, scientists, and other members
                of the whole food nutrition community. Our podcasts are usually 20 or 30 minutes long. Perfect for your
                morning commute or working out at the gym.
            </p>

			<a href="<?php echo site_url('/podcast-episodes/'); ?>">View all available Podcasts</a>

			<h4>Sharing and Listening to Podcasts</h4>

			<p>
                The Wholistic Matters Podcast Series focuses on becoming the you the nature intended. Hosted by John P.
                Troup, PhD, this series includes interviews with a variety of health care practitioners and scientists
                on whole food nutrition, essential nutrients, and other healthy living topics. You can access this
                podcast series and share them with your patients in a few different ways.
            </p>

			<ul>
				<li>For any given podcast, copy and paste the webpage link into your social media account or regular
                    email newsletter to quickly and easily share the tool with your followers.
                </li>
			</ul>

			<div class="video-frame">
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/21yPDfTQ6LU"
                        frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen=""></iframe>
			</div>

			<ul>
				<li>
                    Subscribe and listen to the Wholistic Matters Podcast Series on a smart phone mobile app. Depending
                    on whether you have an Android or Apple device, visit the Google Play or App Store to download an
                    application for listening to podcasts. Search for Wholistic Matters, and click "Subscribe."
                </li>
			</ul>

			<div class="video-frame">
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/tjt04-Z83l4"
                        frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen=""></iframe>
			</div>

			<ul>
				<li>
                    Download a podcast straight from the Wholistic Matters website. With this mp3 file, you could play
                    the podcast in your office for your patients directly. To download a podcast, click the green
                    "Download Episode" button, click "Yes" to the "Are you sure you want to leave?" prompt, and select
                    the "download option" by clicking on the vertical three dots.
                </li>
			</ul>

			<div class="video-frame">
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/VWqvjDPuZSM"
                        frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen=""></iframe>
			</div>

            <hr><br />

			<h3>Videos</h3>

			<p>Wholistic Matters has its own YouTube Channel filled with videos on a variety of topics.</p>

			<ul>
				<li>
                    Animation Series: Learn research-based science and wholistic healthcare insights through engaging
                    animated videos.
                </li>
				<li>
                    Lecture Series: Dive deep into nutritional science breakthroughs with industry leaders.
                </li>
				<li>
                    Understanding Organic Farming: Learn about organic and sustainable farming from the pros.
                </li>
			</ul>

			<p>And more!</p>

			<a href="<?php echo site_url('/videos/'); ?>">Watch Videos on WholisticMatters.com</a><br>

			<a href="https://www.youtube.com/channel/UCVgWEYaccsHK9H1ipPTep2Q">Go to the WholisticMatters Youtube Channel</a>

			<h4>Sharing Youtube Videos is very easy.</h4>

			<h4>Via Facebook</h4>

			<ul>
				<li>Go to the
                    <a href="https://www.youtube.com/channel/UCVgWEYaccsHK9H1ipPTep2Q">Wholistic Matters Youtube Channel</a>
                    . Click on the video you want to share. Under the video, click the
					"share" button. Then, click "copy".
                </li>
				<li>
                    On Facebook, paste (CTRL/CMD+ V or right click + paste) the link into the "Write a
					Post" box. Write some text next to link if you want, or click "Share Now".
                </li>
			</ul>

			<h4>Via Twitter</h4>

			<ul>
				<li>Follow the same steps from above to copy the Youtube link.</li>
				<li>Paste into the "Whats Happening?" box. You'll have about 280 characters to add a message. Add a
					#hashtag if you feel like it!</li>
				<li>Click "Tweet".</li>
			</ul>

			<h4>Embed Videos onto your website and email newsletter.</h4>

			<ul>
				<li>On YouTube, click on the video you want to share. Under the video, click the "share" button.</li>
				<li>Click "Embed" and copy the text.</li>
				<li>
                    With this embed text copied, you can integrate this video onto your website or email newsletter by
                    pasting the text where appropriate. Website and email newsletter platforms differ on how to complete
                    this task, so see your website or email newsletter provider for more help with embedding.
                </li>
			</ul>

			<div class="video-frame">
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/u8s3PJOciBI"
                        frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen=""></iframe>
			</div>

            <hr><br />

			<h3 id="Practice">Practice Management</h3>

			<p>
                Featuring Dr. Ken Krimpelbein, DC, check out our Practice Management video series with discussions of
                practice trends designed specifically for healthcare professionals, beginning with the first episode:
            </p>

			<p>
                <b>23 Practice Metrics of Highly Successful Natural Healthcare Professionals with Dr. Ken Krimpelbein</b>
            </p>

			<div class="video-frame">
                <iframe src="https://player.vimeo.com/video/298384423" width="640" height="342"
                        frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>
			</div>

			<h4>Understanding Financial Statements</h4>

			<hr>

			<div class="video-frame">
                <iframe src="https://player.vimeo.com/video/314341505" width="640" height="342"
                        frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>
			</div>

			<h4>Creating a Baseline for Practice Management in a Chiropractic Office</h4>

			<hr>

			<div class="video-frame">
                <iframe src="https://player.vimeo.com/video/314341743" width="640" height="342"
                        frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>
			</div>

			<h4>Setting up a Dispensary in Your office</h4>

			<hr>

			<div class="video-frame">
                <iframe src="https://player.vimeo.com/video/314341881" width="640" height="361"
                        frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>
			</div>
		</div>
	</div>
</div>