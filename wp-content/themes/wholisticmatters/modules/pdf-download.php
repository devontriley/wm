<?php
$data = array(
    'header' => get_sub_field('header'),
    'subheader' => get_sub_field('subheader'),
    'copy' => get_sub_field('copy'),
    'image' => get_sub_field('image'),
    'text' => get_sub_field('text'),
    'pdf_download' => get_sub_field('pdf_download')
);

$pdf = wp_get_attachment_url($data['pdf_download']);
?>

<?php if($data['image']) {

    $imageSrc = $data['image']['url'];
    $imageAlt = $data['image']['alt']; ?>

    <div class="module-pdf-download card my-5">
        <div class="row no-gutters">
            <div class="col">
                <div class="card-body">
                    <?php if($data['header']){ ?><p class="h3 card-title"><?php echo $data['header'] ?></p><?php } ?>
                    <?php if($data['subheader']){ ?><p class="card-subheader"><?php echo $data['subheader'] ?></p><?php } ?>
                    <?php if($data['copy']){ ?><p class="card-text"><?php echo $data['copy'] ?></p><?php } ?>
                    <a href="<?php echo $pdf ?>" class="btn btn-primary" target="_blank" rel="noopener noreferrer"><?php echo $data['text'] ?></a>
                </div>
            </div>
            <div class="col-auto image">
                <div class="card-body">
                    <img src="<?php echo $imageSrc ?>" alt="<?php echo $imageAlt ?>" />
                </div>
            </div>
        </div>
    </div>

<?php } ?>

<?php if(!$data['image']) { ?>

    <div class="module-pdf-download simple card my-5">
        <div class="row no-gutters d-block d-md-flex align-items-center">
            <div class="col">
                <div class="card-body">
                    <?php if($data['header']){ ?><p class="h3 card-title"><?php echo $data['header'] ?></p><?php } ?>
                    <?php if($data['subheader']){ ?><p class="card-subheader"><?php echo $data['subheader'] ?></p><?php } ?>
                    <?php if($data['copy']){ ?><p class="card-text"><?php echo $data['copy'] ?></p><?php } ?>
                </div>
            </div>
            <div class="col-auto btn-container">
                <div class="card-body">
                    <a href="<?php echo $pdf ?>" class="btn btn-primary" target="_blank" rel="noopener noreferrer"><?php echo $data['text'] ?></a>
                </div>
            </div>
        </div>
    </div>

<?php } ?>
