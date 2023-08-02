export async function main(options) {

    //***** FORM & INPUTS *****//
    let formData = $('#productForm');
    let category_id = $('#category_id');
    let name = $('#name');
    let price = $('#price');
    let productsSelect = $('#productsSelect');
    let productsSelectDiv = $('#productsSelectDiv');
    let description = $('#description');
    let material = $('#material');
    let size = $('#size');
    let max_weight = $('#max_weight');
    let color_id = $('#color_id');

    let images = [];

    //***** PRODUCT *****//
    let formUrl;
    let product;
    let productImages;

    category_id.on('change', function () {
        showProductsSelect()
    });

    productsSelect.on('change', function () {
        productsSelect[0].value
    });

    initProduct(options)

    function initProduct(options) {
        formUrl = options.formUrl;
        product = options.product;
        productImages = options.productImages;

        if (product) {
            insertDataInInputs(product);
        }

        // if (productImages) {
        //     sendImagesToForm();
        // }
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

    function showProductsSelect() {
        if (category_id.val() == 2) {
            productsSelectDiv[0].hidden = false;
        }
        else {
            productsSelectDiv[0].hidden = true;
        }
    }

    function sendImagesToForm()
    {
        const dataTransfer = new DataTransfer();
        for (let i = 0; i < productImages.length; i++) {

            let imageFile = new File([productImages[i].image], productImages[i].title, { type: productImages[i].mime });
            dataTransfer.items.add(imageFile);
            images.push(dataTransfer.files);
            formData[0].append('images[]', images);
        }

        let req = new XMLHttpRequest();
        req.open('post', formUrl);
        req.send(formData);
    }
}
