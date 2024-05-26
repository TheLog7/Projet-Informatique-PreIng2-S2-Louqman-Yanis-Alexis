const ThemeBtn = document.getElementById('on');

ThemeBtn.addEventListener("change", function() {
    if(this.checked) {
        document.body.className = "body-dark";
        let present = document.getElementsByClassName('present');
        present[0].className = "present-dark";
        let header = document.getElementsByClassName('header');
        header[0].className = "header-dark";
    } else {
        document.body.className = "body-light";
        let present = document.getElementsByClassName('present-dark');
        present[0].className = "present";
        let header = document.getElementsByClassName('header-dark');
        header[0].className = "header";
    }
});