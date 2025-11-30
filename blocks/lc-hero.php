<?php
// $margin = get_field('show_banner', 'options')[0] == 'Yes' ? '' : 'mb-5';

$l = get_field('banner_link', 'options');
$margin = '';
if (is_array($l) && isset($l['url']) && is_page(basename($l['url']))) {
    $margin = 'mb-5';
}
?>
<!-- hero -->
<section class="hero <?=$margin?>"
    style="background-image:url(<?=wp_get_attachment_image_url(get_field('background'), 'full')?>)">
    <div class="container-xl h-100">
        <div class="row h-100 mx-0">
            <div class="col-md-7 my-auto">
                <h1><?=get_field('title')?></h1>
                <h2 class="mb-4">
                    <?=get_field('subtitle')?>
                    </h1>
                    <?php
                if (get_field('cta1')) {
                    $c = get_field('cta1');
                    $style = get_field('cta1_primary') ? 'btn-primary' : 'btn-secondary';
                    ?>
                    <a href="<?=$c['url']?>"
                        target="<?=$c['target']?>"
                        class="btn <?=$style?> me-2 mb-2"><?=$c['title']?></a>
                    <?php
                }
                if (get_field('cta2')) {
                    $style = get_field('cta2_primary') ? 'btn-primary' : 'btn-secondary';
                    $c = get_field('cta2');
                    ?>
                    <a href="<?=$c['url']?>"
                        target="<?=$c['target']?>"
                        class="btn <?=$style?> mb-2"><?=$c['title']?></a>
                    <?php
                }
?>
            </div>
        </div>
    </div>
</section>
<?php

// echo '<pre>show : ' . get_field('show_banner', 'options')[0] . '</pre>';

if (get_field('show_banner', 'options')[0] == 'Yes') {
    $show_banner = true;
    if (is_array($l) && isset($l['url']) && is_page(basename($l['url']))) {
        $show_banner = false;
    }
    
    if ($show_banner) {
        ?>
<!-- banner -->
<section class="banner py-1 mb-5">
    <a href="<?= is_array($l) && isset($l['url']) ? $l['url'] : '#' ?>">
        <div class="container-xl text-center d-md-flex justify-content-center align-items-center">
            <div class="banner__content">
                <?=get_field('banner_text', 'options')?>
            </div>
        </div>
    </a>
</section>
<?php
    }
}
?>
