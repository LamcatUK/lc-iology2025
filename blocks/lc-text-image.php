<?php
/**
 * Block template for LC Text Image.
 *
 * @package lc-iology2025
 */

defined( 'ABSPATH' ) || exit;

$order_image = ( 'text image' === get_field( 'order' ) ) ? 'order-1 order-lg-2' : 'order-1 order-lg-1';
$order_text  = ( 'text image' === get_field( 'order' ) ) ? 'order-2 order-lg-1' : 'order-2 order-lg-2';
$split       = get_field( 'split' ) ? get_field( 'split' ) : '8:4';
$text_col    = ( '6:6' === $split ) ? 'col-md-6' : 'col-md-8';
$image_col   = ( '6:6' === $split ) ? 'col-md-6' : 'col-md-4';
?>
<section class="text_image mb-4">
	<div class="container-xl">
		<div class="row g-4">
			<div class="<?= esc_attr( $text_col ); ?> <?= esc_attr( $order_text ); ?>">
				<div class="card">
					<?= wp_kses_post( get_field( 'text_content' ) ); ?>
				</div>
			</div>
			<div class="<?= esc_attr( $image_col ); ?> <?= esc_attr( $order_image ); ?>">
				<div class="card-image">
					<?= wp_get_attachment_image( get_field( 'image' ), 'full' ); ?>
				</div>
			</div>
		</div>
	</div>
</section>
