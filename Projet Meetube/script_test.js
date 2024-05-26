const ThemeBtn = document.getElementById('on');

ThemeBtn.addEventListener("change", function() {
    // Vérifiez si la case à cocher est cochée
    if(this.checked) {
        // Si elle est cochée, changez la classe du body à "body-classe2"
        document.body.className = "body-dark";
    } else {
        // Sinon, changez la classe du body à "body-classe1"
        document.body.className = "body-light";
    }
});