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
    let saleTable = $('#saleTable');
    let close = $('#close');

    for (let i = 0; i < sales.length; i++) {
        let saleCell = $('#saleDetail'+sales[i].id);
        saleCell.on('click', function() {
            popUp[0].showModal();
            openDetail(sales[i]);
        })
    }

    close.on('click', function() {
        let tbody = saleTable[0].querySelector('tbody');
        tbody.innerHTML = "";
        popUp[0].close();
    })

    function openDetail(sale)
    {
        name[0].innerHTML = sale.name;
        referenceCode[0].innerHTML = sale.reference_code;
        phoneNumber[0].innerHTML = sale.phone_number;
        email[0].innerHTML = sale.email;
        if (sale.shipping_option == ship) {
            shippingOption[0].innerHTML = "Envío a domicilio";
            directionDiv[0].hidden = false;
            provinceDiv[0].hidden = false;
            localityDiv[0].hidden = false;
            zipCodeDiv[0].hidden = false;

            direction[0].innerHTML = sale.direction;
            province[0].innerHTML = sale.province;
            locality[0].innerHTML = sale.locality;
            zipCode[0].innerHTML = sale.zip_code;
        }
        else
        {
            shippingOption[0].innerHTML = "Retiro en sucursal";
            directionDiv[0].hidden = true;
            provinceDiv[0].hidden = true;
            localityDiv[0].hidden = true;
            zipCodeDiv[0].hidden = true;
        }

        let productsInfo = JSON.parse(sale.products);
        let products = sale.products_data;

        for (let i = 0; i < products.length; i++) {
            let tr = document.createElement("tr");
            let td1 = document.createElement("td");
            let td2 = document.createElement("td");
            let td3 = document.createElement("td");
            let td4 = document.createElement("td");

            tr.classList.add("products-table-item");
            td1.classList.add("table-content-sale");
            td2.classList.add("table-content-sale");
            td3.classList.add("table-content-sale");
            td4.classList.add("table-content-sale");

            td1.innerHTML = `<div class="table-img-container"><img class="table-img" src="`+ url + `/` + products[i].main_image + `" alt=""></div>`
            td2.innerHTML = `<p class="table-title">` + products[i].name + `</p>`
            td3.innerHTML = `<p class="table-title">` + products[i].price + `</p>`
            td4.innerHTML = `<p class="table-title">` + productsInfo[i].product_quantity + `</p>`

            tr.appendChild(td1);
            tr.appendChild(td2);
            tr.appendChild(td3);
            tr.appendChild(td4);

            saleTable[0].querySelector('tbody').appendChild(tr);
        }

        popUp[0].showModal();
    }
}
