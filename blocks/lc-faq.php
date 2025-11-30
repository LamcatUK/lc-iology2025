<?php
/**
 * FAQ Block Template.
 *
 * @package lc-iology2025
 */

defined( 'ABSPATH' ) || exit;

$acc = random_str( 8 );

if ( get_field( 'id' ) ) {
    ?>
<a id="<?= esc_attr( get_field( 'id' ) ); ?>" class="anchor"></a>
<?php
}
?>
<!-- faq -->
<section class="faq py-5">
    <div class="container-xl">
        <?php
        if (get_field('title')) {
            ?>
        <h2 class="text-center mb-4">
            <?=get_field('title')?>
        </h2>
        <?php
        }
        if (get_field('faq_introduction')) {
            ?>
        <div class="row">
            <div class="col-lg-6 offset-lg-3 mb-4 text-center">
                <?=get_field('faq_introduction')?>
            </div>
        </div>
        <?php
        }
?>
        <div itemscope="" itemtype="https://schema.org/FAQPage" id="faqs" class="accordion accordion-flush">
            <?php
            $c = 0;
while (have_rows('faq')) {
    the_row();
    ?>
            <div class="faq__card accordion-item" itemscope="" itemprop="mainEntity"
                itemtype="https://schema.org/Question">

                <div class="accordion-header" id="heading<?=$c?>">

                    <button class="accordion-button collapsed question" type="button" data-bs-toggle="collapse"
                        itemprop="name" data-bs-toggle="collapse"
                        data-bs-target="#c<?=$c?>"
                        aria-expanded="false">
                        <h3><?=get_sub_field('question')?>
                        </h3>
                </div>
                <div class="answer accordion-collapse collapse"
                    id="c<?=$c?>" itemscope="" data-bs-parent="#faqs"
                    itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <div class="answer__inner" itemprop="text">
                        <?=get_sub_field('answer')?>
                    </div>
                    <div class="d-flex justify-content-center pb-4">
                        <a href="/book-appointment/" target="" class="btn btn-primary">Book an
                            Appointment</a>
                    </div>
                </div>
            </div>
            <?php
            $c++;
}
?>
        </div>
        <?php
        if (get_field('cta')) {
            $c = get_field('cta');
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
