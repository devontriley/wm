<?php
/*Template Name: UPDATED Biodigital Library */
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
        background: #144D28;
    }

    .headerviewing-text {
        text-transform: capitalize;
        display: block;
        width: 100%;
        top: 0;
        background: #144D28;
        color: #fff;
        left: 0;
        padding: 10px;
        box-sizing: border-box;
        line-height: 1.5em;
        font-weight: 700;
        font-size: 12px;
    }

    @media (min-width: 768px){
        .headerviewing-text {
            padding: 10px 20px;
        }
    }

    .headerviewing-text span {
        font-weight: 500;
    }

    #create-new-account-btn {
        display: none;
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #07E36E;
    }

    @media(min-width: 992px){
        #create-new-account-btn {
            display: block;
        }
    }

    .interactive-header {
        width: 100%;
        background: #fff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 20px;
        box-sizing: border-box;
    }

    @media (min-width: 768px){
        .interactive-header {
            /*padding: 0 50px;*/
            justify-content: flex-end;
        }
    }

    .main-header {
        width: 100%;
        display: flex;
        padding: 10px 0;
        justify-content: space-between;
        align-items: center;
    }

    .drawer-toggle {
        background: #00B162;
        color: #fff;
        border-radius: 5px;
        font-size: 14px;
        width: 100px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
    }

    @media(min-width: 768px){
        .drawer-toggle {
            width: 150px;
        }
    }

    .content-container {
        display: none;
        align-items: center;
        justify-content: space-between;
    }

    .content-container.active {
        display: flex;
    }

    .drawer-toggle .icon {
        position: absolute;
        left: 10px;
    }

    .drawer-toggle .icon-bar {
        background: #07E36E;
        height: 2px;
        margin-bottom: 4px;
        opacity: 1;
        transform: none;
        width: 20px;
        display: block;
    }

    .drawer-toggle .label {
        margin-left: 25px;
    }

    .header-logo img {
        height: 30px;
        width: 225px;
    }

    .interactive-drawer {
        height: calc( 100vh - 98px);
        overflow-y: scroll;
        position: absolute;
        box-sizing: border-box;
        width: 100%;
        background: #fff;
        top: 98px;
        right: -500px;
        transition: all ease 300ms;
    }

    @media (min-width: 768px){
        .interactive-drawer {
            /*width: 400px;*/
            right: -100vw;
        }
    }

    .interactive-drawer.active {
        right: 0;
    }

    .interactive-drawer__body {
        min-height: 100%;
        background: #063811;
    }

    .interactive-drawer__systems-select {
        padding: 15px 20px;
        background: #144D28;
        font-weight: 700;
        color: #B7E7C7;
        position: sticky;
        top: 0;
        z-index: 8;
    }

    /** NEW SELECT FIELD **/
    #new-system-select {
        display: flex;
        overflow-x: scroll;
        margin: 20px 0;
    }

    @media(min-width: 992px){
        #new-system-select {
            overflow: visible;
        }
    }

    #new-system-select .system-block {
        margin: 0 10px;
        cursor: pointer;
    }

    #new-system-select .system-block:first-child {
        margin-left: 0;
    }

    #new-system-select .system-block .inner {
        width: 170px;
        height: 116px;
        border-radius: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        transition: all ease 300ms;
    }

    #new-system-select .system-block .inner:after {
        content: "";
        position: absolute;
        background: #063811;
        border: 2px solid #063811;
        border: 2px solid #063811;
        border-radius: 10px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        transition: all ease 300ms;
    }

    @media(min-width: 992px){
        #new-system-select .system-block:hover .inner:after {
            top: -5px;
            box-shadow: -8px 10px 5px 0px rgba(0,0,0,0.5);
        }

        #new-system-select .system-block:hover .system-icon {
            margin-bottom: 5px;
        }

        #new-system-select .system-block.active:hover .system-icon {
            margin-bottom: 0;
        }
    }

    #new-system-select .system-block.active .inner {
        background: #00B162;
        border: 2px solid #07E36E;
    }

    #new-system-select .system-block.active .inner:after {
        display: none;
    }

    #new-system-select .system-block .system-icon {
        z-index: 3;
        transition: all ease 300ms;
    }

    #new-system-select .system-block .label {
        margin-top: 10px;
    }

    #new-system-select .system-block .label span {
        display: block;
    }

    #new-system-select .system-block .label span.name {
        font-size: 12px;
    }

    #new-system-select .system-block .label span.count {
        font-size: 10px;
        font-weight: 500;
        color: #07E36E;
        margin-top: 5px;
    }

    .interactive-drawer__models-select {
        padding: 40px 20px;
        background: #063811;
        font-weight: 700;
        color: #B7E7C7;
        width: 100%;
        position: relative;
    }

    .models-inner {
        display: none;
        flex-wrap: wrap;
        margin-top: 20px;
    }

    .models-inner.active {
        display: flex;
    }

    .model-btn {
        display: block;
        position: relative;
        flex: 0 0 50%;
        max-width: 50%;
        border-radius: 5px;
        margin-bottom: 20px;
        cursor: pointer;
    }

    @media (min-width: 768px){
        .model-btn {
            flex: 0 0 25%;
            max-width: 25%;
            margin-bottom: 40px;
        }
    }

    @media (min-width: 992px){
        .model-btn {
            flex: 0 0 20%;
            max-width: 20%;
        }
    }
    
    .model-btn .img-inner {
        position: relative;
        border-radius: 8px;
        height: 199px;
    }

    @media (min-width: 992px){
        .model-btn .img-inner {
            height: 230px;
        }
    }

    .model-btn .gated-lock {
        display: none;
        position: absolute;
        left: 10px;
        bottom: 10px;
        fill: #fff;
    }

    .model-btn.gated .gated-lock {
        display: block;
    }

    .model-btn.gated .img-inner:before {
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        background: rgba(6, 56, 17, .5);
    }

    .model-btn.active .img-inner {
        color: #fff;
    }

    .model-btn.active .img-inner img {
        border: 2px solid #07E36E;
        border-radius: 8px;
    }

    .model-btn.active .text-inner:after {
        content: "Now Viewing";
        color: #07E36E;
        font-size: 10px;
        display: block;
    }

    .model-btn img {
        width: 150px;
    }
    
    @media(min-width: 992px){
        .model-btn img {
            width: 175px;
        }
    }

    .model-btn .text-inner {
        width: 150px;
    }

    @media(min-width: 992px){
        .model-btn .text-inner {
            width: 175px;
        }
    }

    .model-btn .label {
        font-size: 11px;
    }

    .model-btn .gated {
        display: none;
        font-size: 9px;
        font-weight: 500;
        color: #07E36E;
    }

    .model-btn.gated .gated {
        display: block;
    }

</style>

<?php

    if( !is_user_logged_in()) echo '<div class="biodigital-content-body gated-content">';
    else echo '<div class="biodigital-content-body">';
 ?>
    <div class="headerviewing-text">
        <p>Viewing:
            <span class="viewing-system">Neuromuscular System</span>
            >
            <span class="viewing-model">Nervous System Anatomy</span>
        </p>

        <?php if( !is_user_logged_in()) echo '<p id="create-new-account-btn">+ Create Free Account</p>'; ?>
    </div>

    <div class="interactive-header">
        <div class="main-header">
            <div class="header-logo">
                <a href="https://wholisticmatters.com">
                    <img src="https://wholisticmatters.com/wp-content/themes/wholisticmatters/images/wm-logo.svg"/>
                </a>
            </div>

            <div class="header-drawer-btn">
                <button type="button" class="drawer-toggle">
                    <div class="content-container open-container active">
                        <div class="icon">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </div>
                        <span class="label">Libraries</span>
                    </div>

                    <div class="content-container close-container">
                        <svg class="icon" width="10px" viewBox="0 0 8.593 14.25">
                            <defs>
                                <style>
                                    .a{fill:#07e36e;}
                                </style>
                            </defs>
                            <g transform="translate(-609.85 -65.193)">
                                <rect class="a" width="10.086" height="2.067" transform="translate(611.311 70.85) rotate(45)"/>
                                <rect class="a" width="10.086" height="2.067" transform="translate(609.85 72.325) rotate(-45)"/>
                            </g>
                        </svg>
                        <span class="label">Return</span>
                    </div>
                </button>
            </div>
        </div>
    </div>

    <div class="interactive-body">
        <div class="interactive-drawer">
            <div class="interactive-drawer__body">
                <div class="interactive-drawer__systems-select">
                    Systems:
                    <div id="new-system-select">
                        <div class="system-block active" data-value="neuromuscular">
                            <div class="inner">
                                <svg class="system-icon" width="75.035" height="74.53" viewBox="0 0 75.035 74.53">
                                    <defs>
                                        <style>
                                            .a{fill:#b6e8c6;}
                                        </style>
                                    </defs>
                                    <path class="a" d="M32.02,5.77a9.464,9.464,0,0,0-9.4,6.956A9.982,9.982,0,0,0,12.761,22.7v.208a12.39,12.39,0,0,0-4.74,9.713A15.3,15.3,0,0,0,8.6,36.225,10.313,10.313,0,0,0,7.429,49.654a9.707,9.707,0,0,0,1.2,1.341,12.576,12.576,0,0,0-.608,3.915,12.35,12.35,0,0,0,5.048,9.955A12.342,12.342,0,0,0,24.006,76.077,9.721,9.721,0,0,0,41.433,73.02a6.555,6.555,0,0,0,.317-2V15.458c0-.125-.008-.242-.017-.35A9.687,9.687,0,0,0,32.02,5.77Zm8.064,65.25a5.09,5.09,0,0,1-.25,1.541,8.064,8.064,0,0,1-14.653,2.282l-.217-.358-.425-.033A10.673,10.673,0,0,1,14.7,64.373l-.017-.417-.342-.233A10.672,10.672,0,0,1,9.687,54.91a10.952,10.952,0,0,1,.342-2.782,10.193,10.193,0,0,0,10.854.325,8.029,8.029,0,0,0,1.466,1.175,7.662,7.662,0,0,0,8.005-.025l-.875-1.416a5.988,5.988,0,0,1-8.255-8.214L19.8,43.106a7.634,7.634,0,0,0,.042,8.022A8.58,8.58,0,0,1,10.12,50.12a8.221,8.221,0,0,1-1.341-1.449,8.621,8.621,0,0,1,1.308-11.546l.408-.358-.158-.516a15.083,15.083,0,0,1-.65-3.632A10.7,10.7,0,0,1,14.1,23.98l.375-.267-.033-.466c-.017-.183-.017-.358-.017-.55a8.319,8.319,0,0,1,8.305-8.314c.175,0,.35.008.516.017a8.321,8.321,0,0,1,7.73,7.247,9.431,9.431,0,0,0-4.3,5.015,9.476,9.476,0,0,0-9.5,8.98l1.666.092a7.785,7.785,0,0,1,7.389-7.4,9.446,9.446,0,0,0,.533,5.14l1.549-.616a7.83,7.83,0,0,1,3.907-9.98l.508-.242-.033-.558a9.98,9.98,0,0,0-8.372-9.23,7.945,7.945,0,0,1,7.7-5.415,8.045,8.045,0,0,1,8.055,7.755c0,.092.008.175.008.267V71.02ZM32.62,66.672l1.208,1.141a7.244,7.244,0,0,1-12.237-6.989l1.6.466a5.582,5.582,0,0,0,9.43,5.381Zm20.759,0a5.582,5.582,0,0,0,9.43-5.381l1.6-.466a7.248,7.248,0,0,1-12.245,6.989ZM77.395,36.225a15.291,15.291,0,0,0,.575-3.607,12.382,12.382,0,0,0-4.732-9.713V22.7a9.984,9.984,0,0,0-9.871-9.971A9.448,9.448,0,0,0,53.978,5.77a9.693,9.693,0,0,0-9.721,9.33c-.008.117-.008.233-.008.358V71.02a6.494,6.494,0,0,0,.3,1.949,9.724,9.724,0,0,0,17.443,3.107A12.349,12.349,0,0,0,72.93,64.864a12.342,12.342,0,0,0,5.04-9.955,12.57,12.57,0,0,0-.6-3.915,9.651,9.651,0,0,0,1.191-1.341A10.312,10.312,0,0,0,77.395,36.225ZM77.22,48.671a8.932,8.932,0,0,1-1.341,1.458,8.592,8.592,0,0,1-9.721,1,7.634,7.634,0,0,0,.042-8.022l-1.424.866a5.988,5.988,0,0,1-8.255,8.214L55.644,53.6a7.647,7.647,0,0,0,8,.025,7.5,7.5,0,0,0,1.466-1.175,10.208,10.208,0,0,0,10.863-.325A10.993,10.993,0,0,1,76.3,54.91a10.686,10.686,0,0,1-4.648,8.813l-.342.233-.025.417a10.667,10.667,0,0,1-9.838,10.08l-.417.033-.225.358a8.061,8.061,0,0,1-14.661-2.332,5.023,5.023,0,0,1-.233-1.491V15.458c0-.092,0-.183.008-.283a8.037,8.037,0,0,1,8.055-7.739,7.953,7.953,0,0,1,7.7,5.415,9.98,9.98,0,0,0-8.372,9.23l-.033.558.508.242a7.838,7.838,0,0,1,3.907,9.98l1.541.616a9.4,9.4,0,0,0,.541-5.148,7.818,7.818,0,0,1,7.389,7.406l1.666-.092a9.476,9.476,0,0,0-9.5-8.98,9.431,9.431,0,0,0-4.3-5.015A8.314,8.314,0,0,1,62.75,14.4c.167-.008.342-.017.508-.017A8.326,8.326,0,0,1,71.572,22.7c0,.192-.05,1.016-.05,1.016l.375.267A10.718,10.718,0,0,1,76.3,32.618a14.688,14.688,0,0,1-.65,3.632l-.158.516.417.358A8.639,8.639,0,0,1,77.22,48.671Z" transform="translate(-5.48 -5.77)"/>
                                </svg>
                            </div>
                            <div class="label">
                                <span class="name">Neuromuscular System</span>
                                <span class="count">15 Models</span>
                            </div>
                        </div>

                        <div class="system-block" data-value="immune">
                            <div class="inner">
                                <svg class="system-icon" width="74" height="74" viewBox="0 0 74 74">
                                    <defs>
                                        <style>
                                            .a{fill:#b6e8c6;}
                                        </style>
                                    </defs>
                                    <g transform="translate(-258 -193)">
                                        <path class="a" d="M75,38H67a2,2,0,0,0,0,4h1.923A29.034,29.034,0,0,1,42,68.923V67a2,2,0,0,0-4,0v1.923A29.034,29.034,0,0,1,11.077,42H13a2,2,0,0,0,0-4H11.077A29.034,29.034,0,0,1,38,11.077V13a2,2,0,0,0,4,0V11.076A29.037,29.037,0,0,1,68.451,34.385a2,2,0,0,0,3.926-.77A33.046,33.046,0,0,0,42,7.068V5a2,2,0,1,0-4,0V7.066A33.041,33.041,0,0,0,7.066,38H5a2,2,0,0,0,0,4H7.066A33.041,33.041,0,0,0,38,72.934V75a2,2,0,0,0,4,0V72.934A33.041,33.041,0,0,0,72.934,42H75a2,2,0,0,0,0-4Z" transform="translate(255 190)"/><path class="a" d="M60.107,36a2,2,0,0,0-.214-4l-4.469.241A9.931,9.931,0,0,0,54,28.829l3.415-3.415a2,2,0,1,0-2.828-2.828L51.172,26a9.874,9.874,0,0,0-3.415-1.431L48,20.107a2,2,0,1,0-4-.214l-.25,4.633a9.872,9.872,0,0,0-3.482,1.4L37.521,22.7a2,2,0,0,0-3.041,2.6l2.8,3.28-2.937,2.937-2.929-2.929a2,2,0,1,0-2.828,2.828l2.929,2.929L28.579,37.28l-3.28-2.8a2,2,0,1,0-2.6,3.042l3.222,2.751a9.95,9.95,0,0,0-1.393,3.481L19.893,44A2,2,0,1,0,20,48h.109l4.469-.241A9.931,9.931,0,0,0,26,51.171l-3.415,3.415a2,2,0,1,0,2.828,2.828L28.828,54a9.874,9.874,0,0,0,3.416,1.431L32,59.892A2,2,0,0,0,33.892,62H34a2,2,0,0,0,2-1.892l.25-4.634a9.873,9.873,0,0,0,3.482-1.4L42.479,57.3a2,2,0,0,0,3.043-2.6l-2.8-3.281,2.936-2.936,2.929,2.929a2,2,0,1,0,2.828-2.828l-2.929-2.929,2.936-2.936,3.28,2.8a2,2,0,1,0,2.6-3.042l-3.222-2.75a9.95,9.95,0,0,0,1.393-3.481ZM38.586,49.9A6,6,0,0,1,30.1,41.414L41.414,30.1a5.961,5.961,0,0,1,4.238-1.757h.011A6,6,0,0,1,49.9,38.586Z" transform="translate(255 190)"/>
                                    </g>
                                </svg>
                            </div>
                            <div class="label">
                                <span class="name">Immune System</span>
                                <span class="count">6 Models</span>
                            </div>
                        </div>

                        <div class="system-block" data-value="digestive">
                            <div class="inner">
                                <svg class="system-icon" width="69.968" height="69.985" viewBox="0 0 69.968 69.985">
                                    <defs>
                                        <style>
                                            .a{fill:#b6e8c6;}
                                        </style>
                                    </defs>
                                    <g transform="translate(-2 -1.985)">
                                        <rect class="a" width="2.332" height="2.332" transform="translate(52.144 45.149)"/>
                                        <rect class="a" width="2.332" height="2.332" transform="translate(48.645 48.648)"/>
                                        <path class="a" d="M52.882,2A18.518,18.518,0,0,0,36,11.332H31.157a1.166,1.166,0,0,1-1.166-1.166V2H27.658v8.163a3.5,3.5,0,0,0,3.5,3.5h6.227l.327-.618A16.244,16.244,0,0,1,52.788,4.335c8.688.35,15.684,7.895,15.684,16.839V38.153A22.157,22.157,0,0,1,46.316,60.309H29.711A11.346,11.346,0,0,1,18.387,50.42a11.043,11.043,0,0,1,1.784-7.3l.268-.455-.117-.49c-.1-.455-.2-.9-.268-1.353v-.245a5.481,5.481,0,0,0-6.169-4.665A5.656,5.656,0,0,0,9,41.581V71.97h2.332V41.581a3.382,3.382,0,0,1,2.8-3.428,3.184,3.184,0,0,1,3.58,2.729v.245a6.684,6.684,0,0,0,.21,1.166A13.247,13.247,0,0,0,16.043,50.7,13.527,13.527,0,0,0,29.711,62.641H46.316A24.489,24.489,0,0,0,70.805,38.153V21.174C70.805,10.993,62.77,2.4,52.882,2Z" transform="translate(1.163)"/>
                                        <path class="a" d="M4.332,40.622A10.647,10.647,0,0,1,14.967,29.987h.956a10.658,10.658,0,0,1,9.119,5.178,6.157,6.157,0,0,0,5.4,2.985h.082a6.32,6.32,0,0,0,6.46-6.3V20.658h-7A8.163,8.163,0,0,1,21.824,12.5V2H19.492V12.5a10.5,10.5,0,0,0,10.5,10.5h4.665v8.863a4.046,4.046,0,0,1-4.221,3.965,3.872,3.872,0,0,1-3.382-1.842,13.037,13.037,0,0,0-11.125-6.32h-.956A12.979,12.979,0,0,0,2,40.622V71.968H4.332Z" transform="translate(0 0.002)"/>
                                        <path class="a" d="M27.746,39.818a8.746,8.746,0,0,0,0,17.492H44.655A19.824,19.824,0,0,0,64.479,37.486V19.994a13.994,13.994,0,1,0-27.987,0V31.072A8.746,8.746,0,0,1,27.746,39.818Zm16.909,15.16H27.746a6.414,6.414,0,1,1,0-12.827,11.008,11.008,0,0,0,5.1-1.248h0a3.638,3.638,0,0,1,1.318-.315,4.011,4.011,0,0,1,2.705.583,6.414,6.414,0,0,0,6.787,0,4.023,4.023,0,0,1,4.291,0,6.414,6.414,0,0,0,6.787,0,4.023,4.023,0,0,1,4.291,0,6.344,6.344,0,0,0,2.472.91,17.492,17.492,0,0,1-16.839,12.9ZM38.824,31.072V19.994a11.661,11.661,0,0,1,23.323,0V37.486a18.333,18.333,0,0,1-.163,2.332,3.837,3.837,0,0,1-1.691-.571,6.367,6.367,0,0,0-6.787,0,4.07,4.07,0,0,1-4.291,0,6.367,6.367,0,0,0-6.787,0,4.07,4.07,0,0,1-4.291,0,6.122,6.122,0,0,0-2.064-.84A11.055,11.055,0,0,0,38.824,31.072Z" transform="translate(2.824 0.667)"/>
                                    </g>
                                </svg>
                            </div>
                            <div class="label">
                                <span class="name">Digestive System</span>
                                <span class="count">6 Models</span>
                            </div>
                        </div>

                        <div class="system-block" data-value="endocrine">
                            <div class="inner">
                                <svg class="system-icon" width="78" height="64.693" viewBox="0 0 78 64.693">
                                    <defs>
                                        <style>
                                            .a{fill:#b7e7c7;}
                                        </style>
                                    </defs>
                                    <g transform="translate(-2123.664 -868)">
                                        <path class="a" d="M73.135,75.2a10.437,10.437,0,0,0-5.216.261,6.754,6.754,0,0,1-4.511,0,10.42,10.42,0,0,0-5.216-.257,7.383,7.383,0,0,0-5.59,7.038c0,6.326,7.664,13.1,13.059,13.1s13.063-6.777,13.063-13.1A7.384,7.384,0,0,0,73.135,75.2ZM65.663,90.324c-2.592,0-8.045-4.531-8.045-8.089a2.366,2.366,0,0,1,1.7-2.154,4.311,4.311,0,0,1,.979-.12,6.821,6.821,0,0,1,1.785.329,11.561,11.561,0,0,0,7.16,0,5.1,5.1,0,0,1,2.761-.209,2.364,2.364,0,0,1,1.706,2.154C73.712,85.795,68.257,90.324,65.663,90.324ZM102.64,30.694A2.5,2.5,0,0,0,99.7,32.673c-3.657,18.6-23.209,33.7-34.032,33.7s-30.375-15.1-34.032-33.7a2.507,2.507,0,1,0-4.92.966,46.913,46.913,0,0,0,9.805,20.284c4.085,16.689,5.1,35.511,5.114,35.765a2.507,2.507,0,0,0,2.5,2.38c.042,0,.087,0,.13,0a2.511,2.511,0,0,0,2.377-2.631,235.166,235.166,0,0,0-3.486-28.617c7.586,6.643,16.193,10.569,22.512,10.569S80.6,67.454,88.183,60.812A235.842,235.842,0,0,0,84.69,89.433a2.511,2.511,0,0,0,2.377,2.631c.043,0,.089,0,.13,0a2.507,2.507,0,0,0,2.5-2.38c.013-.254,1.024-19.073,5.109-35.759a46.928,46.928,0,0,0,9.81-20.291A2.508,2.508,0,0,0,102.64,30.694Z" transform="translate(2097 837.354)"/>
                                    </g>
                                </svg>
                            </div>
                            <div class="label">
                                <span class="name">Endorcine System</span>
                                <span class="count">2 Models</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="interactive-drawer__models-select">
                    Models:
                    <div class="models-inner active" data-system="neuromuscular">
                        <div class="model-btn active" data-src="https://human.biodigital.com/widgets/standardprocess/?m=client/standard_process/nervous_system_anatomy.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9hu">
                            <div class="text-img-inner">
                                <div class="img-inner">
                                    <img class="model-img" src="https://wholisticmatters.com/wp-content/uploads/2020/01/Nervous-System-Anatomy@2x.png">
                                    <svg class="gated-lock" width="14" height="18.667" viewBox="0 0 14 18.667"><path class="a" d="M14.667,7.778V4.667a4.667,4.667,0,0,0-9.333,0V7.778H3V18.667H17V7.778Zm-7.778,0V4.667a3.111,3.111,0,0,1,6.222,0V7.778Z" transform="translate(-3)"/></svg>
                                </div>
                                <!-- TODO: add text and img inners as well as text inners, change inner to img-inner -->
                                <div class="text-inner">
                                    <span class="label">Nervous System Anatomy</span>
                                    <span class="gated">View with free account</span>
                                </div>
                            </div>
                        </div>

                        <div class="model-btn" data-src="https://human.biodigital.com/widgets/standardprocess/?m=client/standard_process/structure_and_function_of_central_nervous_system_v2_tour1b.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9j0">
                            <div class="text-img-inner">
                                <div class="img-inner">
                                    <img class="model-img" src="https://wholisticmatters.com/wp-content/uploads/2020/01/Structure-Function-of-the-Nervous-System-Part-1@2x.png">
                                    <svg class="gated-lock" width="14" height="18.667" viewBox="0 0 14 18.667"><path class="a" d="M14.667,7.778V4.667a4.667,4.667,0,0,0-9.333,0V7.778H3V18.667H17V7.778Zm-7.778,0V4.667a3.111,3.111,0,0,1,6.222,0V7.778Z" transform="translate(-3)"/></svg>
                                </div>

                                <div class="text-inner">
                                    <span class="label">Structure and Function of the Nervous System (1)</span>
                                    <span class="gated">View with free account</span>
                                </div>
                            </div>
                        </div>

                        <div class="model-btn" data-src="https://human.biodigital.com/widgets/standardprocess/?m=client/standard_process/structure_and_function_of_central_nervous_system_v2_tour1c.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9j0">
                            <div class="text-img-inner">
                                <div class="img-inner">
                                    <img class="model-img" src="https://wholisticmatters.com/wp-content/uploads/2020/01/Structure-Function-of-the-Nervous-System-Part-2@2x.png">
                                    <svg class="gated-lock" width="14" height="18.667" viewBox="0 0 14 18.667"><path class="a" d="M14.667,7.778V4.667a4.667,4.667,0,0,0-9.333,0V7.778H3V18.667H17V7.778Zm-7.778,0V4.667a3.111,3.111,0,0,1,6.222,0V7.778Z" transform="translate(-3)"/></svg>
                                </div>

                                <div class="text-inner">
                                    <span class="label">Structure and Function of the Nervous System (2)</span>
                                    <span class="gated">View with free account</span>
                                </div>
                            </div>
                        </div>

                        <div class="model-btn" data-src="https://human.biodigital.com/viewer/?m=client/standard_process/musculoskeletal_injury_and_joint_inflammation_in_ankle.json&ui-info=true&ui-search=true&ui-reset=true&ui-fullscreen=true&ui-nav=true&ui-tools=true&ui-help=true&ui-chapter-list=true&ui-label-list=true&ui-anatomy-descriptions=false&disable-scroll=false&uaid=4qh4c">
                            <div class="text-img-inner">
                                <div class="img-inner">
                                    <img class="model-img" src="https://wholisticmatters.com/wp-content/uploads/2020/01/Musculoskeletal-Injury-and-Joint-Inflammation-in-Ankle@2x.png">
                                    <svg class="gated-lock" width="14" height="18.667" viewBox="0 0 14 18.667"><path class="a" d="M14.667,7.778V4.667a4.667,4.667,0,0,0-9.333,0V7.778H3V18.667H17V7.778Zm-7.778,0V4.667a3.111,3.111,0,0,1,6.222,0V7.778Z" transform="translate(-3)"/></svg>
                                </div>

                                <div class="text-inner">
                                    <span class="label">Musculoskeletal Injury and Joint Inflammation in Ankle</span>
                                    <span class="gated">View with free account</span>
                                </div>
                            </div>
                        </div>

                        <div class="model-btn" data-src="https://human.biodigital.com/viewer/?m=client/standard_process/inflammatory_response_in_bone_matrix.json&ui-info=true&ui-search=true&ui-reset=true&ui-fullscreen=true&ui-nav=true&ui-tools=true&ui-help=true&ui-chapter-list=true&ui-label-list=true&ui-anatomy-descriptions=false&disable-scroll=false&uaid=4qh5j">
                            <div class="text-img-inner">
                                <div class="img-inner">
                                    <img class="model-img" src="https://wholisticmatters.com/wp-content/uploads/2020/01/Bone-After-Acute-Trauma@2x.png">
                                    <svg class="gated-lock" width="14" height="18.667" viewBox="0 0 14 18.667"><path class="a" d="M14.667,7.778V4.667a4.667,4.667,0,0,0-9.333,0V7.778H3V18.667H17V7.778Zm-7.778,0V4.667a3.111,3.111,0,0,1,6.222,0V7.778Z" transform="translate(-3)"/></svg>
                                </div>

                                <div class="text-inner">
                                    <span class="label">Bone After Acute Trauma</span>
                                    <span class="gated">View with free account</span>
                                </div>
                            </div>
                        </div>

                        <div class="model-btn" data-src="https://human.biodigital.com/widgets/standardprocess/?m=client/standard_process/afferent_nerve_signal.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9j0">
                            <div class="text-img-inner">
                                <div class="img-inner">
                                    <img class="model-img" src="https://wholisticmatters.com/wp-content/uploads/2020/01/Afferent-Efferent-Nerve-Signals-Part-1@2x.png">
                                    <svg class="gated-lock" width="14" height="18.667" viewBox="0 0 14 18.667"><path class="a" d="M14.667,7.778V4.667a4.667,4.667,0,0,0-9.333,0V7.778H3V18.667H17V7.778Zm-7.778,0V4.667a3.111,3.111,0,0,1,6.222,0V7.778Z" transform="translate(-3)"/></svg>
                                </div>
                                <div class="text-inner">
                                    <span class="label">Afferent and Efferent Nerve Signals (1)</span>
                                    <span class="gated">View with free account</span>
                                </div>
                            </div>
                        </div>

                        <div class="model-btn" data-src="https://human.biodigital.com/widgets/standardprocess/?m=client/standard_process/efferent_nerve_signal.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9j0">
                            <div class="text-img-inner">
                                <div class="img-inner">
                                    <img class="model-img" src="https://wholisticmatters.com/wp-content/uploads/2020/01/Afferent-Efferent-Nerve-Signals-Part-2@2x.png">
                                    <svg class="gated-lock" width="14" height="18.667" viewBox="0 0 14 18.667"><path class="a" d="M14.667,7.778V4.667a4.667,4.667,0,0,0-9.333,0V7.778H3V18.667H17V7.778Zm-7.778,0V4.667a3.111,3.111,0,0,1,6.222,0V7.778Z" transform="translate(-3)"/></svg>
                                </div>
                                <div class="text-inner">
                                    <span class="label">Afferent and Efferent Nerve Signals (2)</span>
                                    <span class="gated">View with free account</span>
                                </div>
                            </div>
                        </div>

                        <div class="model-btn" data-src="https://human.biodigital.com/widgets/standardprocess/?m=client/standard_process/brain_gut_connection.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9j0">
                            <div class="text-img-inner">
                                <div class="img-inner">
                                    <img class="model-img" src="https://wholisticmatters.com/wp-content/uploads/2020/01/Brain-Gut-Connection@2x.png">
                                    <svg class="gated-lock" width="14" height="18.667" viewBox="0 0 14 18.667"><path class="a" d="M14.667,7.778V4.667a4.667,4.667,0,0,0-9.333,0V7.778H3V18.667H17V7.778Zm-7.778,0V4.667a3.111,3.111,0,0,1,6.222,0V7.778Z" transform="translate(-3)"/></svg>
                                </div>
                                <div class="text-inner">
                                    <span class="label">Brain-Gut Connection</span>
                                    <span class="gated">View with free account</span>
                                </div>
                            </div>
                        </div>

                        <div class="model-btn" data-src="https://human.biodigital.com/widgets/standardprocess/?m=client/standard_process/central_nervous_system.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9j0">
                            <div class="text-img-inner">
                                <div class="img-inner">
                                    <img class="model-img" src="https://wholisticmatters.com/wp-content/uploads/2020/01/Central-Nervous-System@2x.png">
                                    <svg class="gated-lock" width="14" height="18.667" viewBox="0 0 14 18.667"><path class="a" d="M14.667,7.778V4.667a4.667,4.667,0,0,0-9.333,0V7.778H3V18.667H17V7.778Zm-7.778,0V4.667a3.111,3.111,0,0,1,6.222,0V7.778Z" transform="translate(-3)"/></svg>
                                </div>
                                <div class="text-inner">
                                    <span class="label">Central Nervous System</span>
                                    <span class="gated">View with free account</span>
                                </div>
                            </div>
                        </div>

                        <div class="model-btn" data-src="https://human.biodigital.com/widgets/standardprocess/?m=client/standard_process/functional_regions_of_the_spinal_cord.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9j0">
                            <div class="text-img-inner">
                                <div class="img-inner">
                                    <img class="model-img" src="https://wholisticmatters.com/wp-content/uploads/2020/01/Functional-Regions-of-the-Spinal-Cord@2x.png">
                                    <svg class="gated-lock" width="14" height="18.667" viewBox="0 0 14 18.667"><path class="a" d="M14.667,7.778V4.667a4.667,4.667,0,0,0-9.333,0V7.778H3V18.667H17V7.778Zm-7.778,0V4.667a3.111,3.111,0,0,1,6.222,0V7.778Z" transform="translate(-3)"/></svg>
                                </div>
                                <div class="text-inner">
                                    <span class="label">Functional Regions of the Spinal Cord</span>
                                    <span class="gated">View with free account</span>
                                </div>
                            </div>
                        </div>

                        <div class="model-btn" data-src="https://human.biodigital.com/widgets/standardprocess/?m=client/standard_process/hpa_neuro_immune_axis.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9j0">
                            <div class="text-img-inner">
                                <div class="img-inner">
                                    <img class="model-img" src="https://wholisticmatters.com/wp-content/uploads/2020/01/HPA-Neuro-Immune-Axis@2x.png">
                                    <svg class="gated-lock" width="14" height="18.667" viewBox="0 0 14 18.667"><path class="a" d="M14.667,7.778V4.667a4.667,4.667,0,0,0-9.333,0V7.778H3V18.667H17V7.778Zm-7.778,0V4.667a3.111,3.111,0,0,1,6.222,0V7.778Z" transform="translate(-3)"/></svg>
                                </div>
                                <div class="text-inner">
                                    <span class="label">HPA Neuro-Immune Axis</span>
                                    <span class="gated">View with free account</span>
                                </div>
                            </div>
                        </div>

                        <div class="model-btn" data-src="https://human.biodigital.com/widgets/standardprocess/?m=client/standard_process/neuron_signaling_2.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9j0">
                            <div class="text-img-inner">
                                <div class="img-inner">
                                    <img class="model-img" src="https://wholisticmatters.com/wp-content/uploads/2020/01/Neuron-Signaling@2x.png">
                                    <svg class="gated-lock" width="14" height="18.667" viewBox="0 0 14 18.667"><path class="a" d="M14.667,7.778V4.667a4.667,4.667,0,0,0-9.333,0V7.778H3V18.667H17V7.778Zm-7.778,0V4.667a3.111,3.111,0,0,1,6.222,0V7.778Z" transform="translate(-3)"/></svg>
                                </div>
                                <div class="text-inner">
                                    <span class="label">Neuron Signaling</span>
                                    <span class="gated">View with free account</span>
                                </div>
                            </div>
                        </div>

                        <div class="model-btn" data-src="https://human.biodigital.com/widgets/standardprocess/?m=client/standard_process/neurotransmitters_in_synapse.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9j0">
                            <div class="text-img-inner">
                                <div class="img-inner">
                                    <img class="model-img" src="https://wholisticmatters.com/wp-content/uploads/2020/01/Neurotransmitters-in-Synapse@2x.png">
                                    <svg class="gated-lock" width="14" height="18.667" viewBox="0 0 14 18.667"><path class="a" d="M14.667,7.778V4.667a4.667,4.667,0,0,0-9.333,0V7.778H3V18.667H17V7.778Zm-7.778,0V4.667a3.111,3.111,0,0,1,6.222,0V7.778Z" transform="translate(-3)"/></svg>
                                </div>
                                <div class="text-inner">
                                    <span class="label">Neurotransmitters in Synapse</span>
                                    <span class="gated">View with free account</span>
                                </div>
                            </div>
                        </div>

                        <div class="model-btn" data-src="https://human.biodigital.com/widgets/standardprocess/?m=client/standard_process/parasympathetic_nervous_system.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9j0">
                            <div class="text-img-inner">
                                <div class="img-inner">
                                    <img class="model-img" src="https://wholisticmatters.com/wp-content/uploads/2020/01/Parasympathetic-Nervous-System@2x.png">
                                    <svg class="gated-lock" width="14" height="18.667" viewBox="0 0 14 18.667"><path class="a" d="M14.667,7.778V4.667a4.667,4.667,0,0,0-9.333,0V7.778H3V18.667H17V7.778Zm-7.778,0V4.667a3.111,3.111,0,0,1,6.222,0V7.778Z" transform="translate(-3)"/></svg>
                                </div>
                                <div class="text-inner">
                                    <span class="label">Parasympathetic Nervous System</span>
                                    <span class="gated">View with free account</span>
                                </div>
                            </div>
                        </div>

                        <div class="model-btn" data-src="https://human.biodigital.com/widgets/standardprocess/?m=client/standard_process/sympathetic_nervous_system.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9j0">
                            <div class="text-img-inner">
                                <div class="img-inner">
                                    <img class="model-img" src="https://wholisticmatters.com/wp-content/uploads/2020/01/Sympathetic-Nervous-System@2x.png">
                                    <svg class="gated-lock" width="14" height="18.667" viewBox="0 0 14 18.667"><path class="a" d="M14.667,7.778V4.667a4.667,4.667,0,0,0-9.333,0V7.778H3V18.667H17V7.778Zm-7.778,0V4.667a3.111,3.111,0,0,1,6.222,0V7.778Z" transform="translate(-3)"/></svg>
                                </div>
                                <div class="text-inner">
                                    <span class="label">Sympathetic Nervous System</span>
                                    <span class="gated">View with free account</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="models-inner" data-system="immune">
                        <div class="model-btn" data-src="https://human.biodigital.com/widgets/standardprocess/?m=client/standard_process/cns_inflammation.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9j0">
                            <div class="text-img-inner">
                                <div class="img-inner">
                                    <img class="model-img" src="https://wholisticmatters.com/wp-content/uploads/2020/01/Inflammation-in-the-Central-Nervous-System@2x.png">
                                    <svg class="gated-lock" width="14" height="18.667" viewBox="0 0 14 18.667"><path class="a" d="M14.667,7.778V4.667a4.667,4.667,0,0,0-9.333,0V7.778H3V18.667H17V7.778Zm-7.778,0V4.667a3.111,3.111,0,0,1,6.222,0V7.778Z" transform="translate(-3)"/></svg>
                                </div>
                                <div class="text-inner">
                                    <span class="label">Inflammation in the Central Nervous System</span>
                                    <span class="gated">View with free account</span>
                                </div>
                            </div>
                        </div>

                        <div class="model-btn" data-src="https://human.biodigital.com/widgets/standardprocess/?m=client/standard_process/inflammation_in_the_cns_role_of_microglia.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9j0">
                            <div class="text-img-inner">
                                <div class="img-inner">
                                    <img class="model-img" src="https://wholisticmatters.com/wp-content/uploads/2020/01/Inflammation-in-the-Central-Nervous-System-The-Role-of-Microglia@2x.png">
                                    <svg class="gated-lock" width="14" height="18.667" viewBox="0 0 14 18.667"><path class="a" d="M14.667,7.778V4.667a4.667,4.667,0,0,0-9.333,0V7.778H3V18.667H17V7.778Zm-7.778,0V4.667a3.111,3.111,0,0,1,6.222,0V7.778Z" transform="translate(-3)"/></svg>
                                </div>
                                <div class="text-inner">
                                    <span class="label">Inflammation in the Central Nervous System: The Role of Microglia</span>
                                    <span class="gated">View with free account</span>
                                </div>
                            </div>
                        </div>

                        <div class="model-btn" data-src="https://human.biodigital.com/widgets/standardprocess/?m=client/standard_process/resolution_pathway_and_nutrition_therapy.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9j0">
                            <div class="text-img-inner">
                                <div class="img-inner">
                                    <img class="model-img" src="https://wholisticmatters.com/wp-content/uploads/2020/01/Resolution-Pathway-Nutrition-Therapy-Omega-3-Fatty-Acids-on-the-Microglia-Part-1@2x.png">
                                    <svg class="gated-lock" width="14" height="18.667" viewBox="0 0 14 18.667"><path class="a" d="M14.667,7.778V4.667a4.667,4.667,0,0,0-9.333,0V7.778H3V18.667H17V7.778Zm-7.778,0V4.667a3.111,3.111,0,0,1,6.222,0V7.778Z" transform="translate(-3)"/></svg>
                                </div>
                                <div class="text-inner">
                                    <span class="label">Resolution Pathway and Nutrition Therapy: Omega 3 Fatty Acids on the Microglia (1)</span>
                                    <span class="gated">View with free account</span>
                                </div>
                            </div>
                        </div>

                        <div class="model-btn" data-src="https://human.biodigital.com/widgets/standardprocess/?m=client/standard_process/epigenetics.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9j0">
                            <div class="text-img-inner">
                                <div class="img-inner">
                                    <img class="model-img" src="https://wholisticmatters.com/wp-content/uploads/2020/01/Resolution-Pathway-Nutrition-Therapy-Omega-3-Fatty-Acids-on-the-Microglia-Part-2@2x.png">
                                    <svg class="gated-lock" width="14" height="18.667" viewBox="0 0 14 18.667"><path class="a" d="M14.667,7.778V4.667a4.667,4.667,0,0,0-9.333,0V7.778H3V18.667H17V7.778Zm-7.778,0V4.667a3.111,3.111,0,0,1,6.222,0V7.778Z" transform="translate(-3)"/></svg>
                                </div>
                                <div class="text-inner">
                                    <span class="label">Resolution Pathway and Nutrition Therapy: Omega 3 Fatty Acids on the Microglia (2)</span>
                                    <span class="gated">View with free account</span>
                                </div>
                            </div>
                        </div>

                        <div class="model-btn" data-src="https://human.biodigital.com/viewer/?m=client/standard_process/celiac_disease.json&ui-info=true&ui-search=true&ui-reset=true&ui-fullscreen=true&ui-nav=true&ui-tools=true&ui-help=true&ui-chapter-list=true&ui-label-list=true&ui-anatomy-descriptions=false&disable-scroll=false&uaid=4qh2v">
                            <div class="text-img-inner">
                                <div class="img-inner">
                                    <img class="model-img" src="https://wholisticmatters.com/wp-content/uploads/2020/01/Celiac-Disease@2x.png">
                                    <svg class="gated-lock" width="14" height="18.667" viewBox="0 0 14 18.667"><path class="a" d="M14.667,7.778V4.667a4.667,4.667,0,0,0-9.333,0V7.778H3V18.667H17V7.778Zm-7.778,0V4.667a3.111,3.111,0,0,1,6.222,0V7.778Z" transform="translate(-3)"/></svg>
                                </div>
                                <div class="text-inner">
                                    <span class="label">Celiac Disease</span>
                                    <span class="gated">View with free account</span>
                                </div>
                            </div>
                        </div>

                        <div class="model-btn" data-src="https://human.biodigital.com/viewer/?m=client/standard_process/rheumatoid_arthritis.json&ui-info=true&ui-search=true&ui-reset=true&ui-fullscreen=true&ui-nav=true&ui-tools=true&ui-help=true&ui-chapter-list=true&ui-label-list=true&ui-anatomy-descriptions=false&disable-scroll=false&uaid=4qh2D">
                            <div class="text-img-inner">
                                <div class="img-inner">
                                    <img class="model-img" src="https://wholisticmatters.com/wp-content/uploads/2020/01/Rheumatoid-Arthritis-RA@2x.png">
                                    <svg class="gated-lock" width="14" height="18.667" viewBox="0 0 14 18.667"><path class="a" d="M14.667,7.778V4.667a4.667,4.667,0,0,0-9.333,0V7.778H3V18.667H17V7.778Zm-7.778,0V4.667a3.111,3.111,0,0,1,6.222,0V7.778Z" transform="translate(-3)"/></svg>
                                </div>
                                <div class="text-inner">
                                    <span class="label">Rheumatoid Arthritis (RA)</span>
                                    <span class="gated">View with free account</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="models-inner" data-system="digestive">
                        <div class="model-btn" data-src="https://human.biodigital.com/widgets/standardprocess/?m=client/standard_process/digestive_health_systems_support.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9j0">
                            <div class="text-img-inner">
                                <div class="img-inner">
                                    <img class="model-img" src="https://wholisticmatters.com/wp-content/uploads/2020/01/Digestive-Health-and-Systems-Support@2x.png">
                                    <svg class="gated-lock" width="14" height="18.667" viewBox="0 0 14 18.667"><path class="a" d="M14.667,7.778V4.667a4.667,4.667,0,0,0-9.333,0V7.778H3V18.667H17V7.778Zm-7.778,0V4.667a3.111,3.111,0,0,1,6.222,0V7.778Z" transform="translate(-3)"/></svg>
                                </div>
                                <div class="text-inner">
                                    <span class="label">Digestive Health and Systems Support</span>
                                    <span class="gated">View with free account</span>
                                </div>
                            </div>
                        </div>

                        <div class="model-btn" data-src="https://human.biodigital.com/viewer/?m=client/standard_process/metabolic_regulation_of_diet_ghrelin_orexin_leptin_axis.json&ui-info=true&ui-search=true&ui-reset=true&ui-fullscreen=true&ui-nav=true&ui-tools=true&ui-help=true&ui-chapter-list=true&ui-label-list=true&ui-anatomy-descriptions=false&disable-scroll=false&uaid=4qgx7">
                            <div class="text-img-inner">
                                <div class="img-inner">
                                    <img class="model-img" src="https://wholisticmatters.com/wp-content/uploads/2020/01/Metabolic-Regulation-of-Diet-Ghrelin-Orexin-and-Leptin-Axis@2x.png">
                                    <svg class="gated-lock" width="14" height="18.667" viewBox="0 0 14 18.667"><path class="a" d="M14.667,7.778V4.667a4.667,4.667,0,0,0-9.333,0V7.778H3V18.667H17V7.778Zm-7.778,0V4.667a3.111,3.111,0,0,1,6.222,0V7.778Z" transform="translate(-3)"/></svg>
                                </div>
                                <div class="text-inner">
                                    <span class="label">Metabolic Regulation of Diet: Ghrelin, Orexin, and Leptin Axis</span>
                                    <span class="gated">View with free account</span>
                                </div>
                            </div>
                        </div>

                        <div class="model-btn" data-src="https://human.biodigital.com/viewer/?be=3HNM&ui-info=true&ui-search=true&ui-reset=true&ui-fullscreen=true&ui-nav=true&ui-tools=true&ui-help=true&ui-chapter-list=true&ui-label-list=true&ui-anatomy-descriptions=false&disable-scroll=false&uaid=4qgy0">
                            <div class="text-img-inner">
                                <div class="img-inner">
                                    <img class="model-img" src="https://wholisticmatters.com/wp-content/uploads/2020/01/Probiotics-in-the-Gut@2x.png">
                                    <svg class="gated-lock" width="14" height="18.667" viewBox="0 0 14 18.667"><path class="a" d="M14.667,7.778V4.667a4.667,4.667,0,0,0-9.333,0V7.778H3V18.667H17V7.778Zm-7.778,0V4.667a3.111,3.111,0,0,1,6.222,0V7.778Z" transform="translate(-3)"/></svg>
                                </div>
                                <div class="text-inner">
                                    <span class="label">Probiotics in the Gut</span>
                                    <span class="gated">View with free account</span>
                                </div>
                            </div>
                        </div>

                        <div class="model-btn" data-src="https://human.biodigital.com/viewer/?be=3HNQ&ui-info=true&ui-search=true&ui-reset=true&ui-fullscreen=true&ui-nav=true&ui-tools=true&ui-help=true&ui-chapter-list=true&ui-label-list=true&ui-anatomy-descriptions=false&disable-scroll=false&uaid=4qgy8">
                            <div class="text-img-inner">
                                <div class="img-inner">
                                    <img class="model-img" src="https://wholisticmatters.com/wp-content/uploads/2020/01/Prebiotics-in-the-Gut@2x.png">
                                    <svg class="gated-lock" width="14" height="18.667" viewBox="0 0 14 18.667"><path class="a" d="M14.667,7.778V4.667a4.667,4.667,0,0,0-9.333,0V7.778H3V18.667H17V7.778Zm-7.778,0V4.667a3.111,3.111,0,0,1,6.222,0V7.778Z" transform="translate(-3)"/></svg>
                                </div>
                                <div class="text-inner">
                                    <span class="label">Prebiotics in the Gut</span>
                                    <span class="gated">View with free account</span>
                                </div>
                            </div>
                        </div>

                        <div class="model-btn" data-src="https://human.biodigital.com/viewer/?be=3HNS&ui-info=true&ui-search=true&ui-reset=true&ui-fullscreen=true&ui-nav=true&ui-tools=true&ui-help=true&ui-chapter-list=true&ui-label-list=true&ui-anatomy-descriptions=false&disable-scroll=false&uaid=4qh0B">
                            <div class="text-img-inner">
                                <div class="img-inner">
                                    <img class="model-img" src="https://wholisticmatters.com/wp-content/uploads/2020/01/Irritable-Bowel-Syndrome-IBS@2x.png">
                                    <svg class="gated-lock" width="14" height="18.667" viewBox="0 0 14 18.667"><path class="a" d="M14.667,7.778V4.667a4.667,4.667,0,0,0-9.333,0V7.778H3V18.667H17V7.778Zm-7.778,0V4.667a3.111,3.111,0,0,1,6.222,0V7.778Z" transform="translate(-3)"/></svg>
                                </div>
                                <div class="text-inner">
                                    <span class="label">Irritable Bowel Syndrome (IBS)</span>
                                    <span class="gated">View with free account</span>
                                </div>
                            </div>
                        </div>

                        <div class="model-btn" data-src="https://human.biodigital.com/viewer/?be=3HNT&ui-info=true&ui-search=true&ui-reset=true&ui-fullscreen=true&ui-nav=true&ui-tools=true&ui-help=true&ui-chapter-list=true&ui-label-list=true&ui-anatomy-descriptions=false&disable-scroll=false&uaid=4qh0f">
                            <div class="text-img-inner">
                                <div class="img-inner">
                                    <img class="model-img" src="https://wholisticmatters.com/wp-content/uploads/2020/01/Crohn’s-Disease@2x.png">
                                    <svg class="gated-lock" width="14" height="18.667" viewBox="0 0 14 18.667"><path class="a" d="M14.667,7.778V4.667a4.667,4.667,0,0,0-9.333,0V7.778H3V18.667H17V7.778Zm-7.778,0V4.667a3.111,3.111,0,0,1,6.222,0V7.778Z" transform="translate(-3)"/></svg>
                                </div>
                                <div class="text-inner">
                                    <span class="label">Crohn's Disease</span>
                                    <span class="gated">View with free account</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="models-inner" data-system="endocrine">
                        <div class="model-btn" data-src="https://human.biodigital.com/widgets/standardprocess/?m=client/standard_process/endocrine_support.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9j0">
                            <div class="text-img-inner">
                                <div class="img-inner">
                                    <img class="model-img" src="https://wholisticmatters.com/wp-content/uploads/2020/01/Endocrine-Support-for-Metabolic-Systems-Response@2x.png">
                                    <svg class="gated-lock" width="14" height="18.667" viewBox="0 0 14 18.667"><path class="a" d="M14.667,7.778V4.667a4.667,4.667,0,0,0-9.333,0V7.778H3V18.667H17V7.778Zm-7.778,0V4.667a3.111,3.111,0,0,1,6.222,0V7.778Z" transform="translate(-3)"/></svg>
                                </div>
                                <div class="text-inner">
                                    <span class="label">Endocrine Support for Metabolic Systems and Response</span>
                                    <span class="gated">View with free account</span>
                                </div>
                            </div>
                        </div>

                        <div class="model-btn" data-src="https://human.biodigital.com/viewer/?m=client/standard_process/adrenal_gland_and_hormone_release.json&ui-info=true&ui-search=true&ui-reset=true&ui-fullscreen=true&ui-nav=true&ui-tools=true&ui-help=true&ui-chapter-list=true&ui-label-list=true&ui-anatomy-descriptions=false&disable-scroll=false&uaid=4qh0t">
                            <div class="text-img-inner">
                                <div class="img-inner">
                                    <img class="model-img" src="https://wholisticmatters.com/wp-content/uploads/2020/01/Adrenal-Gland-and-Hormone-Release@2x.png">
                                    <svg class="gated-lock" width="14" height="18.667" viewBox="0 0 14 18.667"><path class="a" d="M14.667,7.778V4.667a4.667,4.667,0,0,0-9.333,0V7.778H3V18.667H17V7.778Zm-7.778,0V4.667a3.111,3.111,0,0,1,6.222,0V7.778Z" transform="translate(-3)"/></svg>
                                </div>
                                <div class="text-inner">
                                    <span class="label">Adrenal Gland and Hormone Release</span>
                                    <span class="gated">View with free account</span>
                                </div>
                            </div>
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
                    src="https://human.biodigital.com/widgets/standardprocess/?m=client/standard_process/nervous_system_anatomy.json&ui-info=true&ui-zoom=true&ui-share=false&uaid=4N9hu">
            </iframe>
        </div>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>