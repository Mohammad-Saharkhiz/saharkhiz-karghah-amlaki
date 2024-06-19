//set buy_menu
document.getElementById("btn_buy").onmouseenter = function () {
    document.getElementById("buy_menu").style.opacity = 1;
    document.getElementById("buy_menu").style.visibility = "visible";
    document.getElementById("buy_menu").style.top = "45px";
    document.getElementById("rent_menu").style.visibility = "hidden";
    document.getElementById("rent_menu").style.opacity = 0;
    document.getElementById("rent_menu").style.top = "60px";
    document.getElementById("sell_menu").style.visibility = "hidden";
    document.getElementById("sell_menu").style.opacity = 0;
    document.getElementById("sell_menu").style.top = "60px";
}

document.getElementById("buy_menu").onmouseenter = function () {
    document.getElementById("buy_menu").style.opacity = 1;
    document.getElementById("buy_menu").style.visibility = "visible";
    document.getElementById("buy_menu").style.top = "45px";
    document.getElementById("rent_menu").style.visibility = "hidden";
    document.getElementById("rent_menu").style.opacity = 0;
    document.getElementById("rent_menu").style.top = "60px";
    document.getElementById("sell_menu").style.visibility = "hidden";
    document.getElementById("sell_menu").style.opacity = 0;
    document.getElementById("sell_menu").style.top = "60px";
}

document.getElementById("btn_buy").onmouseleave = function () {
    document.getElementById("buy_menu").style.opacity = 0;
    document.getElementById("buy_menu").style.visibility = "hidden";
    document.getElementById("buy_menu").style.top = "60px";
}

document.getElementById("buy_menu").onmouseleave = function () {
    document.getElementById("buy_menu").style.opacity = 0;
    document.getElementById("buy_menu").style.visibility = "hidden";
    document.getElementById("buy_menu").style.top = "60px";
}

//set rent_menu
document.getElementById("btn_rent").onmouseenter = function () {
    document.getElementById("rent_menu").style.opacity = 1;
    document.getElementById("rent_menu").style.visibility = "visible";
    document.getElementById("rent_menu").style.top = "45px";
    document.getElementById("buy_menu").style.visibility = "hidden";
    document.getElementById("buy_menu").style.opacity = 0;
    document.getElementById("buy_menu").style.top = "60px";
    document.getElementById("sell_menu").style.visibility = "hidden";
    document.getElementById("sell_menu").style.opacity = 0;
    document.getElementById("sell_menu").style.top = "60px";
}

document.getElementById("rent_menu").onmouseenter = function () {
    document.getElementById("rent_menu").style.opacity = 1;
    document.getElementById("rent_menu").style.visibility = "visible";
    document.getElementById("rent_menu").style.top = "45px";
    document.getElementById("buy_menu").style.visibility = "hidden";
    document.getElementById("buy_menu").style.opacity = 0;
    document.getElementById("buy_menu").style.top = "60px";
    document.getElementById("sell_menu").style.visibility = "hidden";
    document.getElementById("sell_menu").style.opacity = 0;
    document.getElementById("sell_menu").style.top = "60px";
}

document.getElementById("btn_rent").onmouseleave = function () {
    document.getElementById("rent_menu").style.opacity = 0;
    document.getElementById("rent_menu").style.visibility = "hidden";
    document.getElementById("rent_menu").style.top = "60px";
}

document.getElementById("rent_menu").onmouseleave = function () {
    document.getElementById("rent_menu").style.opacity = 0;
    document.getElementById("rent_menu").style.visibility = "hidden";
    document.getElementById("rent_menu").style.top = "60px";
}

//set sell_menu
document.getElementById("btn_sell").onmouseenter = function () {
    document.getElementById("sell_menu").style.opacity = 1;
    document.getElementById("sell_menu").style.visibility = "visible";
    document.getElementById("sell_menu").style.top = "45px";
    document.getElementById("buy_menu").style.visibility = "hidden";
    document.getElementById("buy_menu").style.opacity = 0;
    document.getElementById("buy_menu").style.top = "60px";
    document.getElementById("rent_menu").style.visibility = "hidden";
    document.getElementById("rent_menu").style.opacity = 0;
    document.getElementById("rent_menu").style.top = "60px";
}

document.getElementById("sell_menu").onmouseenter = function () {
    document.getElementById("sell_menu").style.opacity = 1;
    document.getElementById("sell_menu").style.visibility = "visible";
    document.getElementById("sell_menu").style.top = "45px";
    document.getElementById("buy_menu").style.visibility = "hidden";
    document.getElementById("buy_menu").style.opacity = 0;
    document.getElementById("buy_menu").style.top = "60px";
    document.getElementById("rent_menu").style.visibility = "hidden";
    document.getElementById("rent_menu").style.opacity = 0;
    document.getElementById("rent_menu").style.top = "60px";
}

document.getElementById("btn_sell").onmouseleave = function () {
    document.getElementById("sell_menu").style.opacity = 0;
    document.getElementById("sell_menu").style.visibility = "hidden";
    document.getElementById("sell_menu").style.top = "60px";
}

document.getElementById("sell_menu").onmouseleave = function () {
    document.getElementById("sell_menu").style.opacity = 0;
    document.getElementById("sell_menu").style.visibility = "hidden";
    document.getElementById("sell_menu").style.top = "60px";
}

document.getElementById("btn_call").onclick = function () {
    scroll(0,3000); return false;
}


