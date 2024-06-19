
document.getElementById("btn_change_real_estate").onclick = function () {
    document.getElementById("change_real_estate").style.visibility = "visible";
    document.getElementById("main_real_estate_info").style.filter = "blur(8px)";
    document.getElementById("change_real_estate").style.opacity = "1";
    document.getElementById("change_real_estate").style.zIndex = "100";
}

document.getElementById("exit_change_info").onclick = function () {
    document.getElementById("change_real_estate").style.visibility = "hidden";
    document.getElementById("main_real_estate_info").style.filter = "blur(0px)";
    document.getElementById("change_real_estate").style.opacity = "0";
    document.getElementById("change_real_estate").style.zIndex = "1";
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

document.getElementById("btn_insert_photo").onclick = function () {
    document.getElementById("insert_photo").style.visibility = "visible";
    document.getElementById("main_real_estate_info").style.filter = "blur(8px)";
    document.getElementById("insert_photo").style.opacity = "1";
    document.getElementById("insert_photo").style.zIndex = "100";
}

document.getElementById("btn_exit_insert").onclick = function () {
    document.getElementById("insert_photo").style.visibility = "hidden";
    document.getElementById("main_real_estate_info").style.filter = "blur(0px)";
    document.getElementById("insert_photo").style.opacity = "0";
    document.getElementById("insert_photo").style.zIndex = "1";
}








