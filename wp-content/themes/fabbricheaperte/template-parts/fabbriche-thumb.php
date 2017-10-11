<?php
$style = '';
$thumb_id = get_post_thumbnail_id();
$thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true);
if ($thumb_id) {
	$style = 'style="background: url('.$thumb_url[0].');background-size: cover;"';
}
?>

<a href="<?= get_permalink() ?>">
	<div class="page-item" <?= $style ?>>
		<p>↓</p>
		<p><?= get_the_title() ?></p>
	</div>
</a>