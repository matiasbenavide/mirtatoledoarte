export async function main(options) {
    let totalPriceInput = $('#totalPrice');

    let products = options.products;

    let totalPrice = 0;

    for (const key in products) {
        totalPrice += products[key].product.price * products[key].quantity;
    }

    totalPriceInput.val('AR$ ' + totalPrice);
}
