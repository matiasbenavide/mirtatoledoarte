export async function main(options) {

    let productNameInput = $('#productName');
    let categorySelector = $('#categorySelector');
    let lowerPriceInput = $('#lowerPrice');
    let highestPriceInput = $('#highestPrice');
    let withColorInput = $('#withColor');
    let withoutColorInput = $('#withoutColor');

    let filterToggle = $('#filterToggle');
    let filterForm = $('#filterForm');

    let productName;
    let categoryId;
    let lowerPrice;
    let highestPrice;
    let withColor;
    let withoutColor;

    initProductList(options)

    filterToggle.on('click', function() {
        filterForm.toggle('hidden');
    });

    function initProductList(options) {
        productName = options.productName;
        categoryId = options.categorySelector;
        lowerPrice = options.lowerPrice;
        highestPrice = options.highestPrice;
        withColor = options.withColor;
        withoutColor = options.withoutColor;

        insertDataInInputs(productName, categoryId, lowerPrice, highestPrice, withColor, withoutColor);
    }

    function insertDataInInputs(productName, categoryId, lowerPrice, highestPrice, withColor, withoutColor) {
        productNameInput.val(productName);
        categorySelector.val(categoryId);
        lowerPriceInput.val(lowerPrice);
        highestPriceInput.val(highestPrice);

        if (withColor) {
            withColorInput[0].checked = true;
        }

        if (withoutColor) {
            withoutColorInput[0].checked = true;
        }
    }
}
