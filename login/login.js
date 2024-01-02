//navigation bar

const toggleBtn= document.querySelector('.toggle_btn')
const toggleBtnIcon= document.querySelector('.toggle_btn i')
const dropDownMenu= document.querySelector('.dropdown_menu')

    toggleBtn.onclick= function(){
        dropDownMenu.classList.toggle('open')
        const isOpen= dropDownMenu.classList.contains('open')

        toggleBtnIcon.classList= isOpen
        ? 'fa-solid fa-xmark'
        : 'fa-solid fa-bars'
    }



const inputs = document.querySelectorAll(".input-field");
const toggle_btn = document.querySelectorAll(".toggle");
const main = document.querySelector("main");
const bullets = document.querySelectorAll(".bullets span");
const images = document.querySelectorAll(".image");

inputs.forEach((inp) => {
  inp.addEventListener("focus", () => {
    inp.classList.add("active");
  });
  inp.addEventListener("blur", () => {
    if (inp.value != "") return;
    inp.classList.remove("active");
  });
});

/*
toggle_btn.forEach((btn) => {
  btn.addEventListener("click", () => {
    main.classList.toggle("sign-up-mode");
  });
});*/

function moveSlider() {
  let index = this.dataset.value;

  let currentImage = document.querySelector(`.img-${index}`);
  images.forEach((img) => img.classList.remove("show"));
  currentImage.classList.add("show");

  const textSlider = document.querySelector(".text-group");
  textSlider.style.transform = `translateY(${-(index - 1) * 2.2}rem)`;

  bullets.forEach((bull) => bull.classList.remove("active"));
  this.classList.add("active");
}

bullets.forEach((bullet) => {
  bullet.addEventListener("click", moveSlider);
});


/* SHOW PASSWORD */
const getId=(id)=>document.getElementById(id);
const getSl=(selector)=>document.querySelector(selector);

const password=getId("password");
const show_hide_password=getId("show_hide_password");

if(password){
  show_hide_password.addEventListener("click",function(){
    if(password.type==="password"){
      password.type="text";
      show_hide_password.innerText="Hide";
    }else{
      password.type="password";
      show_hide_password.innerText="Show";

    }
  })
}