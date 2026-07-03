<?php
/**
 * Three Cards Block Template.
 *
 * @package lc-iology2025
 */

defined( 'ABSPATH' ) || exit;

$class_name = $block['className'] ?? 'mt-5';
$data    = $block['data'] ?? array();
$show_bg = isset( $data['show_background'] ) ? (bool) $data['show_background'] : true;

// Count how many cards are defined (based on title).
$card_count = 0;
for ( $i = 1; $i <= 5; $i++ ) {
	$title = $data[ 'card_' . $i . '_title' ] ?? '';
	if ( $title ) {
		++$card_count;
	}
}

// Determine card size based on count.
$card_sizes = array(
	1 => 'col-md-6',
	2 => 'col-md-6',
	3 => 'col-md-4',
	4 => 'col-md-3',
	5 => 'col-md-2',
);
$card_size  = $card_sizes[ $card_count ] ?? 'col-md-4';

?>
<!-- cards -->
<section class="three_cards py-5 <?= esc_attr( $class_name ); ?><?= $show_bg ? '' : ' no-bg'; ?>">
	<div class="container-xl">
		<div class="row g-4 justify-content-center">
			<?php
			for ( $i = 1; $i <= 5; $i++ ) {
				$title = $data[ 'card_' . $i . '_title' ] ?? '';
				$body  = $data[ 'card_' . $i . '_body' ] ?? '';
				$link  = $data[ 'card_' . $i . '_link' ] ?? '';
				$icon_id = $data[ 'card_' . $i . '_icon' ] ?? null;
				$icon    = $icon_id ? wp_get_attachment_image_url( $icon_id, 'large' ) : '';

				if ( ! $title && ! $body && ! $link && ! $icon_id ) {
					continue;
				}

				// For 5 cards: first 3 are col-md-4, last 2 are col-md-6.
				if ( 5 === $card_count ) {
					$current_card_size = ( $i <= 3 ) ? 'col-md-4' : 'col-md-6';
				} else {
					$current_card_size = $card_size;
				}
				?>
			<div class="<?= esc_attr( $current_card_size ); ?>">
				<div class="card">
					<?php if ( $icon ) { ?>
					<div class="card__icon">
						<img src="<?= esc_url( $icon ); ?>" alt="<?= esc_attr( $title ); ?>" width="267" height="150">
					</div>
					<?php } ?>
					<div class="card__bottom">
						<h3><?= esc_html( $title ); ?></h3>
						<?php if ( $body ) { ?>
						<p><?= esc_html( $body ); ?></p>
						<?php } ?>
					</div>
					<?php if ( $link && ! empty( $link['url'] ) ) { ?>
					<div class="card__button">
						<a href="<?= esc_url( $link['url'] ); ?>"
							target="<?= esc_attr( $link['target'] ); ?>"
							class="btn btn-primary"><?= esc_html( $link['title'] ); ?></a>
					</div>
					<?php } ?>
				</div>
			</div>
				<?php
			}
			?>
		</div>
		<?php
		$after_text = get_field( 'after_text' );
		if ( $after_text ) {
			?>
		<div class="text-center mt-5">
			<?= esc_html( $after_text ); ?>
		</div>
			<?php
		}
		$after_cta = get_field( 'after_cta' );
		if ( $after_cta ) {
			?>
		<div class="text-center mt-4">
			<a href="<?= esc_url( $after_cta['url'] ); ?>"
				target="<?= esc_attr( $after_cta['target'] ); ?>"
				class="btn btn-primary"><?= esc_html( $after_cta['title'] ); ?></a>
		</div>
			<?php
		}
		?>
	</div>
</section>
