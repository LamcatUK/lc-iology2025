<?php
$order_image = (get_field('order') == 'text image') ? 'order-1 order-lg-2' : 'order-1 order-lg-1';
$order_text = (get_field('order') == 'text image') ? 'order-2 order-lg-1' : 'order-2 order-lg-2';
?>
<section class="text_image mb-4">
    <div class="container-xl">
        <div class="row g-4">
            <div class="col-md-8 <?=$order_text?>">
                <div class="card">
                    <?=get_field('text_content')?>
                </div>
            </div>
            <div class="col-md-4 <?=$order_image?>">
                <div class="card-image">
                    <?=wp_get_attachment_image(get_field('image'), 'full')?>
                </div>
            </div>
        </div>
    </div>
</section>
