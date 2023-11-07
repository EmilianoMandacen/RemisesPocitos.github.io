function formatoTelefono(input) {

    let numero = input.value.replace(/\D/g, '');

    let formattedNumber = '';
    for (let i = 0; i < numero.length; i++) {
        if (i === 3 || i === 6) {
            formattedNumber += '-';
        }
        formattedNumber += numero[i];
    }


    input.value = formattedNumber;
}
