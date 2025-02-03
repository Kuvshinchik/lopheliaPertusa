// Утилиты

function toNum(str) {
  const num = Number(str.replace(/ /g, ""));
  return num;
}

function toCurrency(num) {
  const format = new Intl.NumberFormat("ru-RU", {
    style: "currency",
    currency: "RUB",
    minimumFractionDigits: 0,
  }).format(num);
  return format;
}


// Корзина
//возвращает массив все кнопок "В корзину"
const cardAddArr = Array.from(document.querySelectorAll(".card__add"));
//console.log(cardAddArr);
//возвращает количество товаров в корзине из кнопки с рисунком черной корзины
const cartNum = document.querySelector("#cart_num");
//возвращает всю кнопку с рисунком черной корзины
const cart = document.querySelector("#cart");

class Cart {
	//объявляем переменную products и присваиваем ей через конструктор пустой массив, тем самым определяем тип данных
  products;
  constructor() {
    this.products = [];
  }
//возвращает длину массива  products 
  get count() {
    return this.products.length;
  }
//при добавлении в корзину передается через аргумент свойства добавляемого продукта и добавляется в общий массив products  
  addProduct(product) {
    this.products.push(product);
  }
 //удаление продукта из общего массива 
  removeProduct(index) {
    this.products.splice(index, 1);
  }
 //стоимость 
  get cost() {
    const prices = this.products.map((product) => {
      return toNum(product.price);
    });
    const sum = prices.reduce((acc, num) => {
      return acc + num;
    }, 0);
    return sum;
  }
  //стоимость и дискаунт
  get costDiscount() {
    const prices = this.products.map((product) => {
      return toNum(product.priceDiscount);
    });
    const sum = prices.reduce((acc, num) => {
      return acc + num;
    }, 0);
    return sum;
  }
  //дискаунт
  get discount() {
    return this.cost - this.costDiscount;
  }
}

//собираем данные из де-факто корзины, если она имеется в браузере
class Product {
  imageSrc;
  name;
  price;
  priceDiscount;
  constructor(card) {
    this.caption = card.querySelector(".card__caption").innerText;
    this.name = card.querySelector(".card__title").innerText;
    this.price = card.querySelector(".card__price--common").innerText;
	this.imageSrc = document.querySelector(".card__image").src;
/*    this.priceDiscount = card.querySelector(".card__price--discount").innerText;
	this.imageSrc = card.querySelector(".card__image").children[0].src;
	*/
  }
}


const myCart = new Cart();
//если корзина не существует, то создаем ее
if (localStorage.getItem("cart") == null) {
  localStorage.setItem("cart", JSON.stringify(myCart));
}

const savedCart = JSON.parse(localStorage.getItem("cart"));
myCart.products = savedCart.products;
cartNum.textContent = myCart.count;

myCart.products = cardAddArr.forEach((cardAdd) => {
  cardAdd.addEventListener("click", (e) => {
    e.preventDefault();
    const card = e.target.closest(".card");
    const product = new Product(card);
    const savedCart = JSON.parse(localStorage.getItem("cart"));
    myCart.products = savedCart.products;
    myCart.addProduct(product);
    localStorage.setItem("cart", JSON.stringify(myCart));
    cartNum.textContent = myCart.count;
  //console.log(JSON.parse(localStorage.getItem("cart")));
  
  });
});

// Функция для отображения товаров в корзине
function renderCart(myCart) {
	const cartDropdown = document.querySelector('.cart-dropdown');
	const parentCart = document.querySelector('#parentCart');
	const savedCart = JSON.parse(localStorage.getItem("cart"));
	//const myCart = new Cart();
	//myCart.products = savedCart.products;
	
	const tableStroki = `<tr>
                    <td class="product-thumb">
					<a href="#">
					<img src="#"
                    alt="cart-hover-1"/>
					</a>
					</td>
                    <td>
					<a 
					title="${savedCart.products[0]['caption']}" 
					href="#">
					${savedCart.products[0]['caption']}
					</a>
					</td>
                     
                    <td>${savedCart.products[0]['price']} ₽</td>
                    <td>
					<a title="close" href="#">
					<i class="fa fa-close">
					</i>
					</a>
					</td>
                </tr>`;
	
	parentCart.textContent = tableStroki;
	console.log(77777);		
	
	
}
renderCart(myCart);
