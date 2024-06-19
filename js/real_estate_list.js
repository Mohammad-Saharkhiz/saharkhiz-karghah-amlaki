
document.getElementById("btn_serch").onclick = function () {
    if ( document.getElementById("icon_serch").className == "fa-solid fa-chevron-down")
    {
        document.getElementById("serch_form").style.opacity = 0;
        document.getElementById("serch_form").style.visibility = "hidden";
        setTimeout(function () {
            document.getElementById("icon_serch").className = "fa-solid fa-chevron-down fa-rotate-90";
            document.getElementById("under_list").style.height = "60px";
        } , 400)
    }
    else
    {
        document.getElementById("icon_serch").className = "fa-solid fa-chevron-down";
        document.getElementById("under_list").style.height = "160px";
        setTimeout(function () {
            document.getElementById("serch_form").style.opacity = 1;
            document.getElementById("serch_form").style.visibility = "visible";
        } , 400)
    }
}

document.getElementById("btn_new_real_estate").onclick = function () {
    document.getElementById("new_real_estate").style.visibility = "visible";
    document.getElementById("main_real_estate_list").style.filter = "blur(8px)";
    document.getElementById("new_real_estate").style.opacity = "1";
    document.getElementById("new_real_estate").style.zIndex = "100";
}

document.getElementById("exit_change_info").onclick = function () {
    document.getElementById("new_real_estate").style.visibility = "hidden";
    document.getElementById("main_real_estate_list").style.filter = "blur(0px)";
    document.getElementById("new_real_estate").style.opacity = "0";
    document.getElementById("new_real_estate").style.zIndex = "1";
}

setInterval( function () {
    let value = document.getElementById( 'type_build' ).value;
    if ( value == "apartment" )
    {
        document.getElementById("unit").style.display = "inline-block";
        document.getElementById("floor").style.display = "inline-block";
        document.getElementById("equipment").style.display = "inline-block";
        document.getElementById("foundation").style.display = "inline-block";
        document.getElementById("room_number").style.display = "inline-block";
        document.getElementById("history").style.display = "inline-block";
        document.getElementById("input").style.display = "inline-block";
    }
    else if ( value == "villa" )
    {
        document.getElementById("unit").style.display = "none";
        document.getElementById("floor").style.display = "none";
        document.getElementById("equipment").style.display = "inline-block";
        document.getElementById("foundation").style.display = "inline-block";
        document.getElementById("room_number").style.display = "inline-block";
        document.getElementById("history").style.display = "inline-block";
        document.getElementById("input").style.display = "inline-block";
    }
    else if ( value == "earth" )
    {
        document.getElementById("unit").style.display = "none";
        document.getElementById("floor").style.display = "none";
        document.getElementById("equipment").style.display = "none";
        document.getElementById("foundation").style.display = "none";
        document.getElementById("room_number").style.display = "none";
        document.getElementById("history").style.display = "none";
        document.getElementById("input").style.display = "none";
    }

    value = document.getElementById( 'type_transaction' ).value;
    if ( value == "buy_sell" )
    {
        document.getElementById("price").style.display = "inline-block";
        document.getElementById("mortgage").style.display = "none";
        document.getElementById("rent").style.display = "none";
    }
    else if ( value == "mortgage_rent" )
    {
        document.getElementById("price").style.display = "none";
        document.getElementById("mortgage").style.display = "inline-block";
        document.getElementById("rent").style.display = "inline-block";
    }
    else if ( value == "exchange" )
    {
        document.getElementById("price").style.display = "none";
        document.getElementById("mortgage").style.display = "none";
        document.getElementById("rent").style.display = "none";
    }
    else if ( value == "presell" )
    {
        document.getElementById("price").style.display = "inline-block";
        document.getElementById("mortgage").style.display = "none";
        document.getElementById("rent").style.display = "none";
    }

}, 500)
