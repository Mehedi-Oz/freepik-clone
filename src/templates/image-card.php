<?php

/**
 * Image Card Template
 * Reusable template for displaying image cards
 *
 * @param array $image Image data array with keys: id, title, view_thumb_img
 */
if (!isset($image) || !is_array($image)) {
  return;
}

// Validate and sanitize
$imageId = filter_var($image['id'], FILTER_VALIDATE_INT);
if ($imageId === false) {
  $imageId = 0;
}

$thumbImg = htmlspecialchars($image['view_thumb_img'], ENT_QUOTES, 'UTF-8');
$title = htmlspecialchars($image['title'], ENT_QUOTES, 'UTF-8');
?>

<div class="image-card relative group mb-4" data-image="<?php echo $imageId; ?>">
  <img src="https://cdn.pixahunt.com/<?php echo $thumbImg; ?>"
    class="rounded-lg w-full"
    alt="<?php echo $title; ?>"
    loading="lazy">
</div>
