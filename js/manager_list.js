

document.getElementById("btn_signin_manager").onclick = function () {
    document.getElementById("signin_manager").style.opacity = 1;
    document.getElementById("signin_manager").style.visibility = "visible";
    document.getElementById("main_manager_list").style.filter = "blur(4px)";
}

document.getElementById("exit_signin_manager").onclick = function () {
    document.getElementById("signin_manager").style.opacity = 0;
    document.getElementById("signin_manager").style.visibility = "hidden";
    document.getElementById("main_manager_list").style.filter = "none";
}


