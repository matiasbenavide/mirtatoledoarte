const customSweet1button = sweetalert2.mixin({
    customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-secondary',
        input:'form-control d-flex',
        popup: 'shadow'
    },
    buttonsStyling: false
});

export function parseMessage (a) {
    let message = "";
    for (let i in a) {
        if (a.hasOwnProperty(i)) {
            message += '<p style="line-height:normal; margin-bottom: 0; color: #154193">' + a[i] + '</p>';
        }
    }
    return message;
}

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
