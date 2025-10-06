

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

$(function () { // if document is ready
  // alert('hello world')
});

document.getElementById("id") != null

$.post('/unfollow', { id: userId }, function (response) {
  $('#follow-button').text('フォロー');
});
