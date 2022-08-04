function setString(input) {
    var regex = new RegExp('[^a-zA-Z\s]+$', 'g');
    input.value = input.value.replaceAll(regex, '');

}

function setDecimal(input) {
    var regex = new RegExp('[^0-9]+$', 'g');
    var valor = input.value.replaceAll(regex, '');
    var saida = 0.00;
    if (!isNaN(parseFloat(valor))) {
        saida = parseFloat(valor).toFixed(2);
    }

    input.value = saida;
}

function setInteiro(input) {
    var regex = new RegExp('[^0-9]', 'g');
    input.value = input.value.replaceAll(regex, '');
}

function setSku(input) {
    var regex = new RegExp('[a-zA-Z\s]+$', 'g');
    input.value = input.value.replaceAll(regex, '');
}