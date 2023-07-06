const swiper = new Swiper('.product-slider', {
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
});


// перехід на сторінку про товар
const products = document.querySelectorAll('.product__card');
products.forEach(product => {
  product.addEventListener('click', e => {
    const myButton = e.currentTarget.querySelector('.btn-add-to-bag');
    const myHref = myButton.getAttribute('href');
    window.location.href = myHref;
  })
})

// кнопка вгору

const goToTop = document.querySelector('.go-to-top');

goToTop.addEventListener('click', e => {
  window.scrollTo({
      top: 0,
      left: 0,
      behavior: 'smooth'
  });
})
window.addEventListener('scroll', e => {
  if (window.scrollY > 0) {
      goToTop.classList.remove('hide');
  } else {
      goToTop.classList.add('hide');

  }
});