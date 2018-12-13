window.onload = function () {

    var btn = document.getElementById("btnsubmit");
    btn.onclick = Validate;
}

function Validate() {
    
    var name = document.getElementById("txtname");
    var log = document.getElementById("txtlogin");
    var pas = document.getElementById("txtpassword");
    var email = document.getElementById("txtemail");
    var gen = document.getElementById("txtgender");
    var adr = document.getElementById("txtaddress");
    var age = document.getElementById("txtage");
    var nic = document.getElementById("txtnic");
    var dob = document.getElementById("txtdob");
   
    var cric = "";
    var hock = "";
    var chess = "";
    if ($("#txtcricket").is(':checked')) {
        cric= 1;
    }
    else {
        cric = 0;
    }

    if ($("#txthockey").is(':checked')) {
        hock = 1;
    }
    else {
        hock= 0;
    }
    if ($("#txtchess").is(':checked')) {
        chess = 1;
    }
    else {
        chess = 0;
    }
    
    var alphaExp = /^[a-zA-Z ]+$/;
    var numExp = /^[0-9]+$/;
    var alphanumExp = /^[0-9a-zA-Z]+$/;
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if (name.value == "" || log.value == "" || pas.value == "" || email.value == "" || gen.value == "" || adr.value == "" || age.value == "" || nic.value == "" || dob.value == "") {
        alert("All values are mandatory except checkboxes");
        return false;
    }
    
    else if (!(name.value.match(alphaExp))) {
        alert("Invalid age format");
        return false;
    }
    else if (!(log.value.match(alphanumExp))) {
        alert("Invalid login format");
        return false;
    }
    else if (!(email.value.match(mailformat))) {
        alert("Invalid mail format");
        return false;
    }
    else if (Number(age.value)<=0) {
        alert("Invalid age format");
        return false;
    }
    else if (!(nic.value.match(numExp))) {
        alert("Invalid NIC format");
        return false;
    }

    //alert("here");

}