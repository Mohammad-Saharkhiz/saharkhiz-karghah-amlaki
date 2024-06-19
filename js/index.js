document.getElementById("start").onclick = function () {
    scroll(0,700); return false;
}

document.getElementById("btn_login_signin").onclick = function () {
    document.getElementById("login").style.opacity = 1;
    document.getElementById("login").style.visibility = "visible";
    document.getElementById("login").style.top = "60px";
    document.getElementById("signin").style.visibility = "hidden";
    document.getElementById("signin").style.opacity = 0;
    document.getElementById("signin").style.top = "40px";
    document.getElementById("main_index").style.opacity = 5;
    document.getElementById("main_index").style.filter = "blur(8px)";
}

document.getElementById("btn_exit_login").onclick = function () {
    document.getElementById("login").style.opacity = 0;
    document.getElementById("login").style.visibility = "hidden";
    document.getElementById("login").style.top = "40px";
    document.getElementById("signin").style.visibility = "hidden";
    document.getElementById("signin").style.opacity = 0;
    document.getElementById("signin").style.top = "40px";
    document.getElementById("main_index").style.opacity = 1;
    document.getElementById("main_index").style.filter = "none";
}

document.getElementById("btn_login").onclick = function () {
    document.getElementById("login").style.opacity = 1;
    document.getElementById("login").style.visibility = "visible";
    document.getElementById("login").style.top = "60px";
    document.getElementById("signin").style.visibility = "hidden";
    document.getElementById("signin").style.opacity = 0;
    document.getElementById("signin").style.top = "40px";
    document.getElementById("main_index").style.opacity = 5;
    document.getElementById("main_index").style.filter = "blur(8px)";
}

document.getElementById("btn_exit_signin").onclick = function () {
    document.getElementById("login").style.opacity = 0;
    document.getElementById("login").style.visibility = "hidden";
    document.getElementById("login").style.top = "40px";
    document.getElementById("signin").style.visibility = "hidden";
    document.getElementById("signin").style.opacity = 0;
    document.getElementById("signin").style.top = "40px";
    document.getElementById("main_index").style.opacity = 1;
    document.getElementById("main_index").style.filter = "none";
}

document.getElementById("btn_signin").onclick = function () {
    document.getElementById("login").style.opacity = 0;
    document.getElementById("login").style.visibility = "hidden";
    document.getElementById("login").style.top = "40px";
    document.getElementById("signin").style.visibility = "visible";
    document.getElementById("signin").style.opacity = 1;
    document.getElementById("signin").style.top = "60px";
    document.getElementById("main_index").style.opacity = 5;
    document.getElementById("main_index").style.filter = "blur(8px)";
}