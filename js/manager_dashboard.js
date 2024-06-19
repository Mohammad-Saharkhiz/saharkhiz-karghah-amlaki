setInterval( function () {
    var MyDate = new Date().toLocaleDateString('fa-IR');
    document.getElementById("date").children[0].innerText = MyDate;
    var secend = new Date().getSeconds();
    var minute = new Date().getMinutes();
    var hour = new Date().getHours();
    document.getElementById("date").children[1].innerText = hour + ":" + minute + ":" +secend;
} , 1000);