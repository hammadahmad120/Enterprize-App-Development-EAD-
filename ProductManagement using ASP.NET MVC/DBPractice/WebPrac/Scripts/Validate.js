window.onload = function () {

    var btn = document.getElementById("btnsubmit");
    btn.onclick = Validate;
}

function Validate() {

    var name = document.getElementById("txtname");
    var log = document.getElementById("txtlogin");
    var pas = document.getElementById("txtpassword");
    var em = document.getElementById("txtemail");

    var alphaExp = /^[a-zA-Z ]+$/;
    var numExp = /^[0-9]+$/;
    var alphanumExp = /^[0-9a-zA-Z]+$/;
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
   
    if (name.value == "" || log.value == "" || pas.value == "" ) {
        alert("All values are mandatory except picture");
        return false;
    }

    else if (!(name.value.match(alphaExp))) {
        alert("Invalid name format");
        return false;
    }
    else if (em.value == "" || !(em.value.match(mailformat))) {
        alert("Provide valid email");
        return false;
    }
    else if (!(log.value.match(alphanumExp))) {
        alert("Invalid login format");
        return false;
    }

    //alert("here");

}