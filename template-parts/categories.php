<?php

$args = array(
  'taxonomy'     => 'product_cat',
  'orderby'      => 'name',
  'order'        => 'ASC',
  'hide_empty'   => true,
  'parent'       => 0,
);

$product_categories = get_terms($args);

if (! empty($product_categories) && ! is_wp_error($product_categories)) :
?>
  <section class="mt-6  mb-6 mt-5-mobile categories-selection">
    <div class="wrapper">
      <div class="categories-grid">
        <?php foreach ($product_categories as $category) :

          if ($category->slug === 'uncategorized' || $category->slug === 'bez-kategorii') {
            continue;
          }
          $category_link = get_term_link($category);
          $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
          if ($thumbnail_id) {
            $image_url = wp_get_attachment_image_url($thumbnail_id, 'medium');
          } else {
            $image_url = wc_placeholder_img_src();
          }
        ?>

          <a href="<?php echo esc_url($category_link); ?>" class="category-item">
            <div class="category-image-wrapper">
              <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($category->name); ?>" loading="lazy">
            </div>
            <div class="category-info">
              <h3 class="category-title"><?php echo esc_html($category->name); ?></h3>
            </div>
          </a>

        <?php endforeach; ?>
      </div>
    </div>
  </section>
<?php
endif;
?>