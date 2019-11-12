<?php
$data = array(
    'row_index' => get_row_index(),
    'content' => get_sub_field('content')
);

print_r($data['row']);
?>

<div class="module-basic-content my-5">
    <?php echo $data['content'] ?>
</div>
