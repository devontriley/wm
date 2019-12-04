<?php
$data = array(
    'row_index' => get_row_index(),
    'header' => get_sub_field('header'),
    'items_header' => get_sub_field('items_header'),
    'items' => get_sub_field('accordion_items')
);
?>

<div id="module-row-<?php echo $data['row_index'] ?>" class="module-accordion my-5">
    <?php if($data['header']) { ?>
        <h2><?php echo $data['header']; ?></h2>
    <?php } ?>

    <div class="accordion" id="accordion-<?php echo $data['row_index']; ?>">

        <?php if($data['items_header']) { ?>
            <div class="card">
                <div class="card-header no-expand">
                    <?php echo $data['items_header'] ?>
                </div>
            </div>
        <?php } ?>

        <?php foreach($data['items'] as $k => $v) { ?>

            <div class="card">
                <div class="card-header">
                    <p class="mb-0" data-toggle="collapse" data-target="#collapse-<?php echo $k ?>" aria-expanded="false" aria-controls="collapse-<?php echo $k ?>">
                        <?php echo $v['header'] ?>
                    </p>
                </div>

                <div id="collapse-<?php echo $k ?>" class="collapse" aria-labelledby="heading<?php echo $k ?>" data-parent="#accordion-<?php echo $data['row_index']; ?>">
                    <div class="card-body">
                        <?php echo $v['copy'] ?>
                    </div>
                </div>
            </div>

        <?php } ?>

    </div>
</div>
