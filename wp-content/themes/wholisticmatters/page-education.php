<?php 
/*Template Name: Continuing Education Page */	

get_header(); ?>
<div class="edu-data">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<!-- hero -->
		<div class="module hero">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/Desktop-Hero-Shape.svg" class="desktop-shape-1">
			<div class="inner">
				<div class="desktop-graphic">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/Laptop-Desktop.png">
				</div>

				<div class="text-wrapper">
					<p class="header">
						Do you need credit hours?
					</p>

					<p class="subheader">
						Explore Our Complimentary Continuing Education Opportunities
					</p>

					<div class="mobile-graphic">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/Laptop-Desktop.png">
					</div>

					<div class="copy-container">
						<p class="copy">
							Keep your education growing and earn NYCC-approved credit hours from online courses
							sponsored by WholisticMatters.com, powered by Standard Process Inc.
						</p>
						<p class="copy">
							Click the link below to create an account. Once registered, you will need to Search,
							Request, Register, then Launch, and you’ll be on your way to continuing
							your education.
						</p>
					</div>
					<!-- .copy-container -->

					<div class="btn cta">
						<a href="https://spuniversity.csod.com/selfreg/register.aspx?p=spuniversity&amp;c=newaccount" target="_blank" class="">Get Started</a>
					</div>
				</div>
				<!-- .text-wrapper -->
			</div>
			<!-- .inner -->
		</div>
		<!-- .hero -->

        <!-- post block module -->
        <div class="module post-block">
            <div class="inner">
                <p class="header">
                    Current Courses
                </p>

                <p class="subheader">
                    — Functional Nutrition —
                </p>

                <div class="post-block-wrapper">
                    <div class="post-tile">
                        <p class="tile-title">
                            Fundamentals of Functional Nutrition - Macronutrients
                        </p>
                        <p class="tile-copy">
                            This module includes an introduction to nutrigenomics, epigenetics, and a detailed
                            review of macronutrients.
                        </p>
                    </div>

                    <div class="post-tile">
                        <p class="tile-title">
                            Fundamentals of Functional Nutrition - Vitamins and Minerals
                        </p>
                        <p class="tile-copy">
                            This module provides an introduction to minerals, vitamins, and phytonutrients.
                        </p>
                    </div>

                    <div class="post-tile">
                        <p class="tile-title">
                            Phytonutrients &amp; the Functional Nutrition Operating System (FNOS)
                        </p>
                        <p class="tile-copy">
                            This module discusses implementing the fundamentals of functional nutrition in
                            a systematic manner within a health care environment.
                        </p>
                    </div>

                    <div class="post-tile">
                        <p class="tile-title">
                            Energy - Mitochondria Metabolism
                        </p>
                        <p class="tile-copy">
                            This course provides insight in the Mitochondria Metabolism. You will learn how
                            nutrition plays a vital role in the multidisciplinary management of mitochondrial
                            and metabolic diseases. Insight into the pathophysiology and biochemistry
                            of mitochondria dysfunction occurs is discussed. You will gain insight
                            into how Functional nutritional therapy addresses various mitochondrial
                            imbalances and how an evidence-based approach to altering macronutrient
                            percentage and meal timing can facilitate metabolic flexibility and enhance
                            mitochondrial biogenesis.
                        </p>
                    </div>

                    <div class="post-tile">
                        <p class="tile-title">
                            Defend and Repair - Immune Health - Inflammation
                        </p>
                        <p class="tile-copy">
                            This modules includes a review of the Immune System, highlights the various immune
                            triggers of a pro-inflammatory state, concepts of Intestinal Hyperpermeability
                            and targets for Immunomodulatory Activity, as well as a discussion on
                            Functional Nutrition strategies for Immune Support.
                        </p>
                    </div>

                    <div class="post-tile">
                        <p class="tile-title">
                            Biotransformation - Detoxification &amp; Elimination
                        </p>
                        <p class="tile-copy">
                            This course reviews the concepts of Detoxification, Phase 1 Biotransformation,
                            Phase II Conjugation and Elimination. Topics include the various environmental
                            and dietary exposures that negatively effect human health, the specific
                            targets of phytonutrients that are essential to detoxification processes,
                            and the fundamentals of a detox food plan. Learners will explore the
                            role of functional nutrition plays in daily detoxification
                        </p>
                    </div>

                    <div class="post-tile">
                        <p class="tile-title">
                            Gastrointestinal Function - Digestion Assimilation Absorption
                        </p>
                        <p class="tile-copy">
                            In this module you will review the various imbalances of the gastrointestinal system
                            as well as the pathophysiology associated with the most common GI conditions.
                            This module contains a robust discussion of clinical tests used to identify
                            potential GI imbalances. Further insight into Functional Nutrition protocols
                            for GI imbalances and the associated foodplans for GI conditions is presented.
                        </p>
                    </div>

                    <div class="post-tile">
                        <p class="tile-title">
                            Physical Performance and Recovery
                        </p>
                        <p class="tile-copy">
                            This module provides learners with an overview of evidence based nutrition strategies
                            for exercise recovery and review of the fundamentals of sports nutrition
                            to optimize physical and sports performance and recovery. Included in
                            this lesson are topics on nutrition personalization, food timing principals,
                            and functional nutrition protocols to support muscle tissue repair.
                        </p>
                    </div>

                    <div class="post-tile">
                        <p class="tile-title">
                            Communication - HPATG Axis
                        </p>
                        <p class="tile-copy">
                            In this course you will review the physiology of stress, cortisol/DHEA balance
                            as well as look at the production, transport, sensitivity and distribution
                            dynamics of hormones. Steroidogenic pathways and enzymes and the most
                            common hormonal imbalances of women and men are included. Nutrition requirements
                            for proper adrenal function are reviewed. Lastly, a look at how a Functional
                            Nutrition Foodplan supports various endocrine abnormalities is presented.
                        </p>
                    </div>

                    <div class="post-tile">
                        <p class="tile-title">
                            Practitioner Implementation Strategies - Psychology of Eating
                        </p>
                        <p class="tile-copy">
                            Introductory topics of this course include the emotional, mental and spiritual
                            components to eating. Included is a discussion of the concepts behind
                            food addiction, barriers to healing, nutrition dysfunctions, and the
                            impact of cultural differences. This module also presents concepts related
                            to eating challenges for children and considerations for vegan/vegetarians.
                            The last topics of this series provide realistic and practical implementation
                            tactics for optimal patient compliance.
                        </p>
                    </div>
                </div>

                <p class="subheader">
                    — Neuroinflammation —
                </p>

                <div class="post-block-wrapper">
                    <div class="post-tile">
                        <p class="tile-title">
                            Chronic Inflammation and Pain in the Chiropractic practice; an Overview
                        </p>
                        <p class="tile-copy">
                            This module provides insight into the role of neuroinflammation in chronic conditions.
                        </p>
                    </div>

                    <div class="post-tile">
                        <p class="tile-title">
                            How Chronic Degenerative Conditions Commonly Seen in the Chiropractic Practice
                            Contribute to Neuroinflammation and Pain
                        </p>
                        <p class="tile-copy">
                            This module provides the clinical application of how to assess, diagnose, and offer
                            therapeutic interventions with diet, nutrient (specifically magnesium),
                            and lifestyle modifications.
                        </p>
                    </div>

                    <div class="post-tile">
                        <p class="tile-title">
                            Correlate the Resolution Inflammation and Pain and Its Biomolecular Influences
                            as well as the Chiropractic Adjustment
                        </p>
                        <p class="tile-copy">
                            This module includes the concept and clinical approach to managing neuroinflammation.
                        </p>
                    </div>
                </div>

                <p class="subheader">
                    — Foundations of Herbal Medicine —
                </p>

                <div class="basic-text">
                    <p>
                        We are excited to introduce a new three-part course on Herbal Medicine with naturopathic
                        doctor Marisa Marciano. This course is designed to instruct healthcare
                        practitioners from various backgrounds on how to begin to practically integrate
                        the benefits of herbal medicine in a clinical context.
                    </p>
                    <p>
                        The first four modules are available but are pending NYCC approval (Chiropractors,
                        Naturopathic Physicians, Acupuncture, and the American Clinical Board of
                        Nutrition).
                    </p>
                </div>

                <div class="post-block-wrapper half">
                    <div class="post-tile">
                        <p class="tile-title">
                            Introduction to Herbal Medicine
                        </p>
                        <p class="tile-copy">
                            This modules aims to define Herbal Medicine and understand its current role and
                            relevance in an integrative model of health care. Also, this module will
                            create context and provide a solid theoretical framework for understanding
                            basic herbal terminology and how to apply herbal Materia Medica towards
                            clinically relevant treatment protocols.
                        </p>
                    </div>

                    <div class="post-tile">
                        <p class="tile-title">
                            Phytochemistry: Plant Constituents &amp; Pharmacology
                        </p>
                        <p class="tile-copy">
                            This module aims to provide an understanding of the major classifications of plant
                            constituents, their basic molecular structure, known pharmacology, and
                            relevance in regards to the use of herbs in a clinical setting. This
                            module also serves to recognize the advantages and disadvantages of using
                            a whole plant vs. isolated constituent extract, and understand the concept
                            of synergy in relation to a plant’s constituent profile. Additionally,
                            this module creates an understanding of how a plant's primary active
                            constituent(s) will contribute towards its pharmacology, mechanism of
                            action and potential therapeutic applications. Lastly, this module gives
                            examples of herbs that are rich in a given constituent, and their relevance
                            in a clinical setting.
                        </p>
                    </div>

                    <div class="post-tile">
                        <p class="tile-title">
                            Herbal Pharmacy &amp; Posology
                        </p>
                        <p class="tile-copy">
                            This module aims to provide an understanding of the difference in preparation as
                            well advantages and disadvantages of various forms of internal and external
                            herbal preparations, which solvents are best utilized to extract a plant’s
                            active constituents, and when you may choose to employ one over another,
                            and how the form of herbal pharmacy administered may change the medicinal
                            properties of a given herb. After completing the module, individuals
                            will be able to establish the therapeutic dose for a given herb and understand
                            how to establish dose equivalents (e.g convert milligrams to milliliters),
                            and interpret herbal product labels as well as understand how to apply
                            dosing strategies with herbs to achieve optimum therapeutic benefit.
                        </p>
                    </div>

                    <div class="post-tile">
                        <p class="tile-title">
                            Herbal Selection Criteria &amp; Formulation Principles: Making Sound Herbal Choices
                        </p>
                        <p class="tile-copy">
                            This module is designed for registrants to demonstrate step-wise and strategic
                            thinking with herbal protocols and in the development of custom herbal
                            formulations for a variety of clinical scenarios. After completing this
                            module, registrants should also be able to outline criteria for choosing
                            the best herbs, method of administration, and dosing strategy for a patient.
                            Additionally, this module will discuss key differences between herbal
                            normalizers and effectors, and when/how either is best applied depending
                            on the clinical presentation. Lastly, this module outlines criteria for
                            building custom herbal formulas from liquid extracts and develops strong
                            rationale behind clinical herbal protocols.
                        </p>
                    </div>
                </div>

                <p class="subheader">
                    — Sports Medicine —
                </p>

                <div class="basic-text text-center">
                    <p>
                        with a Nutritional-Based Focus for Health Care Practitioners
                    </p>
                </div>

                <div class="post-block-wrapper half">
                    <div class="post-tile">
                        <p class="tile-title">
                            Intro to Sports Medicine/Nutrition
                        </p>
                        <p class="tile-copy">
                            In this course, learners will be able to define Sports Medicine and understand its role and relevance in athlete care. Topics include the principals of sports training, the phases of recovery from injury, a framework for understanding basic athlete recovery from injury and the process of rehabilitation, and lastly the key nutrients/supplements that aid in recovery from injury.
                        </p>
                    </div>

                    <div class="post-tile">
                        <p class="tile-title">
                            RESILIENCY: Keeping Athletes in the Game with Nutrition
                        </p>
                        <p class="tile-copy">
                            This course provides understanding of the importance of recovery after practices and competition. Topics included are: identifying common injuries to athletes, key nutritional aspects to help maximize recovery, and managing post-exercise inflammation with nutrition. Lastly this course provides a review of nutrients important in recovery from injury as well as a discussion on the underlying nutrient deficiencies that may lead to increased risk of specific injuries.
                        </p>
                    </div>

                    <div class="post-tile">
                        <p class="tile-title">
                            How to Maintain GRIT in Sports through Nutrition
                        </p>
                        <p class="tile-copy">
                            This course will introduce learners to the role of nutrition in athletic competition and basic nutrient strategies to maximize athlete performance for Endurance-based sports and Resistance/strength-based sports. Key nutrients that support endurance & strength-based athletes are included. A discussion on the mental aspect of athlete performance and the important role that nutrition plays in supporting an athlete’s mental health is also covered in depth.
                        </p>
                    </div>

                    <div class="post-tile">
                        <p class="tile-title">
                            Foundational Nutrition Support for Athletes
                        </p>
                        <p class="tile-copy">
                            This course provides learners with a deeper understanding of the three different energy systems used during exercise. Insight into the key nutrients utilized in the metabolic energy systems used during exercise as well as the common nutrient deficiencies that may be seen in athletes is covered. A deeper discussion includes the common nutrient deficiencies that may be seen in athletes.
                        </p>
                    </div>

                    <div class="post-tile">
                        <p class="tile-title">
                            Athletes and Special Diets
                        </p>
                        <p class="tile-copy">
                            This course provides insight into the differences between common specialized diets used by athletes. Upon completion of this course, you will be able to give examples of food choices that contain nutrients that are found less abundantly in special diets and understand what to look for in a plant based protein source to recommend for athletes.
                        </p>
                    </div>

                    <div class="post-tile">
                        <p class="tile-title">
                            The Female Athlete
                        </p>
                        <p class="tile-copy">
                            This module provides learners with a better understanding of the Female Athlete Triad and the Relative Energy Deficiency Syndrome (RED-S). The signs and symptoms of relative energy deficiency syndrome are covered in this presentation. Also learners will be able to identify specific micronutrients likely to be low in diets of active females as well as understand health issues that arise from low energy intakes in females.
                        </p>
                    </div>
                </div>

                <div class="post-block-cta btn">
                    <a href="https://spuniversity.csod.com/selfreg/register.aspx?p=spuniversity&amp;c=newaccount"
                       class="" target="_blank">
                        Register
                    </a>
                </div>
            </div>
        </div>
        <!-- .post-block -->

		<!-- 5050 number 1 -->
		<div class="half-half1 module">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/Desktop-Shape-2.png" class="desktop-shape-2">
			<div class="inner">
				<div class="text-module">
					<p class="header">
						Complete at your own pace.
					</p>

					<p class="copy">
						You can complete these courses at your pace. This learning platform keeps track
						of your progress should you need to complete over multiple sessions.
					</p>

					<p class="copy">
						The learning platform in use monitors and reports your course attempts and keeps
						track of the total time you have the course open on your computer or mobile
						device.
					</p>

					<div class="list-wrapper">
						<p class="title">
							To receive credits you must:
						</p>
						<ul>
							<li>Engage with this course module open for a minimum of 60 minutes.</li>
							<li>Achieve a 90% or greater on the Final Assessment</li>
						</ul>
					</div>

					<div class="reg-btn btn">
						<a href="https://spuniversity.csod.com/selfreg/register.aspx?p=spuniversity&amp;c=newaccount"
							class="" target="_blank">Register</a>
					</div>

				</div>
				<div class="img-module">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/desktop-circle-image-1.png">
				</div>
			</div>
		</div>

		<!-- nested 5050 -->
		<div class="nested-half-half module" style="z-index: 2;">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/Desktop-Shape_3.png" class="desktop-shape-3">

			<div class="inner">
				<div class="half-half1">
					<div class="inner">
						<div class="text-module bottom-mobile svg">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/nycc-logo.png">
						</div>

						<div class="text-module no-border">
							<p class="header">More information</p>

							<p class="copy">
                                This course is approved for Chiropractors, Naturopathic Physicians, and the American Clinical Board of Nutrition. Continuing education credit (CE) is administered by the New York Chiropractic College (NYCC). <strong>Note:</strong> At this time there is no NCCAOM approval for these courses at this time for those seeking Acupuncture CE Credits.
							</p>
						</div>
					</div>

					<div class="text-module additional-text">
						<p class="title">License Renewal</p>

						<p class="copy">
							While applications relating to credit hours for license renewal in selected states
							have been executed for these programs, it remains attendees' responsibility
							to contact the state board(s) from whom they seek continuing education
							credits for purposes of ensuring said board(s) approve both venue and
							content as they relate to any seminar/course/lecture/webinar/online presentation
							(event). Neither a speaker's or exhibitor's presence at said event, nor
							product mention or display, shall in any way constitute NYCC endorsement.
							NYCC's role is strictly limited to processing, submitting, and archiving
							program documents on behalf of course sponsors.
						</p>

						<p class="title">Disclaimer</p>

						<p class="copy">
							The following states do not allow online CEUs: Indiana, Kentucky, Louisiana, Mississippi,
							Wisconsin. At this time, online CEUs are not able to be processed for
							Florida.
						</p>
					</div>
				</div>
			</div>
		</div>

		<!-- 5050 number 1 -->
		<div class="half-half1 module" style="z-index: 1;">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/Desktop-Shape-4.png" class="desktop-shape-4">
			<div class="inner">
				<div class="text-module right">
					<p class="header">
						Get Started today
					</p>

					<p class="copy">
						If this is your first time, get started by registering. If you're a returning user,
						continue by logging in. Once registered, you will need to Search, Request,
						Register, then Launch, and you’ll be on your way to continuing your education.
					</p>

					<div class="btns-wrapper">
						<div class="reg-btn btn">
							<a href="https://spuniversity.csod.com/selfreg/register.aspx?p=spuniversity&amp;c=newaccount"
								target="_blank" class="">Register</a>
						</div>

						<div class="login-btn btn">
							<a href="https://spuniversity.csod.com/client/spuniversity/default.aspx" class=""
								target="_blank">Login</a>
						</div>
					</div>

					<div class="small-text">
						<p class="title">
							Questions?
						</p>

						<p>
							Call (833) 257-6117
						</p>
						<p>
							or email <a href="mailto:contact@wholisticmatters.com" class=""
								target="_blank">contact@wholisticmatters.com</a>
						</p>
					</div>
				</div>
				<div class="img-module">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/desktop-circle-image-2.png">
				</div>
			</div>
		</div>
	<?php endwhile; endif; ?>	
</div>
	
<?php get_footer(); ?>