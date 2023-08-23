export async function main(options) {

    let lowerPriceInput = $('#lowerPriceInput');
    let highestPriceInput = $('#highestPriceInput');
    let withColorInput = $('#withColorInput');
    let withoutColorInput = $('#withoutColorInput');

    let filterToggle = $('#filterToggle');
    let filterForm = $('#filterForm');

    let lowerPrice;
    let highestPrice;
    let withColor;
    let withoutColor;

    initProductList(options)

    filterToggle.on("click", function() {
        filterForm[0].toggle('hidden');
    })

    function initProductList(options) {
        lowerPrice = options.lowerPrice;
        highestPrice = options.highestPrice;
        withColor = options.withColor;
        withoutColor = options.withoutColor;

        insertDataInInputs(lowerPrice, highestPrice, withColor, withoutColor);
    }

    function insertDataInInputs(lowerPrice, highestPrice, withColor, withoutColor) {
        lowerPriceInput.val(lowerPrice);
        highestPriceInput.val(highestPrice);

        if (withColor) {
            withColorInput.checked = true;
        }

        if (withoutColor != null) {
            withoutColorInput.checked = true;
        }
    };
}
