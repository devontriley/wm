<?php

$counter = 0;

if(have_rows('modules')) :

    echo '<div class="modules-container">';

    while(have_rows('modules')) :
        the_row();

        echo '<div id="module-'.$counter.'">';

        switch(get_row_layout()){
            case 'basic_content':
                include(__DIR__ . '/modules/basic-content.php');
                break;

            case 'accordion':
                include(__DIR__ . '/modules/accordion.php');
                break;

            case 'pdf_download':
                include(__DIR__ . '/modules/pdf-download.php');
                break;

            case 'related_content':
                include(__DIR__ . '/modules/related-content.php');
                break;

            case 'subscribe':
                include(__DIR__ . '/modules/subscribe.php');
                break;
        }

        $counter++;

        echo '</div>';

    endwhile;

    echo '</div>';
endif;

?>