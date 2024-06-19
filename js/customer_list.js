

document.getElementById("btn_signin_customer").onclick = function () {
    document.getElementById("signin_customer").style.opacity = 1;
    document.getElementById("signin_customer").style.visibility = "visible";
    document.getElementById("main_customer_list").style.filter = "blur(4px)";
}

document.getElementById("exit_signin_customer").onclick = function () {
    document.getElementById("signin_customer").style.opacity = 0;
    document.getElementById("signin_customer").style.visibility = "hidden";
    document.getElementById("main_customer_list").style.filter = "none";
}


