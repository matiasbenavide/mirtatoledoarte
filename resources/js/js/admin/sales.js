export async function main(options)
{
    let url = options.url;
    let ship = options.ship;
    let sales = options.sales;

    let popUp = $('#popUp');
    let name = $('#name');
    let referenceCode = $('#referenceCode');
    let phoneNumber = $('#phoneNumber');
    let email = $('#email');
    let shippingOption = $('#shippingOption');
    let directionDiv = $('#directionDiv');
    let provinceDiv = $('#provinceDiv');
    let localityDiv = $('#localityDiv');
    let zipCodeDiv = $('#zipCodeDiv');
    let direction = $('#direction');
    let province = $('#province');
    let locality = $('#locality');
    let zipCode = $('#zipCode');
    let productsContainer = $('#productsContainer');
    let close = $('#close');

    for (let i = 0; i < sales.length; i++) {
        let saleCell = $('#saleDetail'+sales[i].id);
        saleCell.on('click', function() {
            popUp[0].showModal();
            openDetail(sales[i]);
        })
    }

    close.on('click', function() {
        popUp[0].close();
    })

    function openDetail(sale)
    {
        name[0].innerHTML = sale.name;
        referenceCode[0].innerHTML = sale.reference_code;
        phoneNumber[0].innerHTML = sale.phone_number;
        email[0].innerHTML = sale.email;
        shippingOption[0].innerHTML = "Retiro en sucursal";
        if (sale.shipping_option == ship) {
            shippingOption[0].innerHTML = "Envío a domicilio";
            directionDiv.hidden = false;
            provinceDiv.hidden = false;
            localityDiv.hidden = false;
            zipCodeDiv.hidden = false;
            direction[0].innerHTML = sale.direction;
            province[0].innerHTML = sale.province;
            locality[0].innerHTML = sale.locality;
            zipCode[0].innerHTML = sale.zip_code;
        }

        let productsInfo = JSON.parse(sale.products);
        let products = sale.products_data;

        for (let i = 0; i < products.length; i++) {
            let productDiv = `
                <td class="table-content">
                    <img src="`+ url + `/` + products[i].main_image + `" alt="">
                </td>
                <td class="table-content">
                    <p class="table-title">` + products[i].name + `</p>
                </td>
                <td class="table-content">
                    <p class="table-title">` + products[i].price + `</p>
                </td>
                <td class="table-content">
                    <p class="table-title">` + productsInfo[i].product_quantity + `</p>
                </td>
            `
            productsContainer.append(productDiv);
        }

        popUp[0].showModal();
    }
}
