function correctPrice(preuSenseDecimals) {
    var preu = preuSenseDecimals;
    if(preu == 0) {
        document.write(" - €");
    } else {
        document.write(preu.toLocaleString('es-ES') + " €");
    }
}