/*
To implement the JavaScript code that corresponds to the provided Blade template, we need to create a block that dynamically renders the cart content based on the `myCart` object. We'll create a function that generates the HTML for the cart dropdown and updates it when the cart changes. Here's the implementation:

```javascript
Чтобы реализовать JavaScript-код, соответствующий предоставленному шаблону Blade, нам нужно создать блок, который динамически отображает содержимое корзины на основе объекта `myCart`. Мы создадим функцию, которая будет генерировать HTML для выпадающего списка корзины и обновлять его при изменении корзины. Вот реализация:
*/
// Function to render the cart dropdown

function renderCartDropdown() {
    const cartDropdown = document.querySelector('.cart-dropdown');
    const cartNum = document.querySelector('#cart_num');
    const totalPriceElement = document.querySelector('.sub-total p span:last-child');

    // Update cart item count
    cartNum.textContent = myCart.count;

    // Clear existing content
    cartDropdown.innerHTML = '';

    // Create table for cart items
    const table = document.createElement('table');
    table.innerHTML = '';

    // Add cart items to the table
    myCart.products.forEach((product, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td class="product-thumb">
                <a href="#"><img src="${product.imageSrc}" alt="${product.name}"/></a>
            </td>
            <td>
                <a title="${product.name}" href="#">${product.name}</a>
            </td>
            <td>${toCurrency(toNum(product.price))}</td>
            <td>
                <a title="close" href="#" onclick="removeFromCart(${index})">
                    <i class="fa fa-close"></i>
                </a>
            </td>
        `;
        table.appendChild(row);
    });

    cartDropdown.appendChild(table);

    // Update total price
    totalPriceElement.textContent = toCurrency(myCart.cost);

    // Ensure cart button links are present
    if (!cartDropdown.querySelector('.cart-button')) {
        const cartButtonDiv = document.createElement('div');
        cartButtonDiv.className = 'cart-button';
        cartButtonDiv.innerHTML = `
            <a title="Перейти в корзину" href="${userId}_cartSummary">Перейти в корзину</a>
            <a title="Оплатить" href="#">Оплатить</a>
        `;
        cartDropdown.appendChild(cartButtonDiv);
    }
}

// Function to remove item from cart
function removeFromCart(index) {
    myCart.removeProduct(index);
    localStorage.setItem("cart", JSON.stringify(myCart));
    renderCartDropdown();
}

// Initial render
renderCartDropdown();

// Update cart dropdown when adding items
cardAddArr.forEach((cardAdd) => {
    cardAdd.addEventListener("click", (e) => {
        e.preventDefault();
        const card = e.target.closest(".card");
        const product = new Product(card);
        const savedCart = JSON.parse(localStorage.getItem("cart"));
        myCart.products = savedCart.products;
        myCart.addProduct(product);
        localStorage.setItem("cart", JSON.stringify(myCart));
        renderCartDropdown();
    });
});

// Make cart dropdown visible on hover
cart.addEventListener('mouseenter', () => {
    cart.querySelector('.cart-dropdown').style.display = 'block';
});

cart.addEventListener('mouseleave', () => {
    cart.querySelector('.cart-dropdown').style.display = 'none';
});



/*
Этот JavaScript-код создает динамическое представление выпадающей корзины на основе объекта `myCart`. Ниже приводится описание того, что делает код:

1. Функция `renderCartDropdown` генерирует HTML для выпадающей корзины, включая:
   - обновление количества товаров
   - Создание таблицы с элементами корзины
   - Отображение общей цены
   - Добавление кнопок «Перейти в корзину» и «Оплатить».

2. Функция `removeFromCart` позволяет удалять товары из корзины и обновляет отображение.

3. Первоначальный рендеринг выпадающей корзины вызывается после определения функции.

4. Добавлены слушатели событий для обновления корзины при добавлении или удалении товаров.

5. Добавлены события входа и выхода мыши, чтобы показывать/скрывать выпадающий список корзины при наведении.

Чтобы использовать этот код, обязательно вызывайте `renderCartDropdown()` каждый раз, когда корзина должна быть обновлена (например, после добавления или удаления товаров).

Примечание: В данной реализации предполагается, что `userId` является глобальной переменной. Если это не так, вам нужно будет изменить код, чтобы получить идентификатор пользователя соответствующим образом.
```

This JavaScript code creates a dynamic representation of the cart dropdown based on the `myCart` object. Here's a breakdown of what the code does:

1. The `renderCartDropdown` function generates the HTML for the cart dropdown, including:
   - Updating the item count
   - Creating a table with cart items
   - Displaying the total price
   - Adding the "Перейти в корзину" and "Оплатить" buttons

2. The `removeFromCart` function allows removing items from the cart and updates the display.

3. The initial render of the cart dropdown is called after defining the function.

4. Event listeners are added to update the cart when items are added or removed.

5. Mouse enter and leave events are added to show/hide the cart dropdown on hover.

To use this code, make sure to call `renderCartDropdown()` whenever the cart needs to be updated (e.g., after adding or removing items).

Note: This implementation assumes that `userId` is a global variable. If it's not, you'll need to modify the code to get the user ID appropriately.

*/