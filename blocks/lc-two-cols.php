<?php
/**
 * Two Columns Block
 *
 * @package LC-iology2025
 */

defined( 'ABSPATH' ) || exit;

$feature = 'Yes' === get_field( 'featured' )[0] ? 'card--featured' : '';
?>
<!-- two_cols -->
<section class="two_cols">
	<div class="container-xl">
		<div class="row g-4">
			<div class="col-md-8">
				<div class="card">
					<?= get_field( 'left_content' ); ?>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card <?= $feature; ?>">
					<?= get_field( 'right_content' ); ?></div>
			</div>
		</div>
	</div>
</section>
