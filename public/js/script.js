

document.addEventListener("DOMContentLoaded", function () {
  const menuItems = document.querySelectorAll(".js-menu");

  function toggleAccordion() {
    const content = this.nextElementSibling;
    const arrow = this.querySelector(".arrow");

    if (!content) return;

    this.classList.toggle("is-active");
    content.classList.toggle("is-open");
    arrow.classList.toggle("rotate");
  }

  menuItems.forEach((item) => item.addEventListener("click", toggleAccordion));
});

// $(function () {
//   $('.accordion-content.is-open').on('click', function (e) {
//     e.stopPropagation();
//   })
// });

document.getElementById("id") != null



// 投稿編集モーダル
$(function () {
  $('.modal_open').on('click', function () {
    $('.modal_main').fadeIn();
    var post = $(this).attr('post');
    var post_id = $(this).attr('post_id');
    $('.modal_text').text(post);
    $('.modal_id').val(post_id);
    return false;
  });
  $('.modal_main').on('click', function () {
    $('.modal_main').fadeOut();
    return false;
  });
  $('.modal_inner').on('click', function (e) {
    e.stopPropagation();
  })
});
