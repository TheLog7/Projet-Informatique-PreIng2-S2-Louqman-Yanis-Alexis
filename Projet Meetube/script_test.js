const ThemeBtn = document.getElementById('on');

ThemeBtn.addEventListener("change", function() {
    if(this.checked) {
        document.body.className = "body-dark";
    } else {
        document.body.className = "body-light";
    }
});