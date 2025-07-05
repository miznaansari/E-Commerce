
var displayheight = window.innerHeight;
let i = 0
var ab = document.getElementsByClassName('nav-mobile');
displayheights = displayheight +200;
document.getElementById('sidenav').addEventListener('click', function () {
  if (i % 2 == 0) {
    ab[0].style.width = "100%";
    ab[0].style.height = displayheights  + "px";
    ab[0].style.position = "fixed"; // Set position to sticky
    ab[0].style.top = "45px";       // Set top to 55px
  } else {
    ab[0].style.width = "0px";
    ab[0].style.position = "fixed"; // Reset position
    ab[0].style.top = "45px";      // Reset top
  }
  i++;
});


window.addEventListener("scroll", () => {
  let scroll = window.scrollY;
  if (scroll > 100) {
    document.getElementsByTagName('header')[0].style.paddingTop = "0px";
    document.getElementsByTagName('header')[0].style.paddingBottom = "0px";
    document.getElementsByClassName('searchicon')[0].style.setProperty('top', '17px', 'important');


  } else {
    document.getElementsByTagName('header')[0].style.paddingTop = "10px";
    document.getElementsByTagName('header')[0].style.paddingBottom = "10px";
    document.getElementsByClassName('searchicon')[0].style.setProperty('top', '28px', 'important');

  }
});