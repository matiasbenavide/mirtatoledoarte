export async function main(options) {

    let categorySelector = $('#categorySelector');
    let lowerPriceInput = $('#lowerPrice');
    let highestPriceInput = $('#highestPrice');
    let withColorInput = $('#withColor');
    let withoutColorInput = $('#withoutColor');

    let filterToggle = $('#filterToggle');
    let filterForm = $('#filterForm');

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
        categoryId = options.categorySelector;
        lowerPrice = options.lowerPrice;
        highestPrice = options.highestPrice;
        withColor = options.withColor;
        withoutColor = options.withoutColor;

        insertDataInInputs(categoryId, lowerPrice, highestPrice, withColor, withoutColor);
    }

    function insertDataInInputs(categoryId, lowerPrice, highestPrice, withColor, withoutColor) {
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
