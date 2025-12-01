<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package lc-iology
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

wp_footer();

if ( get_field( 'gtm_property', 'options' ) ) {
    ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe
        src="https://www.googletagmanager.com/ns.html?id=<?= esc_attr( get_field( 'gtm_property', 'options' ) ); ?>"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    <?php
}
?>
</body>
</html>