<?php
/**
 * Three Cards Block Template.
 *
 * @package lc-iology2025
 */

defined( 'ABSPATH' ) || exit;

$class_name = $block['className'] ?? 'mt-5';

$cards = array(
    get_field( 'card_1_title' ),
    get_field( 'card_2_title' ),
    get_field( 'card_3_title' ),
);

$card_size = 'col-md-4';

?>
<!-- cards -->
<section class="three_cards py-5 <?= esc_attr( $class_name ); ?>">
    <div class="container-xl">
        <div class="row g-4 justify-content-center">
            <?php
            if ( get_field( 'card_1_link' ) ) {
                ?>
            <div class="<?= esc_attr( $card_size ); ?>">
                <?php
                $icon = wp_get_attachment_image_url( get_field( 'card_1_icon' ), 'large' );
                $c    = get_field( 'card_1_link' );
                ?>
                <div class="card">
                    <div class="card__icon">
                        <img src="<?= esc_url( $icon ); ?>" alt="<?= esc_attr( get_field( 'card_1_title' ) ); ?>" width="267" height="150">
                    </div>
                    <div class="card__bottom">
                        <h3><?= esc_html( get_field( 'card_1_title' ) ); ?>
                        </h3>
                        <p><?= esc_html( get_field( 'card_1_body' ) ); ?></p>
                    </div>
                    <div class="card__button">
                        <a href="<?= esc_url( $c['url'] ); ?>"
                            target="<?= esc_attr( $c['target'] ); ?>"
                            class="btn btn-primary"><?= esc_html( $c['title'] ); ?></a>
                    </div>
                </div>
            </div>
                <?php
            }
            if ( get_field( 'card_2_link' ) ) {
                ?>
            <div class="<?= esc_attr( $card_size ); ?>">
                <?php
                $icon = wp_get_attachment_image_url( get_field( 'card_2_icon' ), 'large' );
                $c    = get_field( 'card_2_link' );
                ?>
                <div class="card">
                    <div class="card__icon">
                        <img src="<?= esc_url( $icon ); ?>" alt="<?= esc_attr( get_field( 'card_2_title' ) ); ?>" width="267" height="150">
                    </div>
                    <div class="card__bottom">
                        <h3><?= esc_html( get_field( 'card_2_title' ) ); ?></h3>
                        <p><?= esc_html( get_field( 'card_2_body' ) ); ?></p>
                    </div>
                    <div class="card__button">
                        <a href="<?= esc_url( $c['url'] ); ?>"
                            target="<?= esc_attr( $c['target'] ); ?>"
                            class="btn btn-primary"><?= esc_html( $c['title'] ); ?></a>
                    </div>
                </div>
            </div>
                <?php
            }
            if ( get_field( 'card_3_link' ) ) {
                ?>
            <div class="<?= esc_attr( $card_size ); ?>">
                <?php
                $icon = wp_get_attachment_image_url( get_field( 'card_3_icon' ), 'large' );
                $c    = get_field( 'card_3_link' );
                ?>
                <div class="card">
                    <div class="card__icon">
                        <img src="<?= esc_url( $icon ); ?>" alt="<?= esc_attr( get_field( 'card_3_title' ) ); ?>" width="267" height="150">
                    </div>
                    <div class="card__bottom">
                        <h3><?= esc_html( get_field( 'card_3_title' ) ); ?></h3>
                        <p><?= esc_html( get_field( 'card_3_body' ) ); ?></p>
                    </div>
                    <div class="card__button">
                        <a href="<?= esc_url( $c['url'] ); ?>"
                            target="<?= esc_attr( $c['target'] ); ?>"
                            class="btn btn-primary"><?= esc_html( $c['title'] ); ?></a>
                    </div>
                </div>
            </div>
                <?php
            }
            ?>
        </div>
        <?php
        if ( get_field( 'after_text' ) ) {
            ?>
        <div class="text-center mt-5">
            <?= esc_html( get_field( 'after_text' ) ); ?>
        </div>
            <?php
        }
        if ( get_field( 'after_cta' ) ) {
            $c = get_field( 'after_cta' );
            ?>
        <div class="text-center mt-4">
            <a href="<?= esc_url( $c['url'] ); ?>"
                target="<?= esc_attr( $c['target'] ); ?>"
                class="btn btn-primary"><?= esc_html( $c['title'] ); ?></a>
        </div>
            <?php
        }
        ?>
    </div>
</section>
