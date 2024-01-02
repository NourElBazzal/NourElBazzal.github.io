
/*var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n){
    showSlides(slideIndex +=n);
}

function currentSlide(n){
    showSlides(slideIndex = n);
}

function showSlides(n){
    var i;
    var slides= document.getElementsByClassName("mySlides");
    var dots= document.getElementsByClassName("dot");
    if(n > slides.length){slideIndex = 1}
    if(n < 1) {slideIndex = slides.length}
    for(i=0; i< slides.length; i++){
        slides[i].style.display= "none";
    }
    for(i = 0; i < dots.length; i++){
        dots[i].className= dots[i].className.replace(" active", "");
    }
    slides[slideIndex -1].style.display= "block";
    dots[slideIndex -1].className += "active";
}
*/

//Auto slide
var slideIndex =0;
showSlides();

function showSlides(){
    var i;
    var slides= document.getElementsByClassName("mySlides");
    for(i=0; i< slides.length; i++){
        slides[i].style.display= "none";
    }
    slideIndex++;
    if(slideIndex > slides.length){
        slideIndex =1;
    }
    slides[slideIndex -1].style.display="block";
    setTimeout(showSlides, 2000);
}


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

document.addEventListener('scroll', () =>{
    const header= document.querySelector('header');

    if(window.scrollY > 100){
        header.classList.add('scrolled');
    }
    else{
        header.classList.remove('scrolled'); 
    }

});

 //common reveal options to create reveal animations
 ScrollReveal({
    //reset : true,
    distance : '60px',
    duration: 2500,
    delay: 400
});

ScrollReveal().reveal('.main-title , .section-title', {delay : 500,  origin: 'left'});
ScrollReveal().reveal('.sec-01 .image .info', {delay : 600,  origin: 'bottom'});
ScrollReveal().reveal('.sec .content .text-box', {delay : 700,  origin: 'right'});
ScrollReveal().reveal('.media-icons i', {delay : 500,  origin: 'bottom' , interval: 200});
ScrollReveal().reveal('.sec-02 .image, .sec-03 .image', {delay : 500,  origin: 'top' });
ScrollReveal().reveal('.media-info li', {delay : 500,  origin: 'left', interval: 200 });
