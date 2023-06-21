export async function main(options) {

    //***** FORM & INPUTS *****//
    let category_id = $('#category_id');
    let name = $('#name');
    let price = $('#price');
    let description = $('#description');
    let material = $('#material');
    let size = $('#size');
    let max_weight = $('#max_weight');
    let color_id = $('#color_id');

    //***** PRODUCT *****//
    let product;

    initProduct(options)

    function initProduct(options) {
        product = options.product;
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
    }
}
