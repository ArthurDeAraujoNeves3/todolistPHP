function openMenu() {

    let menu = document.getElementById("UserMenu");

    if ( menu.style.opacity == 0 ) {

        menu.style.opacity = 1;
        menu.style.visibility = "visible";
        menu.style.marginTop = "10px";

    } else {

        menu.style.opacity = 0;
        menu.style.visibility = "hidden";
        menu.style.marginTop = "20px";

    }

};
