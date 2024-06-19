

document.getElementById("btn_menu_manager").onclick = function () {
    if (document.getElementById("menu_manager").style.visibility == "hidden")
    {
        document.getElementById("menu_manager").style.opacity = 1;
        document.getElementById("menu_manager").style.visibility = "visible";
        document.getElementById("menu_manager").style.right = "0";
    }
    else
    {
        document.getElementById("menu_manager").style.opacity = 0;
        document.getElementById("menu_manager").style.visibility = "hidden";
        document.getElementById("menu_manager").style.right = "-275px";
    }
}

document.getElementById("btn_user").onmouseenter = function () {
    document.getElementById("menu_user").style.opacity = 1;
    document.getElementById("menu_user").style.visibility = "visible";
}

document.getElementById("menu_user").onmouseenter = function () {
    document.getElementById("menu_user").style.opacity = 1;
    document.getElementById("menu_user").style.visibility = "visible";
}

document.getElementById("btn_user").onmouseleave = function () {
    document.getElementById("menu_user").style.opacity = 0;
    document.getElementById("menu_user").style.visibility = "hidden";
}

document.getElementById("menu_user").onmouseleave = function () {
    document.getElementById("menu_user").style.opacity = 0;
    document.getElementById("menu_user").style.visibility = "hidden";
}