const doc = document;

const cart = doc.querySelector(".cart");
const sidebarCart = doc.querySelector(".sidebar-cart");
const close = doc.querySelector(".close");

cart.addEventListener("click", function () {
    if (sidebarCart.classList.contains("right-hide")) {
        sidebarCart.classList.remove("right-hide");
        sidebarCart.classList.add("right-show");
    }
});

close.addEventListener("click", function () {
    if (sidebarCart.classList.contains("right-show")) {
        sidebarCart.classList.remove("right-show");
        sidebarCart.classList.add("right-hide");
    }
});