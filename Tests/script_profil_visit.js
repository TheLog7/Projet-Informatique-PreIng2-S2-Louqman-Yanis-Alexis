const ThemeBtn = document.getElementById('on');

ThemeBtn.addEventListener("change", function() {
    // Vérifiez si la case à cocher est cochée
    if(this.checked) {
        // Si elle est cochée, changez la classe du body à "body-classe2"
        document.body.className = "body-dark";
        let present = document.getElementsByClassName('present');
        present[0].className = "present-dark";
        let header = document.getElementsByClassName('header');
        header[0].className = "header-dark";
    } else {
        // Sinon, changez la classe du body à "body-classe1"
        document.body.className = "body-light";
        let present = document.getElementsByClassName('present-dark');
        present[0].className = "present";
        let header = document.getElementsByClassName('header-dark');
        header[0].className = "header";
    }
});