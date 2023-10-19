let prevScrollPos = window.pageYOffset;
const navbar = document.getElementById("cabeca");

window.onscroll = function() {
    const currentScrollPos = window.pageYOffset;
    if (prevScrollPos > currentScrollPos) {
        
        cabeca.style.transform = "translateY(0)";
    } else {
       
        cabeca.style.transform = "translateY(-100%)";
    }
    prevScrollPos = currentScrollPos;
}



