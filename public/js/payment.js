import { isEmpty, isANumber, isNull, dateInSpanishFormat, changeStyleInput, removeAllInputsError, thereAreErrorsInInputs, equalStrings, getMaxValueOfField } from './module/utils.js';
import { showWarnings, showSuccess, showErrors } from './module/sweetAlert.js';

export async function main(options)
{
    let payForm = $('#payForm');

    //****** FIRST FORM VARIABLES *****//
    let firstForm = $('#firstForm');

    let name = $('#name');
    let phoneNumber = $('#phoneNumber');
    let email = $('#email');
    let documentNumber = $('#documentNumber');

    let firstFormInputs = [name, phoneNumber, email, documentNumber];
    let firstFormInputsErrors = ["* Ingrese su nombre y apellido.", "* Ingrese su número de teléfono.", "* Ingrese su email.", "* Ingrese su DNI o CUIT."];

    //****** SECOND FORM VARIABLES *****//
    let secondForm = $('#secondForm');

    let shippingSelect = $('#shippingSelect');
    let direction = $('#direction');
    let province = $('#province');
    let locality = $('#locality');
    let zipCode = $('#zipCode');

    let secondFormInputs = [direction, province, locality, zipCode];
    let shippingSelectError = "* Seleccione un método de envío";
    let secondFormInputsErrors = ["* Ingrese su dirección", "* Ingrese su provincia", "* Ingrese su localidad", "* Ingrese su código postal"];

    //****** THIRD FORM VARIABLES *****//
    let thirdForm = $('#thirdForm');

    let receipt = $('#receipt');
    let referenceCode = $('#referenceCode');

    let thirdFormInputs = [receipt, referenceCode];
    let thirdFormInputsErrors = ["* Suba una imágen del comprobante de compra.", "* Ingrese el número de trámite del comprobante."];

    let detailDropdown = $('#detailDropdown');
    let editableForms = [detailDropdown];

    let products = options.products;
    let combos = options.combos;
    let withdraw = options.withdraw

    let productsInput = $('#products');

    let productsInfo = [];

    for (const key in products) {
        productsInfo.push({
            'product_id': products[key].product.id,
            'product_category_id': products[key].product.category_id,
            'product_price': products[key].product.price,
            'product_quantity': products[key].quantity,
        })
    }

    for (const key in combos) {
        productsInfo.push({
            'product_id': combos[key].product.id,
            'product_category_id': combos[key].product.category_id,
            'product_price': combos[key].product.price,
            'product_quantity': combos[key].quantity,
        })
    }

    productsInput.val(JSON.stringify(productsInfo));

    firstForm.on('click', function(){
        checkForm(firstForm, firstFormInputs, firstFormInputsErrors);
    })

    secondForm.on('click', function(){
        checkSecondForm(secondForm, shippingSelect, secondFormInputs, secondFormInputsErrors);
    })

    thirdForm.on('click', function(){
        checkForm(payForm, thirdFormInputs, thirdFormInputsErrors);
    })

    function checkForm(form, formInputs, formInputsErrors) {
        let errors = [];

        for (let i = 0; i < formInputs.length; i++) {
            if (isNull(formInputs[i].val()) || isEmpty(formInputs[i].val())) {
                errors.push(formInputsErrors[i]);
                let inputError = formInputs[i][0].parentElement.children[2];
                inputError.classList.remove('active')
                inputError.innerHTML = formInputsErrors[i];
            }
        }

        if(thereAreErrorsInInputs(form)){
            errors.push("* Hay errores en los campos ingresados, revise los mensajes en los campos");
        }

        if (errors.length > 0) {
            console.warn(errors);
            showWarnings(errors);
            return false;
        }
        else {
            if (form[0].id == "payForm") {
                form.submit();
            }
            else {
                let exists = editableForms.find((form) => form[0].id == "firstForm");
                if (exists <= 0 || !exists) {
                    editableForms.push(form);
                    nextForm(0);
                }
            }
        }
    }

    function checkSecondForm(form, formSelect, formInputs, formInputsErrors) {
        let errors = [];

        if (isNull(formSelect.val()) || isEmpty(formSelect.val())) {
            errors.push(shippingSelectError);
            let inputError = formSelect[i][0].parentElement.children[2];
            inputError.classList.remove('active')
            inputError.innerHTML = shippingSelectError;
        }
        else
        {
            if (formSelect.val() != withdraw) {
                for (let i = 0; i < formInputs.length; i++) {
                    if (isNull(formInputs[i].val()) || isEmpty(formInputs[i].val())) {
                        errors.push(formInputsErrors[i]);
                        console.log(formInputs[i][0]);
                        let inputError = formInputs[i][0].parentElement.children[2];
                        inputError.classList.remove('active')
                        inputError.innerHTML = formInputsErrors[i];
                    }
                }
            }
        }

        if(thereAreErrorsInInputs(form)){
            errors.push("* Hay errores en los campos ingresados, revise los mensajes en los campos");
        }

        if (errors.length > 0) {
            console.warn(errors);
            showWarnings(errors);
            return false;
        }
        else {
            let exists = editableForms.find((form) => form[0].id == "secondForm");
            if (exists <= 0 || !exists) {
                editableForms.push(form);
                nextForm(1);
            }
        }
    }

    authorizeEditions();

    function authorizeEditions() {
        $('#payForm [id^="container"]').each(function(index) {
            let toggleForm = $(this).find('[id^="numberTitle"]');
            let form = $(this).find('[id^="inputsDiv"]');

            toggleForm.on('click', function() {
                console.log('active');
                form.toggleClass('active');
            });
        });
    }

    function nextForm(id) {
        $('#inputsDiv'+(id))[0].classList.toggle('active');
        $('#inputsDiv'+(id+1))[0].classList.toggle('active');
    }
}

