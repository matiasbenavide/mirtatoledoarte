export async function main(options) {

    //***** FORM & INPUTS *****//
    let formData = $('#productForm');
    let category_id = $('#category_id');
    let name = $('#name');
    let price = $('#price');
    let productsSelect = $('#productsSelect');
    let productsSelectDiv = $('#productsSelectDiv');
    let description = $('#description');
    let materialDiv = $('#materialDiv');
    let maxWeightDiv = $('#maxWeightDiv');
    let sizeDiv = $('#sizeDiv');
    let material = $('#material');
    let size = $('#size');
    let max_weight = $('#max_weight');
    let color_id = $('#color_id');

    //***** PRODUCT *****//
    let formUrl;
    let product;
    let comboCategory;
    let productImages;

    category_id.on('change', function () {
        showProductsSelect();
    });

    productsSelect.on('change', function () {
        productsSelect[0].value;
    });

    initProduct(options)

    function initProduct(options) {
        formUrl = options.formUrl;
        product = options.product;
        comboCategory = options.comboCategory;
        productImages = options.productImages;

        if (product) {
            insertDataInInputs(product);
        }
    }

    function insertDataInInputs(product) {
        category_id.val(product.category_id);
        name.val(product.name);
        price.val(product.price);
        description.val(product.description);
        material.val(product.material);
        size.val(product.size);
        max_weight.val(product.max_weight);
        color_id.val(product.color_id);

        if (category_id.val() == comboCategory) {
            let productSelectOptions = productsSelect[0].options;
            showProductsSelect();

            for (let i = 0; i < productSelectOptions.length; i++) {
                product.products.forEach(product => {
                    if (productSelectOptions[i].value == product) {
                        productSelectOptions[i].selected = true;
                    }
                });
            }
        }
    }

    function showProductsSelect() {
        if (category_id.val() == 2) {
            productsSelectDiv[0].hidden = false;
            materialDiv[0].hidden = true;
            sizeDiv[0].hidden = true;
            maxWeightDiv[0].hidden = true;
        }
        else {
            productsSelectDiv[0].hidden = true;
            materialDiv[0].hidden = false;
            sizeDiv[0].hidden = false;
            maxWeightDiv[0].hidden = false;
        }
    }
}
