const doc = document;

const productBtn = doc.querySelector("#product-btn");
const productMenu = doc.querySelector("#product-menu");
productBtn.addEventListener('click', productDropdown);

function productDropdown() {
    if (productMenu.classList.contains('hidden')) {
        productMenu.classList.remove('hidden');
        productMenu.classList.add('block');
        productMenu.classList.add('h-24');
    } else {
        productMenu.classList.add('hidden');
        productMenu.classList.remove('block');
        productMenu.classList.remove('h-24');
    }
}

const categoryBtn = doc.querySelector("#category-btn");
const categoryMenu = doc.querySelector("#category-menu");
categoryBtn.addEventListener('click', categoryDropdown);

function categoryDropdown() {
    if (categoryMenu.classList.contains('hidden')) {
        categoryMenu.classList.remove('hidden');
        categoryMenu.classList.add('block');
        categoryMenu.classList.add('h-24');
    } else {
        categoryMenu.classList.add('hidden');
        categoryMenu.classList.remove('block');
        categoryMenu.classList.remove('h-24');
    }
}

const employeesBtn = doc.querySelector("#employees-btn");
const employeesMenu = doc.querySelector("#employees-menu");
employeesBtn.addEventListener('click', employeesDropdown);

function employeesDropdown() {
    if (employeesMenu.classList.contains('hidden')) {
        employeesMenu.classList.remove('hidden');
        employeesMenu.classList.add('block');
        employeesMenu.classList.add('h-24');
    } else {
        employeesMenu.classList.add('hidden');
        employeesMenu.classList.remove('block');
        employeesMenu.classList.remove('h-24');
    }
}

const customersBtn = doc.querySelector("#customers-btn");
const customersMenu = doc.querySelector("#customers-menu");
customersBtn.addEventListener('click', customersDropdown);

function customersDropdown() {
    if (customersMenu.classList.contains('hidden')) {
        customersMenu.classList.remove('hidden');
        customersMenu.classList.add('block');
        customersMenu.classList.add('h-24');
    } else {
        customersMenu.classList.add('hidden');
        customersMenu.classList.remove('block');
        customersMenu.classList.remove('h-24');
    }
}