const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});

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
    } else {
        document.body.className = "body-light";
    }
});