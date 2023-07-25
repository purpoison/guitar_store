const bagCounter = document.querySelector('.bag-counter');
const storedValues = localStorage.getItem("cart"); 
window.onload = e => {
  if(storedValues){
    parsedValues = JSON.parse(storedValues);
    bagCounter.textContent = parsedValues.length;
  }
};


// product slider

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

// page btn for pagination
let urlString = document.location.search;
let pageId = urlString.split('=').pop();
let current_btn = document.getElementById(pageId);
if(current_btn){
    current_btn.classList.add('active-page');
}

//menu active
const menuBtns = document.querySelectorAll('.menu__link');
menuBtns.forEach(el => {
  let linkHref =   el.getAttribute('href');
  if(linkHref == urlString){
    el.classList.add('active__link');
  }
})

// filter block
const filterWrap = document.querySelector('.filters form');
const showFiltersBtn = document.querySelector('.show-filters');

function showMore(elem, btn){
    btn.classList.remove('hidden');
    btn.addEventListener('click', e => {
      e.preventDefault();
      elem.style.height = "auto";
      btn.classList.add('hidden');
    })
  }

if(filterWrap) showMore(filterWrap, showFiltersBtn);


//popup init
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


// bag logic
const mainBag = document.querySelector('.bag');
initializePopup('.bag', '.bag-btn', '.bag .popup__close');

const signInBtn = document.querySelectorAll('.sign-in');
const signUPForm = document.querySelector('.sign-up-form');
const signInForm = document.querySelector('.sign-in-form');
const createAccBtn = document.querySelector('.create-acc');
const closePopup = document.querySelectorAll('.registration .popup__close');
const popup = document.querySelector('.registration');

signInBtn.forEach(btn => {
  btn.addEventListener('click', e => {
    mainBag.classList.remove('popup__open');
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



//add to cart
const addTobagBtns = document.querySelectorAll('.btn-add-to-bag');
const bagWrap = document.querySelector('.bagcards-wrap')
const bagfooter = document.querySelector('.bag__footer');
const cardMessage = document.querySelector('.card-message');
const totalAmount = document.querySelector('.total-price');


if(addTobagBtns){
  addTobagBtns.forEach(btn => {
    btn.addEventListener('click', e => {
      e.preventDefault();
      // let value = e.currentTarget.dataset.productid;   
      bagCounter.textContent = Number(bagCounter.textContent)+1;
    })
  })
}


// add to localstorage
// localStorage.clear();
function cartLSadd(value) {
  const storedValues = localStorage.getItem("cart");
  if (storedValues === null) {
    localStorage.setItem("cart", JSON.stringify([value]));
  } 
  else {
    const parsedValues = JSON.parse(storedValues);
    parsedValues.push(value);
    localStorage.setItem('cart', JSON.stringify(parsedValues));
  }
}

// showbag
const bagbtn = document.querySelector('.bag-btn');
bagbtn.addEventListener('click', e => {
  const itemsfromStorage = localStorage.getItem("cart");
  const arrayFromLS = JSON.parse(itemsfromStorage);
  if(arrayFromLS.length){
    let total = 0;
    arrayFromLS.forEach(value => {
      let bagCard = createbagCard(value);
      bagWrap.append(bagCard);
      total+=Number(value['price']);
    })
    totalAmount.textContent = total;
    bagfooter.classList.remove('hidden');
    cardMessage.classList.add('hidden');
  }
  //delete from bag
  const deleteBtn = document.querySelectorAll('.bag-delete');
    if(deleteBtn){
      let counter = deleteBtn.length;
      deleteBtn.forEach(btn => {
        btn.addEventListener('click', e => {
          counter--;
          e.preventDefault();
          let parrent = e.currentTarget.parentElement.parentElement;
          parrent.remove();

          // delete from localstorage
          let indextoDelete = e.currentTarget.dataset.localindex;
          const storedValues = localStorage.getItem("cart");
          const parsedValues = JSON.parse(storedValues);
          const ToDelete = parsedValues.findIndex(item => item.id === Number(indextoDelete));
          let price = parsedValues[ToDelete].price;
          parsedValues.splice(ToDelete, 1);
          localStorage.setItem('cart', JSON.stringify(parsedValues));

          // let price = e.currentTarget.dataset.price;
          totalAmount.textContent = Number(totalAmount.textContent) - Number(price);
          bagCounter.textContent = Number(bagCounter.textContent)-1;
          if(!counter){
            bagfooter.classList.add('hidden');
            cardMessage.classList.remove('hidden');
          }
        });
      });
    }
})

//create product card for bag
function createbagCard(data){
  let div = document.createElement('div');
  div.classList.add('bag__card');
  div.innerHTML = `
    <div class='bag__content' data-productid='${data['id']}'>
        <div class='bag__img'>
            <img src='${data['img_path']}' alt='${data['name']}'>
        </div>
        <div class='bag__description'>
            <div class='card-body'>
                <a href='?page=product&product_id=${data['id']}' class='bag-card-title'>${data['name']}</a>
                <p class='card-text red'>$ ${data['price']}</p>
            </div>
        </div>
        <a href="#" class='bag-delete' data-localIndex=${data['id']}><img src='../img/delete.png' alt='delete'></a>
    </div>`;
return div;
}

// mobile menu
const mobileBtn = document.querySelector('.mobile-menu-btn');
const mainMenu = document.querySelector('.main-menu');

mobileBtn.addEventListener('click', e => {
  mainMenu.classList.toggle('menu-open');
  mobileBtn.classList.toggle('active');
});

// checkbox validation
const filtersForm = document.querySelector('.filters-form');
const filtersCheckboxes = document.querySelectorAll('.filter__content-list input[type="checkbox"]');

if(filtersForm){
  inputValidation(filtersCheckboxes, filtersForm, 'Please select at least one filter')
}

// radio validation
const addReviewForm = document.querySelector('.add-review__form');
const radioRating = document.querySelectorAll('.review-rating-radio input[type="radio"]');
if(addReviewForm){
  inputValidation(radioRating, addReviewForm, 'Please select a rating');
}

// validation function
function inputValidation(inputs, form, text){
  form.addEventListener('submit', e => {
    let isChecked = false;
    for(let i = 0; i < inputs.length; i++){
      if(inputs[i].checked){
        isChecked = true;
        break;
      }
    }
    if (!isChecked) {
      e.preventDefault();
      alert(text);
    }
  }) 
}


// add review appearance
const addReviewBtn = document.querySelector('.write-review-btn');
const reviewForm = document.querySelector('.add-review__form');
if(addReviewBtn){
  addReviewBtn.addEventListener('click', e => {
    e.preventDefault();
    reviewForm.classList.remove('hidden');
    reviewForm.style.marginTop = 0;
    addReviewBtn.classList.add('hidden');
  })
}