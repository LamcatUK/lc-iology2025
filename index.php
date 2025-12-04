<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();

$page_for_posts = get_option('page_for_posts');

?>
<main id="main">
    <?php
    $post = get_post($page_for_posts);

    if ($post) {
        $content = apply_filters('the_content', $post->post_content);
        echo '<div class="mb-5">' . $content . '</div>';
    }
    ?>
    <div class="container-xl pb-5">
        <?php
        $categories = get_categories([
            'hide_empty' => true, // Only include categories with posts.
            'exclude' => 1, // hide uncategorized.
        ]);

        if (!empty($categories)) {
            echo '<div class="insights__categories mb-4">';
            echo '<a href="/insights/" class="active">All</a>';
            foreach ($categories as $category) {
                echo '<a href="' . esc_url(get_category_link($category->term_id)) . '">';
                echo esc_html($category->name);
                echo '</a>';
            }
            echo '</div>';
        }

        ?>
        <div class="news_index__grid">
            <?php
            $style = 'news_index__card--first';
            $length = 50;
            $c = 'news_index__meta--first';
            while (have_posts()) {
                the_post();

                $categories = get_the_category();
            ?>
                <a href="<?= get_the_permalink() ?>"
                    class="news_index__card <?= $style ?>">
                    <div class="news_index__image">
                        <img src="<?= get_the_post_thumbnail_url(get_the_ID(), 'large') ?>"
                            alt="">
                    </div>
                    <div class="news_index__inner">
                        <h2><?= get_the_title() ?></h2>
                        <div class="smallest has-blue-400-color mb-2 d-flex align-items-center gap-2">
                            <span><i class="far fa-calendar-alt"></i> <?= get_the_date( 'j F, Y' ); ?></span>
                            <span><i class="far fa-clock"></i> <?= wp_kses_post( estimate_reading_time_in_minutes( get_the_content(), 200, true, false ) ); ?> min read</span>
                        </div>
                        <p><?= wp_trim_words(get_the_content(), $length) ?></p>
                        <div class="news_index__meta <?= $c ?>">
                            <div class="news_index__categories">
                                <?php
                                if ($categories) {
                                    foreach ($categories as $category) {
                                        if ($category->term_id == 1) {
                                            continue;
                                        }
                                ?>
                                        <span class="news_index__category"><?= esc_html($category->name) ?></span>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </a>
                <?php
                if ($c != '') {
                ?>
                    <section class="cta my-2">
                        <div class="container-xl px-5 py-4 d-flex justify-content-between align-items-center gap-4 flex-wrap">
                            <h2 class="has-h-2-font-size mb-0 mx-auto ms-md-0">Book your eye test today</h2>
                            <a href="/book-appointment/" class="btn btn-primary align-self-center mx-auto me-md-0"><span>Book an Appointment</span></a>
                        </div>
                    </section>
            <?php
                }
                $style = '';
                $c = '';
                $length = 20;
            }
            ?>
            <?= understrap_pagination() ?>
        </div>
    </div>
</main>
<?php
get_footer();
