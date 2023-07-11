const swiper = new Swiper('.product-slider', {
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
});

const body = document.querySelector('body');

// go to product detales
const products = document.querySelectorAll('.product__card');
products.forEach(product => {
  product.addEventListener('click', e => {
    const myHref = e.currentTarget.dataset.href;
    if(!e.target.classList.contains('btn')){
      window.location.href = myHref;
      
    }
  })
})

// up button

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

// page btn

let urlString = document.location.search;
let pageId = urlString.split('=').pop();
let current_btn = document.getElementById(pageId);
if(current_btn){
    current_btn.classList.add('active-page');
}

// filter block

const filterWrap = document.querySelector('.filters form');
const showFiltersBtn = document.querySelector('.show-filters');

function showMore(elem, btn){
  if(elem.offsetHeight > 1000){
    elem.style.height = "650px";
    elem.style.overflow = "hidden";
    btn.classList.remove('hidden');
    btn.addEventListener('click', e => {
      e.preventDefault();
      elem.style.height = "auto";
      btn.classList.add('hidden');
    })
  }
}

if(filterWrap) showMore(filterWrap, showFiltersBtn);

function initializePopup(popupSelector, buttonSelector, closeSelector) {
  let close = document.querySelector(closeSelector);
  let popup = document.querySelector(popupSelector);
  let btn = document.querySelector(buttonSelector);
  btn.addEventListener('click', e => {
    e.preventDefault();
    body.style.overflow = 'hidden';
    popup.classList.add('popup__open');
  });

  close.addEventListener('click', c => {
    popup.classList.remove('popup__open');
      body.style.overflow = 'auto';
  });

  document.addEventListener('click', el => {
    if (el.target.classList.contains('popup__body')) {
        popup.classList.remove('popup__open');
        body.style.overflow = 'auto';
      }
  });
};

initializePopup('.bag', '.bag-btn', '.bag .popup__close');

const signInBtn = document.querySelectorAll('.sign-in');
const signUPForm = document.querySelector('.sign-up-form');
const signInForm = document.querySelector('.sign-in-form');
const createAccBtn = document.querySelector('.create-acc');
const closePopup = document.querySelectorAll('.registration .popup__close');
const popup = document.querySelector('.registration');

signInBtn.forEach(btn => {
  btn.addEventListener('click', e => {
    e.preventDefault();
    body.style.overflow = 'hidden';
    popup.classList.add('popup__open');
    closePopup.forEach(close => {
      close.addEventListener('click', c => {
        popup.classList.remove('popup__open');
          body.style.overflow = 'auto';
          const inputs = document.querySelectorAll('.popup input');
          inputs.forEach(input => {
              input.value = '';
          })
          signUPForm.classList.add('hidden');
          signInForm.classList.remove('hidden');
      })
    })

    document.addEventListener('click', el => {
        if (el.target.classList.contains('popup__body')) {
            popup.classList.remove('popup__open');
            body.style.overflow = 'auto';
            signUPForm.classList.add('hidden');
            signInForm.classList.remove('hidden');
            const inputs = document.querySelectorAll('.popup input');
            inputs.forEach(input => {
                input.value = '';
            })
        }
    });
  })
})


//sign up

createAccBtn.addEventListener('click', e => {
  e.preventDefault();
  signUPForm.classList.remove('hidden');
  signInForm.classList.add('hidden');
})

const addTobagBtns = document.querySelectorAll('.btn-add-to-bag');
console.log(addTobagBtns);
if(addTobagBtns){
  addTobagBtns.forEach(btn => {
    btn.addEventListener('click', e => {
      e.preventDefault();
    })
  })
}