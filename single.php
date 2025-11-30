<?php
/**
 * The template for displaying all single posts
 *
 * @package lc-iology2025
 */

defined( 'ABSPATH' ) || exit;

get_header();

$img = get_the_post_thumbnail_url( get_the_ID(), 'full' ) ?? null;

?>
<main id="main" class="blog">
    <?php
    $content = get_the_content();
    $blocks  = parse_blocks( $content );
    $sidebar = array();
    $after;
    ?>
    <div class="container-xl py-5">
        <section class="breadcrumbs">
            <?php
            if ( function_exists( 'yoast_breadcrumb' ) ) {
                yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' );
            }
            $the_date = get_the_date( 'jS F, Y' );
            ?>
        </section>
        <div class="row g-4 pb-4">
            <div class="col-lg-9 blog__content">
                <h1 class="blog__title has-purple-400-color mb-3">
                    <?= esc_html( get_the_title() ); ?></h1>
                <div class="news__meta d-flex align-items-center fs-300 mb-2">
                    <div>Posted on <?= esc_html( $the_date ); ?></div>
                </div>
                <?php
                if ( $img ) {
                    ?>
                    <img src="<?= esc_url( $img ); ?>" alt="" class="blog__image">
                    <?php
                }

                foreach ( $blocks as $block ) {
                    if ( 'core/heading' === $block['blockName'] ) {
                        if ( ! array_key_exists( 'level', $block['attrs'] ) || 2 === $block['attrs']['level'] ) {
                            $heading   = wp_strip_all_tags( $block['innerHTML'] );
                            $anchor_id = sanitize_title( $heading );
                            echo '<a id="' . esc_attr( $anchor_id ) . '" class="anchor"></a>';
                            $sidebar[ $heading ] = $anchor_id;
                        }
                    }
                    echo render_block( $block ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                }
                ?>
            </div>
            <div class="col-lg-3 related">
                <?php
                $r = new WP_Query(
                    array(
                        'post_type'      => 'post',
                        'posts_per_page' => 3,
                        'post__not_in'   => array( get_the_ID() ),
                    )
                );
                if ( $r->have_posts() ) {
                    ?>
                    <h3 class="has-purple-400-color">Related Insights</h3>
                    <?php
                    while ( $r->have_posts() ) {
                        $r->the_post();
                        ?>
                        <a class="related__card d-block mb-3"
                            href="<?= esc_url( get_the_permalink() ); ?>">
                            <?= get_the_post_thumbnail( get_the_ID(), 'small', array( 'class' => 'related__image' ) ); ?>
                            <div class="fs-300"><?= get_the_date( 'jS F, Y' ); ?></div>
                            <h3 class="fs-500 fw-600">
                                <?= esc_html( get_the_title() ); ?></h3>
                        </a>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</main>
<?php
get_footer();
