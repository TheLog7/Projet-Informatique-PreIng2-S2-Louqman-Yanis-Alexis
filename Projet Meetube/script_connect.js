const movingText = document.getElementById('moving-text');

document.addEventListener('mousemove', (e) => {
  const xPos = 10 -((e.clientX / window.innerWidth) * 7);
  const yPos = 10 - ((e.clientY / window.innerHeight) * 7);
  
  movingText.style.transform = `translate(-${xPos}%, -${yPos}%)`;
});

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