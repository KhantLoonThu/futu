const doc = document;

// category
async function getCategories() {
    let response = await fetch("./admin/api/category.php");
    // console.log(response)
    let data = await response.json();
    return data;
}

// sub categories
async function getSubCategories() {
    let response = await fetch("./admin/api/subcategory.php");
    let data = await response.json();
    return data;
}

// products 
async function getProducts() {
    let response = await fetch("./admin/api/product.php");
    let data = await response.json();
    return data;
}

const categoryList = doc.getElementsByClassName('category-list')[0];
const cartBody = doc.getElementsByClassName('cart-body')[0];
let totalCartItem = doc.getElementsByClassName('totalCartItem')[0];
let footerContainer = doc.createElement('div');
let cartItems = [];

const cart = doc.querySelector(".cart");
const sidebarCart = doc.querySelector(".sidebar-cart");
const close = doc.querySelector(".close");
const overlay = doc.querySelector('.overlay');

function showAndHideCart() {
    cart.addEventListener("click", function () {
        if (sidebarCart.classList.contains("right-hide")) {
            sidebarCart.classList.remove("right-hide");
            sidebarCart.classList.add("right-show");
        }
        if (overlay.classList.contains('hidden')) {
            overlay.classList.remove('hidden');
            doc.body.classList.add('overflow-hidden')
        }
    });

    close.addEventListener("click", function () {
        if (sidebarCart.classList.contains("right-show")) {
            sidebarCart.classList.remove("right-show");
            sidebarCart.classList.add("right-hide");
        }
        if (!overlay.classList.contains('hidden')) {
            overlay.classList.add('hidden');
            doc.body.classList.remove('overflow-hidden')
        }
    });
}

async function main() {

    // Retrieve cart items from localStorage if available
    if (localStorage.getItem('cart')) {
        cartItems = JSON.parse(localStorage.getItem('cart'));
        addCartToHtml();
    }

    let categories = await getCategories();
    let subcategories = await getSubCategories();
    let products = await getProducts();

    showAndHideCart();
    // add category lists to the ui
    addCategoryLists(categories, products);

    // check the category is active and if it was add to the Home/location
    categoryLocation(categories, subcategories, products);
    totalCartItem.innerHTML = cartItems.length;
}

main()

function addCategoryLists(categories, products) {

    function renderCategories() {
        categoryList.innerHTML = '';

        categories.forEach((category, index) => {
            const categoryContainer = doc.createElement('div');
            categoryContainer.classList.add('flex', 'justify-between', 'items-center');

            const li = doc.createElement('li');
            li.setAttribute('id', category.id);
            li.textContent = category.name;
            li.classList.add('text-lg', 'text-blue-600', 'cursor-pointer', 'py-2', 'categories');
            if (index === 0) {
                li.classList.add('active');
            }

            const productPerCategory = products.filter(product => product.category_id === category.id);
            const productCountSpan = doc.createElement('span');
            productCountSpan.textContent = `(${productPerCategory.length} products)`;
            productCountSpan.classList.add('text-sm', 'text-gray-400');

            categoryContainer.appendChild(li);
            categoryContainer.appendChild(productCountSpan);
            categoryList.appendChild(categoryContainer);
        });
    }
    renderCategories();
}



function categoryLocation(categories, subcategories, products) {
    let categoriesLists = Array.from(doc.getElementsByClassName('categories'));
    let currentLocation = doc.getElementsByClassName('currentLocation')[0];
    let productList = doc.getElementsByClassName("product-list")[0];
    let initiallyActiveCategory = doc.querySelector('.categories.active');

    if (initiallyActiveCategory) {
        renderingProducts(initiallyActiveCategory, productList, subcategories, products);
        currentLocation.innerText = initiallyActiveCategory.innerText;
    }
    categoriesLists.forEach(category => {

        category.addEventListener("click", function (event) {
            productList.innerHTML = "";

            let previouslyActiveCategory = doc.getElementsByClassName('categories active')[0];
            // console.log(previouslyActiveCategory);
            if (previouslyActiveCategory) {
                previouslyActiveCategory.classList.remove('active');
            }

            let clickedCategory = event.target;
            clickedCategory.classList.add('active');

            // Update current location with the name of the clicked category
            currentLocation.innerText = clickedCategory.innerText;

            renderingProducts(clickedCategory, productList, subcategories, products)
        })
    })
}

async function renderingProducts(selectedCategory, productList, subcategories, products) {
    const categoryId = selectedCategory.getAttribute('id'); // Get the ID of the selected category
    const filteredSubcategories = subcategories.filter(subcategory => subcategory.category_id === categoryId);

    filteredSubcategories.forEach(subcategory => {
        let subcategoryContainer = doc.createElement("div");
        subcategoryContainer.classList.add("subcategory-container");

        let subcategoryHeader = doc.createElement("h2");
        subcategoryHeader.classList.add('text-xl', 'mt-5', 'capitalize', 'text-blue-600', 'py-2', 'subcategories', subcategory.id);
        subcategoryHeader.innerText = subcategory.name;

        let productContainer = doc.createElement("div");
        productContainer.classList.add("product-container", "grid", "grid-cols-4", "gap-5");

        let btnContainer = doc.createElement("div");
        btnContainer.classList.add("text-center");
        let loadMoreBtn = doc.createElement("button");
        loadMoreBtn.classList.add("px-6", "py-3", "text-white", "bg-blue-600", "my-5", "hover:bg-white", "border-2", "border-blue-600", "hover:text-blue-600", "effect-3");
        loadMoreBtn.innerText = "Load More";
        btnContainer.append(loadMoreBtn);

        const filteredProducts = products.filter(product => product.subcategory_id === subcategory.id);
        // animation or 404 not found
        if (filteredProducts.length > 0) {
            let currentItem = 0;
            for (let i = currentItem; i < currentItem + 4; i++) {
                if (filteredProducts[i].subcategory_id == subcategory.id) {
                    createCard(subcategory, filteredProducts, i, productContainer);
                }
            }

            loadMoreBtn.addEventListener("click", function () {
                currentItem += 4
                for (let i = currentItem; i < currentItem + 4; i++) {
                    if (filteredProducts[i].subcategory_id == subcategory.id) {
                        createCard(subcategory, filteredProducts, i, productContainer);
                    }
                }
            })

            subcategoryContainer.append(subcategoryHeader, productContainer, btnContainer);
            productList.append(subcategoryContainer);
        }
    })
}

function createCard(subcategory, filteredProducts, i, productContainer) {
    let cardContainer = doc.createElement("div")
    cardContainer.classList.add("w-full", "my-5", "bg-white", 'relative', 'mb-5', 'rounded-xl');

    let card = doc.createElement("div");
    card.classList.add("text-center", 'shadow-2xl', 'rounded-xl', 'overflow-hidden');

    let cardBody = doc.createElement("div");

    let img = doc.createElement("img");
    if (subcategory.category_id == 10) {
        img.setAttribute("src", `${filteredProducts[i].thumb}`);
        cardBody.classList.add("p-5", "bg-orange-200", "text-black", 'h-36', 'rounded-b-xl');
    } else if (subcategory.category_id == 7) {
        img.setAttribute("src", `../public/images/${filteredProducts[i].thumb}`);
        cardBody.classList.add("p-5", "bg-orange-200", "text-black", 'h-36', 'rounded-b-xl')
    } else {
        img.setAttribute("src", `../public/images/${filteredProducts[i].thumb}`);
        cardBody.classList.add("p-5", "bg-orange-200", "text-black", 'h-full', 'rounded-b-xl');
    }
    img.setAttribute("alt", `${filteredProducts[i].name}`);
    img.classList.add("w-full", "h-48", "object-cover");

    let title = doc.createElement("h2");
    title.classList.add("text-lg", "mt-2", "mb-3", "font-semibold", "capitalize");
    title.innerText = filteredProducts[i].name;

    let price = doc.createElement("p");
    price.classList.add("my-1", "font-semibold");
    price.innerText = `${filteredProducts[i].price} $`;

    // for deatil and card button
    let detail = doc.createElement("button");
    detail.classList.add('hidden', 'flex', 'justify-center', 'items-center', 'mb-5', "w-8", 'h-8', 'rounded-full', 'font-bold', 'bg-gray-200', 'hover:bg-gray-100', 'p-2', 'text-black', 'absolute', 'top-16', 'right-5');
    detail.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
    </svg>`;

    let detailmessageBox = doc.createElement("div");
    detailmessageBox.innerText = "Quick View";
    detailmessageBox.classList.add('hidden', 'z-20', 'text-white', 'bg-gray-800', 'py-2', 'px-4', 'rounded-xl', 'absolute', 'top-14', 'right-16', 'message-box');

    let cartBtn = doc.createElement("button");
    cartBtn.classList.add('hidden', 'flex', 'justify-center', 'items-center', 'mb-5', "w-8", 'h-8', 'rounded-full', 'font-bold', 'bg-gray-200', 'hover:bg-gray-100', 'p-2', 'text-black', 'absolute', 'top-5', 'right-5');
    cartBtn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
</svg>`;
    let cartMessageBox = doc.createElement("div");
    cartMessageBox.innerText = "Add To Cart";
    cartMessageBox.classList.add('hidden', 'z-20', 'text-white', 'bg-gray-800', 'py-2', 'px-4', 'rounded-xl', 'absolute', 'top-3', 'right-16', 'message-box');

    cardBody.append(title);
    cardBody.append(price);

    card.append(img, cardBody, detail, detailmessageBox, cartBtn, cartMessageBox);
    cardContainer.append(card);
    productContainer.append(cardContainer);

    img.addEventListener('mouseenter', function () {
        img.classList.add("opacity-50")
        detail.classList.remove("hidden");
        cartBtn.classList.remove("hidden");
    })
    img.addEventListener('mouseleave', function () {
        img.classList.remove("opacity-50")
        detail.classList.add("hidden");
        cartBtn.classList.add("hidden");
    })
    detail.addEventListener('mouseenter', function () {
        img.classList.add("opacity-50")
        detail.classList.remove("hidden");
        cartBtn.classList.remove("hidden");
        detailmessageBox.classList.remove("hidden");
    })
    detail.addEventListener('mouseleave', function () {
        img.classList.remove("opacity-50")
        cartBtn.classList.add("hidden");
        detail.classList.add("hidden");
        detailmessageBox.classList.add("hidden");
    })
    cartBtn.addEventListener('mouseenter', function () {
        img.classList.add("opacity-50")
        detail.classList.remove("hidden");
        cartBtn.classList.remove("hidden");
        cartMessageBox.classList.remove("hidden");
    })
    cartBtn.addEventListener('mouseleave', function () {
        img.classList.remove("opacity-50")
        cartBtn.classList.add("hidden");
        detail.classList.add("hidden");
        cartMessageBox.classList.add("hidden");
    })

    let productId = filteredProducts[i].id;
    let quantity = 0;
    cartBtn.addEventListener('click', function () {
        quantity++;
        addToCart(productId, filteredProducts, quantity);
    })

}

function addToCart(productId, products, quantity) {
    let cartItem = products.find(value => value.id == productId);

    const existingCartItemIndex = cartItems.findIndex(item => item.id === productId);
    if (existingCartItemIndex !== -1) {
        cartItems[existingCartItemIndex].quantity += 1;
    } else {
        cartItems.push({ ...cartItem, quantity });
    }

    // Render cart items
    renderCartItems(cartItems);
}

function renderCartItems(cartItems) {
    if (cartItems.length === 0) {
        doc.querySelector('.continue-shopping-btn').classList.remove('hidden');
        footerContainer.classList.add('hidden');
        // If cart is empty, display a message
        let noProductToshow = doc.createElement("div");
        cartBody.classList.add('flex', 'justify-center', 'items-center');
        noProductToshow.innerHTML = "No Product to Show"
        cartBody.append(noProductToshow);
    } else {
        // If cart has items, render them
        addCartToHtml();
        addCartMemory();
    }
    totalCartItem.innerHTML = cartItems.length;
}

function addCartToHtml() {
    doc.querySelector('.continue-shopping-btn').classList.add('hidden');
    footerContainer.classList.remove('hidden');
    cartBody.innerHTML = '';
    let subTotal = 0;

    cartItems.forEach(item => {

        const cartItemContainer = doc.createElement('div'); // Create a container for the cart item
        cartItemContainer.classList.add('cart-item-container', 'p-2', 'w-full');

        const cartItemHTML = `
        <div class="grid grid-cols-5 gap-4 items-center text-lg font-medium px-4 py-2 bg-gray-300">
            <div class="col-span-1">
                <img src="../public/images/${item.thumb}" class="w-20 h-20" />
            </div>
            <div class="col-span-1">
                <h2 class='capitalize'>${item.name}</h2>
            </div>
            <div class="col-span-1 text-center">
                <p>$ ${item.price * item.quantity}</p>
            </div>
            <div class="col-span-1">
                <div class="flex justify-center items-center">
                    <button class="minus px-3 py-1 bg-gray-600 rounded-full text-white">-</button>
                    <span class="mx-3 quantity">${item.quantity}</span>
                    <button class="plus px-3 py-1 bg-gray-600 rounded-full text-white">+</button>
                </div>
            </div>
            <div class="col-span-1 text-end">
            <button class="remove-from-cart">
                    <svg class="w-10 h-8 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
</svg>
                    </button>
            </div>
        </div>
    `;
        cartItemContainer.innerHTML = cartItemHTML;
        cartBody.appendChild(cartItemContainer);

        subTotal += item.price * item.quantity;
    });

    // still need
    let minusBtn = doc.querySelectorAll('.minus');
    let quantity = doc.querySelectorAll('.quantity');
    console.log(quantity.innerText); // Check the value of quantity
    if (parseInt(quantity.innerText) === 1) {
        minusBtn.disabled = true;
    } else {
        console.log('not')
    }

    let subtotal = doc.createElement('p');
    let subtotalPrice = doc.createElement('p');
    let subtotalContainer = doc.createElement('div');
    subtotalContainer.classList.add('flex', 'justify-between', 'items-center', 'border-y-2', 'border-y-gray-300', 'py-5', 'my-3');

    subtotal.classList.add('font-medium', 'text-lg');
    subtotal.innerText = "Subtotal:"

    subtotalPrice.innerText = `${subTotal}$`;

    subtotalContainer.append(subtotal, subtotalPrice);

    let checkoutBtn = doc.createElement('button');
    checkoutBtn.classList.add('w-full', 'px-6', 'py-4', 'border-2', 'effect-3', 'hover:bg-white', 'hover:border-emerald-600', 'hover:text-emerald-600', 'bg-emerald-600', 'text-white', 'mb-3');
    checkoutBtn.innerText = "Check Out";

    let viewChartBtn = doc.createElement('button');
    viewChartBtn.classList.add('w-full', 'px-6', 'py-4', 'border-2', 'effect-3', 'hover:bg-white', 'hover:border-blue-600', 'hover:text-blue-600', 'bg-blue-600', 'text-white', 'mb-3');
    viewChartBtn.innerText = "View Chart";

    footerContainer.classList.add('footer-container', 'px-3');
    footerContainer.append(subtotalContainer, viewChartBtn, checkoutBtn);

    doc.querySelector('.cart-footer').append(footerContainer);
    console.log(doc.querySelector('.cart-footer'));
}

function addCartMemory() {
    localStorage.setItem('cart', JSON.stringify(cartItems));
}