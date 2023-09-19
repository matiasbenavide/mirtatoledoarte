export function isEmpty (a) {
    return !a || 0 === a.length;
}

export function isNull (a){
    return a === null;
}

export function isUndefined (a){
    return a === undefined;
}

export function isNullOrUndefined (a){
    return isNull(a) || isUndefined(a);
}

export function isANumber (a) {
    return /^\d+$/.test(a);
}

export function StartBlockPage(id=null) {

    // window.scrollTo( screen.width/2, 4*screen.height/5 );
    window.scrollTo( screen.width/2, 0);

    let block_body = $("body");
    if(id){
        block_body = $("#"+id);
    }

    $(block_body).block({
        message: '<div class="spinner-border"></div><br /><br /><div><h3>Procesando solicitud, espere por favor...</h3>',
        centerY: false,
        overlayCSS: {
            backgroundColor: '#FFF',
            opacity: 0.8,
            cursor: 'wait',
            width:'100%',
            height:'100%',
        },
        css: {
            border : 'none',
            padding: 0,
            backgroundColor: 'transparent',
            width:'100%',
            height:'100px',
            top: screen.height/2 - 100,
        }
    });
}

export function CloseBlockPage(id=null) {
    let block_body = $("body");
    if(id){
        block_body = $("#"+id);
    }
    $(block_body).unblock();
}

export function readURL(input, imgName){
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            $('#'+imgName+'-preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
        $('#'+imgName+'-preview').prop('hidden', false);
        $('#'+imgName+'-label').html(input.files[0].name);
    } else {
        const imgPreview = $('#'+imgName+'-preview');
        imgPreview.attr('src', '');
        imgPreview.prop('hidden', true);
        $('#'+imgName+'-label').html('Seleccione un archivo');
    }
}



Date.prototype.addDays = function(days) {
    let date = new Date(this.valueOf());
    date.setDate(date.getDate() + days);
    let day = ("0" + date.getDate()).slice(-2);
    let month = ("0" + (date.getMonth() + 1)).slice(-2);
    return date.getFullYear()+"-"+(month)+"-"+(day) ;
};

Date.prototype.now = function() {
    let date = new Date(this.valueOf());
    let day = ("0" + this.getDate()).slice(-2);
    let month = ("0" + (this.getMonth() + 1)).slice(-2);
    return this.getFullYear()+"-"+(month)+"-"+(day) ;
};

/**
 * Return date in format YYYY-MM-DD-HH-MM-SS
 */
Date.prototype.FormatYMDHMS = function() {
    let date = new Date(this.valueOf());
    let day = ("0" + this.getDate()).slice(-2);
    let month = ("0" + (this.getMonth() + 1)).slice(-2);
    let hour = ("0" + date.getHours()).slice(-2);
    let minutes = ("0" + date.getMinutes()).slice(-2);
    let seconds = ("0" + date.getSeconds()).slice(-2);
    return this.getFullYear()+"-"+(month)+"-"+(day)+"_"+hour+"-"+minutes+"-"+seconds;
};

/**
 * Return date in format YYYY-MM-DD
 */
 Date.prototype.FormatYMD = function() {
    let date = new Date(this.valueOf());
    let day = ("0" + this.getDate()).slice(-2);
    let month = ("0" + (this.getMonth() + 1)).slice(-2);
    return this.getFullYear()+"-"+(month)+"-"+(day);
};

export function dateInputNow() {
    let now = new Date();
    let day = ("0" + now.getDate()).slice(-2);
    let month = ("0" + (now.getMonth() + 1)).slice(-2);
    return now.getFullYear()+"-"+(month)+"-"+(day);
}

/**
 * Return string date in format DD de MMM de AAAA  HH:mm (29 de oct. de 2020 12:54)
 */
export function dateInSpanishFormat(sdate) {
    if(!isNull(sdate)) {
        let date = new Date(sdate);
        let options = {day: 'numeric', month: 'short', year: 'numeric'};
        return date.toLocaleString('es-AR', options);
    } else {
        return null;
    }
}

/**
 * The Jquery object is a input or select and should have role=description_to_show attribute
 * bellow input should have <span class="text-danger"><p id="nameInput_error" role="description_input_error"></p></span>
 * @param {Object} jqueryObject
 * @param {boolean} is_invalid
 */
export function setErrorEmptyInput(jqueryObject, is_invalid){
    let message = 'El campo '+jqueryObject.attr('description_to_show')+' es obligatorio';
    changeStyleInput(jqueryObject, message, is_invalid);
}

/**
 * @param {JQuery} JqueryObject
 */
export function isEmptyInput(JqueryObject){
    return isNull(JqueryObject.val()) || isEmpty(JqueryObject.val());
}

/**
 * @param {Object} jqueryObject
 * @param {string} message
 * @param {boolean} is_invalid
 */
export function changeStyleInput(jqueryObject, message, is_invalid){
    let messageObject = $('#'+jqueryObject.attr('id')+'_error');

    if(messageObject.length === 0){
        messageObject = $('#'+jqueryObject.attr('id')+'_error');
    }

    if(is_invalid){
        messageObject.text(message);
        jqueryObject.get(0).setCustomValidity('El dato ingresado es inválido');
        jqueryObject.addClass('is-invalid');
    }else{
        messageObject.text('');
        jqueryObject.get(0).setCustomValidity("");
        jqueryObject.removeClass('is-invalid');
    }
}
/**
 * @param {Object} jqueryObjectForm
 */
export function removeAllInputsError(jqueryObjectForm){
    let inputs_error = jqueryObjectForm.find("[class*='is-invalid']");
    inputs_error.removeClass('is-invalid');

    let descriptions = jqueryObjectForm.find("[role*='description_input_error']");
    descriptions.text('');
}

export function thereAreErrorsInInputs(jqueryObjectForm){
    let amountErrors =  jqueryObjectForm.find("[class*='is-invalid']:not(:disabled)").length
    return (amountErrors > 0);
}

export function isEmailValid(a){
    let re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return re.test(a)
}

export function capitalizeFirstLetter(str) {
    // let smallWords = /^(a|an|and|as|at|but|by|en|for|if|in|nor|of|on|or|per|the|to|vs?\.?|via)$/i;
    let words = str.split(' ');      // Get me an array of separate words

    words = words.map(function(word, index) {
    //   if (index > 0 && ~word.search(smallWords))
    //     return word;                 // If it's a small word, don't change it.

      if (~word.lastIndexOf('.', 1)) // If it contains periods, it's an abbreviation: Uppercase.
        return word.toUpperCase();   // lastIndexOf to ignore the last character.

      // Capitalize the fist letter if it's not a small word or abbreviation.
      return word.charAt(0).toUpperCase() + word.substr(1);
    });

    return words.join(' ');
}


/**
 * This function duplicate elements using Jquery
 * @param {Object} jqueryObject first argument that contain all elements to duplicate
 * @param {Objet} jqueryObject second argument that contain the element to duplicate, that contain inputs, selects, labels
 * @param {string} is_invalid third argument contain the class the contain all elements to duplicate, is to identify them
 */
 export function duplicateElement(elementsContainer, elementToDuplicate, classElementToDuplicate, nameElementToDuplicate=null){
    return new Promise((resolve, reject)=>{
        let filter = "[class*=" + "'" +classElementToDuplicate + "'" + "]";
        let copyNumber = elementsContainer.find(filter).length;
        let newElement = elementToDuplicate.clone(true);
        let oldIdElementToDuplicate  = elementToDuplicate.attr('id');
        newElement.attr('id',oldIdElementToDuplicate+'_'+copyNumber);

        let inputs = newElement.find('input, select, p[id*="_error"]');

        jQuery.each(inputs, function(index, value){
            let input = $(value);
            let nameInput = input.attr('name');
            let idInput = input.attr('id');
            let forInput = input.attr('for');

            if(idInput.match(/.*_error$/) == null){
                input.attr('id',idInput+'_'+copyNumber);
            }else{
                input.attr('id',idInput.replace('_error','')+'_'+copyNumber+'_error' );
            }

            if(forInput != undefined){
                input.attr('for',forInput+'_'+copyNumber);
            }
            if(nameInput && nameInput.endsWith(']')){
                let posInitArray = nameInput.indexOf('[');
                let finalText = nameInput.substring(posInitArray);
                nameInput = nameInput.substring(0, posInitArray);
                input.attr('name',nameInput+'_'+copyNumber+ finalText);
            }else if(nameInput){
                input.attr('name',nameInput+'_'+copyNumber);
            }
        });


        let labels = newElement.find("label");
        jQuery.each(labels, function(index, value){
            let label = $(value);
            let forLabel = label.attr('for');
            if(forLabel != undefined){
                label.attr('for',forLabel+'_'+copyNumber);
            }
        });

        elementsContainer.prepend(newElement);

        if(nameElementToDuplicate){
            snackbar.show(
                {
                    text: 'Se ha agregado un '+nameElementToDuplicate,
                    actionText: 'x',
                    actionTextColor: '#FFFFFF',
                    duration: 2000
                });
        }
        resolve();
    });
}



/**
 * This function duplicate elements using Jquery
 * @param {Object} jqueryObject first argument that contain all elements to duplicate
 * @param {Objet} jqueryObject second argument that contain the element to duplicate, that contain inputs, selects, labels
 * @param {string} is_invalid third argument contain the class the contain all elements to duplicate, is to identify them
 */
 export function duplicateElementArray(elementsContainer, elementToDuplicate, classElementToDuplicate, nameElementToDuplicate=null, order=null){
    return new Promise((resolve, reject)=>{
        let copyNumber = 0;
        if(order){
            copyNumber = order
        }else{
            let filter = "[class*=" + "'" +classElementToDuplicate + "'" + "]";
            copyNumber = elementsContainer.find(filter).length;
        }
        let newElement = elementToDuplicate.clone(true);
        let oldIdElementToDuplicate  = elementToDuplicate.attr('id');
        newElement.attr('id',oldIdElementToDuplicate+'_'+copyNumber);

        let inputs = newElement.find('input, select, p[id*="_error"]');

        jQuery.each(inputs, function(index, value){
            let input = $(value);
            let nameInput = input.attr('name');
            let idInput = input.attr('id');
            let forInput = input.attr('for');

            if(idInput.match(/.*_error$/) == null){
                input.attr('id',idInput+'_'+copyNumber);
            }else{
                input.attr('id',idInput.replace('_error','')+'_'+copyNumber+'_error' );
            }

            if(forInput != undefined){
                input.attr('for',forInput+'_'+copyNumber);
            }
            if(nameInput && nameInput.endsWith(']')){
                let posInitArray = nameInput.indexOf('[');
                let finalText = nameInput.substring(posInitArray);
                nameInput = nameInput.substring(0, posInitArray);
                input.attr('name',nameInput+'_'+copyNumber+ finalText);
                input.attr('name',nameInput+'['+copyNumber+ ']' + finalText);
            }else if(nameInput){
                input.attr('name',nameInput+'_'+copyNumber);
            }
        });


        let labels = newElement.find("label");
        jQuery.each(labels, function(index, value){
            let label = $(value);
            let forLabel = label.attr('for');
            if(forLabel != undefined){
                label.attr('for',forLabel+'_'+copyNumber);
            }
        });

        elementsContainer.prepend(newElement);

        if(nameElementToDuplicate){
            snackbar.show(
                {
                    text: 'Se ha agregado un '+nameElementToDuplicate,
                    actionText: 'x',
                    actionTextColor: '#FFFFFF',
                    duration: 2000
                });
        }
        resolve(newElement);
    });
}


/**
 * This function delete element using Jquery
 * @param {Object} jqueryObject element to delete
 */
export function deleteElement(object, show=true){
    object.remove();
    object = null;
    if(show){
        snackbar.show(
            {
                text: 'Se ha eliminado un elemento',
                pos: 'bottom-right',
                backgroundColor: '#dc3545',
                actionTextColor: '#000000',
                actionText: 'x',
                actionTextColor: '#FFFFFF',
                duration: 2000
            });
    }
}

/**
 *
 * @param {*} dateString , is the input value of type date
 * @returns integer
 */
export function getAge(dateString) {
    let today = new Date();
    let birthDate = new Date(dateString);
    let age = today.getFullYear() - birthDate.getFullYear();
    let m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
}

export function alphaOnly(event) {
    var key = event.keyCode;
    return ( (key >= 65 && key <= 90) || key == 8 || (key >= 48 && key <= 57) );
};

export function alphaAndNumberOnly(event) {
    var key = event.keyCode;
    return ( (key >= 65 && key <= 90) || key == 8 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105) );
};

export function hideComponent( jqueryObject ){
    jqueryObject.css("display", "block");
    let allinputs = jqueryObject.find("[required]");
    allinputs.prop('required',false);
}

export function showComponent( jqueryObject ){
    jqueryObject.css("display", "none");
    let allinputs = jqueryObject.find("[required]");
    allinputs.prop('required',true);
}

export function validateCuitCuil( jqueryObject ){
    jqueryObject.css("display", "none");
    let allinputs = jqueryObject.find("[required]");
    allinputs.prop('required',true);
}

// String comparison case insensitive
export function equalStrings(a, b, ignoreAccents=false){
    let mySensitivity = 'accent';
    if(ignoreAccents){
        let mySensitivity = 'base';
    }
    return typeof a === 'string' && typeof b === 'string'
        ? a.localeCompare(b, undefined, { sensitivity: mySensitivity }) === 0
        : a === b;
}

export function validatePatentAndFormat( jqueryObject )
{
    let isMercosur;
    let maxSizeMercosur = 7 + 2;
    let maxSize94 = 6 + 1;

    this.value = this.value.trimStart();
    this.value = this.value.replace('\t', '');
    this.value = this.value.toUpperCase();

    if (!this.value.match(/^[A-Z]/) || this.value.match(/^[A-Z][^A-Z]/) != null ||
        this.value.match(/^[A-Z][A-Z][A-Z][^0-9-\s]/) != null) {
        changeStyleInput($(this), 'El valor ingresado no es correcto', true);
        this.value = this.value.substr(0, maxSizeMercosur);

    } else {
        // format for input

        changeStyleInput($(this), '', false);

        if (this.value.match(/^[A-Z][A-Z][A-Z][0-9]/)) {
            this.value = this.value.substring(0, 3) + ' ' + this.value.substring(3);

        } else if (this.value.match(/^[A-Z][A-Z][0-9]/)) {
            this.value = this.value.substring(0, 2) + ' ' + this.value.substring(2);

        } else if (this.value.match(/^[A-Z][A-Z] [0-9][0-9][0-9][A-Z]/)) {
            this.value = this.value.substring(0, 6) + ' ' + this.value.substring(6);
        }
    }


    // Validate format selected

    if (this.value.match(/^[A-Z][A-Z] [0-9]/)) { //mercosur
        this.value = this.value.substr(0, maxSizeMercosur);
        if (this.value.match(/^[A-Z][A-Z] [^0-9]/) != null ||
            this.value.match(/^[A-Z][A-Z] [0-9][^0-9]/) != null ||
            this.value.match(/^[A-Z][A-Z] [0-9][0-9][^0-9]/) != null ||
            this.value.match(/^[A-Z][A-Z] [0-9][0-9][0-9][^\s-]/) != null ||
            this.value.match(/^[A-Z][A-Z] [0-9][0-9][0-9] [^A-Z]/) != null ||
            this.value.match(/^[A-Z][A-Z] [0-9][0-9][0-9] [A-Z][^A-Z]/) != null) {
            changeStyleInput($(this), 'El valor ingresado no es correcto', true);
        }

    } else if (this.value.match(/^[A-Z][A-Z][A-Z] [0-9]/)) { // 94
        this.value = this.value.substr(0, maxSize94);
        if (this.value.match(/^[A-Z][A-Z][A-Z] [^0-9]/) != null ||
            this.value.match(/^[A-Z][A-Z][A-Z] [0-9][^0-9]/) != null ||
            this.value.match(/^[A-Z][A-Z][A-Z] [0-9][0-9][^0-9]/) != null) {
            changeStyleInput($(this), 'El valor ingresado no es correcto', true);
        }
    }
}
export function validatePatent(){
    if (!this.value.match(/^[A-Z]{2} [0-9]{3} [A-Z]{2}/) &&
        !this.value.match(/^[A-Z]{3} [0-9]{3}/)) {
        changeStyleInput($(this), 'El valor ingresado no es correcto', true);
    }
}

export function validateExpirationDate(input, min_days_from_today=0) {
    let date  = moment(input.value).endOf('day');
    let today = moment().add(min_days_from_today, 'days').endOf('day');

    if(date < today){
        changeStyleInput($(input),'La fecha ingresada no es válida',true);
    }else{
        changeStyleInput($(input),'',false);
    }
}

export function validateDate(input, min_from_today=0, min_period='days',
                                max_from_today=PARAMETERS.CANT_MAX_AÑOS_DESDE_FECHA_ACTUAL_MOSTRAR_CALENDARIO, max_period='years')
{
    let date = moment(input.value).endOf('day');
    let minDate = moment().subtract(min_from_today, min_period).startOf('day');
    let maxDate = moment().add(max_from_today, max_period).endOf('day');

    if(date < minDate || date > maxDate){
        changeStyleInput($(input),'La fecha ingresada no es válida',true);
    } else {
        changeStyleInput($(input),'',false);
    }
}

export function validateFromMinInputToMaxDate(input, minDateInput,
    max_from_today=PARAMETERS.CANT_MAX_AÑOS_DESDE_FECHA_ACTUAL_MOSTRAR_CALENDARIO, max_period='years')
{
    let date = moment(input.value).endOf('day');
    let minDate = moment(minDateInput.value).startOf('day');
    let maxDate = moment().add(max_from_today, max_period).endOf('day');

    if(date < minDate || date > maxDate){
        changeStyleInput($(input),'La fecha ingresada no es válida',true);
    } else {
        changeStyleInput($(input),'',false);
    }
}

export function setMinDateForInput(input, min_from_today=0, period='days'){
    let date = moment().subtract(min_from_today, period).startOf('day');
    input.attr('min', date.format('YYYY-MM-DD'));
}

export function setMaxDateForInput(input,max_from_today=0, period='days'){
    let date = moment().add(max_from_today, period).endOf('day');
    input.attr('max', date.format('YYYY-MM-DD'));
}

export function comeBackOldPositionScroll(){
    if(localStorage.getItem('oldPositionScroll')){
        document.documentElement.scrollTop = localStorage.getItem('oldPositionScroll');
        document.body.scrollTop = localStorage.getItem('oldPositionScroll');
    }
}

export function saveOldPositionScroll(){
    let oldPositionScroll = document.documentElement.scrollTop || document.body.scrollTop;
    localStorage.setItem('oldPositionScroll', oldPositionScroll);
}

export function getMaxValueOfField(objects, nameField){
    if(objects.length === 0){
        return 0;
    }
    return Math.max.apply(Math, objects.map(function(o) { return o[nameField]; }));
}

export async function getParameters(){
    let url = $('#front-paramters').val();
    return $.get(url);
}
