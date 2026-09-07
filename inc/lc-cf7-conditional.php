<?php
/**
 * Conditionally load Contact Form 7 assets only when needed.
 *
 * @package lc-iology2025
 */

defined( 'ABSPATH' ) || exit;

add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

/**
 * Recursively check parsed blocks for the form.
 *
 * @param array $blocks Parsed blocks.
 * @param int   $depth Current recursion depth.
 * @return bool
 */
function lc_cf7_blocks_contain_form( $blocks, $depth = 0 ) {
	if ( ! is_array( $blocks ) || $depth > 10 ) {
		return false;
	}
	foreach ( $blocks as $block ) {
		if ( ! is_array( $block ) ) {
			continue;
		}
		$name = $block['blockName'] ?? '';
		if ( 'acf/lc-form' === $name ) {
			return true;
		}
		if ( is_string( $name ) && 0 === strpos( $name, 'contact-form-7/' ) ) {
			return true;
		}
		if ( ! empty( $block['innerHTML'] ) && is_string( $block['innerHTML'] ) && false !== strpos( $block['innerHTML'], '[contact-form-7' ) ) {
			return true;
		}
		if ( 'core/block' === $name && ! empty( $block['attrs']['ref'] ) ) {
			$ref = get_post( (int) $block['attrs']['ref'] );
			if ( $ref instanceof WP_Post && function_exists( 'parse_blocks' ) ) {
				if ( lc_cf7_blocks_contain_form( parse_blocks( $ref->post_content ), $depth + 1 ) ) {
					return true;
				}
			}
		}
		if ( ! empty( $block['innerBlocks'] ) && lc_cf7_blocks_contain_form( $block['innerBlocks'], $depth + 1 ) ) {
			return true;
		}
	}
	return false;
}

/**
 * Whether the current request needs CF7 assets.
 *
 * @return bool
 */
function lc_needs_cf7() {
	static $cached = null;
	if ( null !== $cached ) {
		return $cached;
	}
	$cached = false;
	if ( is_admin() ) {
		return $cached;
	}
	if ( ! is_singular() ) {
		return apply_filters( 'lc_needs_cf7', $cached );
	}
	$post = get_queried_object();
	if ( ! $post instanceof WP_Post ) {
		return apply_filters( 'lc_needs_cf7', $cached );
	}
	if ( has_block( 'acf/lc-form', $post ) ) {
		$cached = true;
	} elseif ( has_block( 'contact-form-7/contact-form-selector', $post ) ) {
		$cached = true;
	} elseif ( has_shortcode( $post->post_content, 'contact-form-7' ) ) {
		$cached = true;
	} elseif ( false !== strpos( $post->post_content, 'acf/lc-form' ) ) {
		$cached = true;
	} elseif ( false !== strpos( $post->post_content, '[contact-form-7' ) ) {
		$cached = true;
	} elseif ( function_exists( 'parse_blocks' ) ) {
		$cached = lc_cf7_blocks_contain_form( parse_blocks( $post->post_content ) );
	}
	return apply_filters( 'lc_needs_cf7', $cached );
}

/**
 * Remove CF7 spam-module enqueues so they can be added back conditionally.
 *
 * @return void
 */
function lc_strip_cf7_unconditional_enqueues() {
	remove_action( 'wp_enqueue_scripts', 'wpcf7_recaptcha_enqueue_scripts', 20 );
	remove_action( 'wp_enqueue_scripts', 'wpcf7_turnstile_enqueue_scripts', 10 );
}
add_action( 'wp_enqueue_scripts', 'lc_strip_cf7_unconditional_enqueues', 1 );

/**
 * Enqueue CF7 assets when the lc-form block is present.
 *
 * @return void
 */
function lc_maybe_enqueue_cf7() {
	if ( ! function_exists( 'wpcf7_enqueue_scripts' ) || ! function_exists( 'wpcf7_enqueue_styles' ) ) {
		return;
	}
	if ( ! lc_needs_cf7() ) {
		return;
	}
	wpcf7_enqueue_scripts();
	wpcf7_enqueue_styles();
	if ( function_exists( 'wpcf7_recaptcha_enqueue_scripts' ) ) {
		wpcf7_recaptcha_enqueue_scripts();
	}
	if ( function_exists( 'wpcf7_turnstile_enqueue_scripts' ) ) {
		wpcf7_turnstile_enqueue_scripts();
	}
}
add_action( 'wp_enqueue_scripts', 'lc_maybe_enqueue_cf7', 15 );
