const movingText = document.getElementById('moving-text');

document.addEventListener('mousemove', (e) => {
  const xPos = 10 -((e.clientX / window.innerWidth) * 7);
  const yPos = 10 - ((e.clientY / window.innerHeight) * 7);
  
  movingText.style.transform = `translate(-${xPos}%, -${yPos}%)`;
});

const ThemeBtn = document.getElementById('on');

ThemeBtn.addEventListener("change", function() {

    if(this.checked) {

        document.body.className = "body-dark";
        let left = document.getElementsByClassName('left-column');
        left[0].className = "left-column-dark";
        let right = document.getElementsByClassName('right-column');
        right[0].className = "right-column-dark";
        let present = document.getElementsByClassName('present');
        present[0].className = "present-dark";
    } else {
        document.body.className = "body-light";
        let left = document.getElementsByClassName('left-column-dark');
        left[0].className = "left-column";
        let right = document.getElementsByClassName('right-column-dark');
        right[0].className = "right-column";
        let present = document.getElementsByClassName('present-dark');
        present[0].className = "present";
    }
});