<?php

$cards = array(
    get_field('card_1_title'),
    get_field('card_2_title'),
    get_field('card_3_title')
);

$numCards = count(array_filter($cards, function ($x) {
    return !empty($x);
}));

// $cardSize = $numCards == 2 ? 'col-md-6 col-lg-3' : 'col-md-4';

$cardSize = 'col-md-4';

?>
<!-- cards -->
<section class="three_cards py-5 mt-5">
    <div class="container-xl">
        <div class="row g-4 justify-content-center">
            <?php
            if (get_field('card_1_link')) {
                ?>
            <div class="<?=$cardSize?>">
                <?php
                $icon = wp_get_attachment_image_url(get_field('card_1_icon'), 'large');
                $c = get_field('card_1_link');
                ?>
                <div class="card">
                    <div class="card__icon">
                        <img src="<?=$icon?>" alt="<?=get_field('card_1_title')?>" width="267" height="150">
                    </div>
                    <div class="card__bottom">
                        <h3><?=get_field('card_1_title')?>
                        </h3>
                        <p><?=get_field('card_1_body')?></p>
                    </div>
                    <div class="card__button">
                        <a href="<?=$c['url']?>"
                            target="<?=$c['target']?>"
                            class="btn btn-primary"><?=$c['title']?></a>
                    </div>
                </div>
            </div>
            <?php
            }
            if (get_field('card_2_link')) {
                ?>
            <div class="<?=$cardSize?>">
                <?php
                $icon = wp_get_attachment_image_url(get_field('card_2_icon'), 'large');
                $c = get_field('card_2_link');
                ?>
                <div class="card">
                    <div class="card__icon">
                        <img src="<?=$icon?>" alt="<?=get_field('card_2_title')?>" width="267" height="150">
                    </div>
                    <div class="card__bottom">
                        <h3><?=get_field('card_2_title')?></h3>
                        <p><?=get_field('card_2_body')?></p>
                    </div>
                    <div class="card__button">
                        <a href="<?=$c['url']?>"
                            target="<?=$c['target']?>"
                            class="btn btn-primary"><?=$c['title']?></a>
                    </div>
                </div>
            </div>
            <?php
            }
            if (get_field('card_3_link')) {
                ?>
            <div class="<?=$cardSize?>">
                <?php
                $icon = wp_get_attachment_image_url(get_field('card_3_icon'), 'large');
                $c = get_field('card_3_link');
                ?>
                <div class="card">
                    <div class="card__icon">
                        <img src="<?=$icon?>" alt="<?=get_field('card_3_title')?>" width="267" height="150">
                    </div>
                    <div class="card__bottom">
                        <h3><?=get_field('card_3_title')?></h3>
                        <p><?=get_field('card_3_body')?></p>
                    </div>
                    <div class="card__button">
                        <a href="<?=$c['url']?>"
                            target="<?=$c['target']?>"
                            class="btn btn-primary"><?=$c['title']?></a>
                    </div>
                </div>
            </div>
            <?php
            }
?>
        </div>
        <?php
        if (get_field('after_text')) {
            ?>
        <div class="text-center mt-5">
            <?=get_field('after_text')?>
        </div>
        <?php
        }
        if (get_field('after_cta')) {
            $c = get_field('after_cta');
            ?>
        <div class="text-center mt-4">
            <a href="<?=$c['url']?>"
                target="<?=$c['target']?>"
                class="btn btn-primary"><?=$c['title']?></a>
        </div>
        <?php
        }
?>
    </div>
</section>
