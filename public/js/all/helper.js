function correctPrice(preuSenseDecimals) {
    var preu = preuSenseDecimals;
    if (preu == 0) {
        document.write(" - €");
    } else {
        document.write(preu.toLocaleString("es-ES") + " €");
    }
}

function tallarText(texte, limit) {
    var puntsSuspensius = "...";
    if (texte.length > limit) {
        texte = texte.substring(0, limit) + puntsSuspensius;
    }

    return texte;
}
