<?php
/**
 * The main template file
 *
 * @package lc-iology2025
 */

defined( 'ABSPATH' ) || exit;

$page_for_posts = get_option( 'page_for_posts' );
$bg             = get_the_post_thumbnail_url( $page_for_posts, 'full' );

get_header();

?>
<main id="main">
    <?php
    $post_page = get_post( $page_for_posts );

    if ( $post_page ) {
        $content = apply_filters( 'the_content', $post_page->post_content );
        echo '<div class="mb-5">' . wp_kses_post( $content ) . '</div>';
    }
    ?>
    <div class="container-xl pb-5">
        <div class="news">
            <?php

            // Setup the query arguments.
            $args = array(
                'post_type'      => 'post',
                'post_status'    => 'publish',
                'posts_per_page' => -1,
            );

            $query = new WP_Query( $args );

            if ( $query->have_posts() ) {
                while ( $query->have_posts() ) {
                    $query->the_post();
                    $the_date = get_the_date( 'jS F, Y' );
                    ?>
                    <a href="<?= esc_url( get_the_permalink() ); ?>" class="news__card mb-4 p-3 d-block text-decoration-none text-dark">
                        <div class="row">
                            <div class="col-md-3">
                                <?= get_the_post_thumbnail( get_the_ID(), 'large', array( 'class' => 'news__img' ) ); ?>
                            </div>
                            <div class="col-md-9">
                                <h2 class="fs-600 has-purple-400-color mb-2">
                                    <?= esc_html( get_the_title() ); ?>
                                </h2>
                                <div class="news__meta d-flex align-items-center fs-300">
                                    <div>Posted on <?= esc_html( $the_date ); ?></div>
                                </div>
                                <div class="news__excerpt text-grey-900 mb-2">
                                    <?= wp_kses_post( wp_trim_words( get_the_content(), 40 ) ); ?>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php
                }
            } else {
                echo 'No posts found.';
            }

            wp_reset_postdata();
            ?>
        </div>
    </div>
</main>
<?php

get_footer();
?>