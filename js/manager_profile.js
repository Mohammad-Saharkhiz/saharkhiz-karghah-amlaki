document.getElementById("btn_change_info").onclick = function () {
    document.getElementById("change_info").style.opacity = 1;
    document.getElementById("change_info").style.visibility = "visible";
    document.getElementById("main_manager_profile").style.filter = "blur(4px)";
}

document.getElementById("exit_change_info").onclick = function () {
    document.getElementById("change_info").style.opacity = 0;
    document.getElementById("change_info").style.visibility = "hidden";
    document.getElementById("main_manager_profile").style.filter = "none";
}