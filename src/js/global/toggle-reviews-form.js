jQuery(document).ready(function($) {
  const button = $('.toggle-reviews-form');
  if(!button.length) return;
  const form = $('.review-form-wrapper');

  button.on('click', function () {
      form.slideToggle();
  })
})




