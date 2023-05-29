const customSweet1button = sweetalert2.mixin({
    customClass: {
        confirmButton: 'btn button',
        cancelButton: 'btn button',
        input:'form-control d-flex',
        popup: 'shadow'
    },
    buttonsStyling: false
});

export function showSuccess (m = ['¡ La operación fue realizada !'], functionPostAction = null) {
    customSweet1button.fire({
        html: parseMessage(m),
        icon: "success",
    }).then((value) => {
        console.log(functionPostAction);
        if (functionPostAction)
            functionPostAction();
    });
}

export function showErrors (m = ['¡ La operación no pudo ser realizada !'], functionPostAction = null) {
    customSweet1button.fire({
        html: parseMessage(m),
        icon: "error",
    }).then((value) => {
        if (functionPostAction)
            functionPostAction();
    });
}


window.showSuccess = showSuccess;
window.showErrors = showErrors;
