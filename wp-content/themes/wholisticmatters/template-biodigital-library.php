<?php
/*Template Name: Biodigital Library */
get_header('biodigital');
?>

<style>
    /** CSS RESET **/
    /* http://meyerweb.com/eric/tools/css/reset/
v2.0 | 20110126
License: none (public domain)
*/

    html, body, div, span, applet, object, iframe,
    h1, h2, h3, h4, h5, h6, p, blockquote, pre,
    a, abbr, acronym, address, big, cite, code,
    del, dfn, em, img, ins, kbd, q, s, samp,
    small, strike, strong, sub, sup, tt, var,
    b, u, i, center,
    dl, dt, dd, ol, ul, li,
    fieldset, form, label, legend,
    table, caption, tbody, tfoot, thead, tr, th, td,
    article, aside, canvas, details, embed,
    figure, figcaption, footer, header, hgroup,
    menu, nav, output, ruby, section, summary,
    time, mark, audio, video {
        margin: 0;
        padding: 0;
        border: 0;
        font-size: 100%;
        font: inherit;
        vertical-align: baseline;
    }
    /* HTML5 display-role reset for older browsers */
    article, aside, details, figcaption, figure,
    footer, header, hgroup, menu, nav, section {
        display: block;
    }
    body {
        line-height: 1;
    }
    ol, ul {
        list-style: none;
    }
    blockquote, q {
        quotes: none;
    }
    blockquote:before, blockquote:after,
    q:before, q:after {
        content: '';
        content: none;
    }
    table {
        border-collapse: collapse;
        border-spacing: 0;
    }

    button {
        outline: none;
        border: none;
    }

    button:active,
    button:focus {
        outline: none;
        border: none;
    }

    /** Z CODE **/
    .biodigital-content-body {
        position: relative;
        overflow-x: hidden;
        font-family: 'Aktiv', 'Helvetica', sans-serif;
    }

    .interactive-header {
        width: 100%;
        background: #fff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 60px;
        padding: 0 20px;
        box-sizing: border-box;
    }

    @media (min-width: 768px){
        .interactive-header {
            padding: 0 50px;
            justify-content: flex-end;
        }
    }

    /*@media (min-width: 1440px){*/
    /*.interactive-header {*/
    /*justify-content: space-between;*/
    /*}*/
    /*}*/

    .headerviewing-text {
        text-transform: capitalize;
        display: block;
        width: 100%;
        position: absolute;
        top: 60px;
        background: #00b162;
        color: #fff;
        left: 0;
        padding: 10px;
        box-sizing: border-box;
        line-height: 1.5em;
        font-weight: 700;
        font-size: 14px;
    }

    @media (min-width: 768px){
        .headerviewing-text {
            padding: 10px 40px;
        }
    }

    /*@media (min-width: 1440px){*/
    /*.headerviewing-text {*/
    /*position: relative;*/
    /*color: #000;*/
    /*background: transparent;*/
    /*padding: 0;*/
    /*width: auto;*/
    /*left: auto;*/
    /*top: auto;*/
    /*}*/
    /*}*/

    .headerviewing-text span {
        font-weight: 500;
    }

    .drawer-toggle {
        background: transparent;
    }

    .drawer-toggle .icon-bar {
        background: #00b162;
        height: 3px;
        margin-bottom: 4px;
        opacity: 1;
        transform: none;
        width: 30px;
        display: block;
    }

    @media (min-width: 768px){
        .header-logo {
            position: absolute;
            left: 40px;
        }
    }

    .header-logo img {
        height: 30px;
    }

    .interactive-drawer {
        height: 100vh;
        overflow-y: scroll;
        position: absolute;
        box-sizing: border-box;
        width: 350px;
        background: #fff;
        top: 0;
        right: -400px;
        transition: all ease 300ms;
    }

    @media (min-width: 768px){
        .interactive-drawer {
            width: 400px;
        }
    }

    .interactive-drawer.active {
        right: 0;
    }

    .interactive-drawer__header {
        background: #1a4d2c;
        color: #fff;
        padding: 20px;
        text-align: center;
        font-size: 18px;
        font-weight: 700;
    }

    .interactive-drawer__close {
        position: absolute;
        right: 20px;
        background: transparent;
        color: #fff;
        width: 25px;
        cursor: pointer;
    }

    .interactive-drawer__body {
        min-height: calc(100% - 56px);
    }

    .interactive-drawer__systems-select {
        padding: 15px 20px;
        background: #F8FCF4;
        font-weight: 700;
    }

    .field {
        position: relative;
        margin: 10px 0;
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
    }

    #system-select {
        width: 100%;
        outline: none;
        border: none;
    }

    .select-hidden {
        display: none;
    }

    .select-styled {
        cursor: pointer;
        height: 50px;
        line-height: 50px;
        font-size: 16px;
        padding: 0 20px;
        margin: 20px 0;
        /*border: 1px solid #000;*/
        background: #fff;
        border-radius: 5px;
    }

    .select-styled:after {
        content: "";
        position: absolute;
        top: 50%;
        right: 30px;
        transform: translateY(-50%);
        color: #000;
        background: url('https://wholisticmatters.com/wp-content/uploads/2019/10/arrow.png');
        width: 15px;
        height: 10px;
        background-repeat: no-repeat;
    }

    .select-styled ul {
        color: #fff;
    }

    .select-options {
        position: absolute;
        min-height: 150px;
        top: calc(100% - 1px);
        left: auto;
        z-index: 999;
        font-weight: 600;
        background: #fff;
        border: 1px solid #fff;
        width: 100vw;
        min-width: 200px;
        padding: 5px 10px 20px 10px;
        margin: 0;
        box-sizing: border-box;
        border-radius: 5px;
        overflow: hidden;
        overflow-y: scroll;
        display: none;
    }

    .select-options li {
        margin: 0;
        padding: 10px;
        color: #000;
        line-height: 1.3em;
        cursor: pointer;
    }


    .interactive-drawer__models-select {
        padding: 40px 20px;
        background: #fff;
        font-weight: 700;
    }

    .models-inner {
        display: none;
    }

    .models-inner.active {
        display: block;
    }

    .model-btn {
        display: block;
        background: #F8F8F8;
        border-radius: 5px;
        line-height: 30px;
        padding: 15px 20px;
        margin: 10px 0;
        cursor: pointer;
        line-height: 1.2em;
        font-weight: 500;
        font-size: 15px;
    }

    .model-btn.active {
        background: #419052;
        color: #fff;
    }

    #extras-acc {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        height: 50px;
        line-height: 50px;
        background: #F8F8F8;
        border-radius: 10px;
        padding: 10px 20px;
        box-sizing: border-box;
        font-weight: 500;
    }

    .extras-arrow {
        transform: rotate(180deg);
        transition: all ease 300ms;
    }

    .extras-arrow.active {
        transform: rotate(0deg);
    }

    .extras-accordion-inner {
        display: none;
        padding-left: 20px;
    }

</style>

<div class="biodigital-content-body">
    <div class="interactive-header">
        <div class="headerviewing-text">
            <p>Viewing:
                <span class="viewing-system">Neuromuscular System</span>
                >
                <span class="viewing-model">Nervous System Anatomy</span>
            </p>
        </div>

        <div class="header-logo">
            <a href="https://wholisticmatters.com">
                <img src="https://wholisticmatters.com/wp-content/themes/wholisticmatters/images/wm-logo.svg"/>
            </a>
        </div>

        <div class="header-drawer-btn">
            <button type="button" class="drawer-toggle">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
    </div>

    <div class="interactive-body">
        <div class="interactive-drawer">
            <div class="interactive-drawer__header">
                BioDigital Library
                <button class="interactive-drawer__close">
                    <svg id="close-icon" viewBox="0 0 25 25">
                        <g id="Mobile_X" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <path d="M12.4778909,10.3982424 L22.8761333,5.77315973e-14 L24.9557817,2.07964848 L14.5575393,12.4778909 L24.9557817,22.8761333 L22.8761333,24.9557817 L12.4778909,14.5575393 L2.07964848,24.9557817 L-1.98507877e-13,22.8761333 L10.3982424,12.4778909 L-1.98507877e-13,2.07964848 L2.07964848,5.41788836e-14 L12.4778909,10.3982424 Z" id="Combined-Shape" fill="#fff" fill-rule="nonzero"></path>
                        </g>
                    </svg>
                </button>
            </div>

            <div class="interactive-drawer__body">
                <div class="interactive-drawer__systems-select">
                    Biological Systems
                    <div class="field">
                        <select id="system-select">
                            <option selected value="neuromuscular">Neuromuscular System</option>
                            <option value="immune">Immune System</option>
                            <option value="digestive">Digestive System</option>
                            <option value="endocrine">Endocrine System</option>
                        </select>
                    </div>
                </div>

                <div class="interactive-drawer__models-select">
                    Biological Models
                    <div class="models-inner active" data-system="neuromuscular">
                        <div class="model-btn active" data-src="https://human.biodigital.com/widget/?m=client/standard_process/nervous_system_anatomy.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9hu">
                            Nervous System Anatomy
                        </div>

                        <div class="model-btn" data-src="https://human.biodigital.com/widget/?m=client/standard_process/structure_and_function_of_central_nervous_system_v2_tour1b.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9j0">
                            Structure and Function of the Nervous System (1)
                        </div>

                        <div class="model-btn" data-src="https://human.biodigital.com/widget/?m=client/standard_process/structure_and_function_of_central_nervous_system_v2_tour1c.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9j0">
                            Structure and Function of the Nervous System (2)
                        </div>

                        <div class="extras-accordion">
                            <div id="extras-acc">
                                Extras

                                <svg class="extras-arrow" xmlns="http://www.w3.org/2000/svg" width="12.544" height="6.772" viewBox="0 0 12.544 6.772">
                                    <defs>
                                        <style>
                                            .arrow{fill:#1a4d2c;stroke:#1a4d2c;stroke-linecap:round;stroke-linejoin:round;}
                                        </style>
                                    </defs>
                                    <path class="arrow" d="M1179.949,35.055l5.772,5.772,5.772-5.772Z" transform="translate(1191.993 41.327) rotate(180)"/>
                                </svg>
                            </div>

                            <div class="extras-accordion-inner">
                                <div class="model-btn" data-src="https://human.biodigital.com/widget/?m=client/standard_process/afferent_nerve_signal.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9j0">
                                    Afferent and Efferent Nerve Signals (1)
                                </div>

                                <div class="model-btn" data-src="https://human.biodigital.com/widget/?m=client/standard_process/efferent_nerve_signal.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9j0">
                                    Afferent and Efferent Nerve Signals (2)
                                </div>

                                <div class="model-btn" data-src="https://human.biodigital.com/widget/?m=client/standard_process/brain_gut_connection.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9j0">
                                    Brain-Gut Connection
                                </div>

                                <div class="model-btn" data-src="https://human.biodigital.com/widget/?m=client/standard_process/central_nervous_system.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9j0">
                                    Central Nervous System
                                </div>

                                <div class="model-btn" data-src="https://human.biodigital.com/widget/?m=client/standard_process/functional_regions_of_the_spinal_cord.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9j0">
                                    Functional Regions of the Spinal Cord
                                </div>

                                <div class="model-btn" data-src="https://human.biodigital.com/widget/?m=client/standard_process/hpa_neuro_immune_axis.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9j0">
                                    HPA Neuro-Immune Axis
                                </div>

                                <div class="model-btn" data-src="https://human.biodigital.com/widget/?m=client/standard_process/neuron_signaling_2.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9j0">
                                    Neuron Signaling
                                </div>

                                <div class="model-btn" data-src="https://human.biodigital.com/widget/?m=client/standard_process/neurotransmitters_in_synapse.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9j0">
                                    Neurotransmitters in Synapse
                                </div>

                                <div class="model-btn" data-src="https://human.biodigital.com/widget/?m=client/standard_process/parasympathetic_nervous_system.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9j0">
                                    Parasympathetic Nervous System
                                </div>

                                <div class="model-btn" data-src="https://human.biodigital.com/widget/?m=client/standard_process/sympathetic_nervous_system.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9j0">
                                    Sympathetic Nervous System
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="models-inner" data-system="immune">
                        <div class="model-btn" data-src="https://human.biodigital.com/widgets/default/?m=client/standard_process/cns_inflammation.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9j0">
                            Inflammation in the Central Nervous System
                        </div>

                        <div class="model-btn" data-src="https://human.biodigital.com/widget/?m=client/standard_process/inflammation_in_the_cns_role_of_microglia.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9j0">
                            Inflammation in the Central Nervous System: The Role of Microglia
                        </div>

                        <div class="model-btn" data-src="https://human.biodigital.com/widget/?m=client/standard_process/resolution_pathway_and_nutrition_therapy.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9j0">
                            Resolution Pathway and Nutrition Therapy: Omega 3 Fatty Acids on the Microglia (1)
                        </div>

                        <div class="model-btn" data-src="https://human.biodigital.com/widgets/default/?m=client/standard_process/epigenetics.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9j0">
                            Resolution Pathway and Nutrition Therapy: Omega 3 Fatty Acids on the Microglia (2)
                        </div>
                    </div>

                    <div class="models-inner" data-system="digestive">
                        <div class="model-btn" data-src="https://human.biodigital.com/widgets/default/?m=client/standard_process/digestive_health_systems_support.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9j0">
                            Digestive Health and Systems Support
                        </div>
                    </div>

                    <div class="models-inner" data-system="endocrine">
                        <div class="model-btn" data-src="https://human.biodigital.com/widgets/default/?m=client/standard_process/endocrine_support.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9j0">
                            Endocrine Support for Metabolic Systems and Response
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="iframe-wrapper">
            <iframe
                    id="embedded-human"
                    frameBorder="0"
                    width="100%"
                    height="550"
                    allowFullScreen="true"
                    src="https://human.biodigital.com/widget/?m=client/standard_process/nervous_system_anatomy.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9hu">
            </iframe>
        </div>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>