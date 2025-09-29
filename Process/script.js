var shade = document.getElementById("shade");
var load = document.getElementById("load");

function disap() {
  var er_box = document.getElementById("error-box");
  er_box.classList.add("d-none");
}

var er_box = document.getElementById("error-box");

function register() {
  shade.classList.remove("hide");
  load.classList.remove("hide");
  shade.classList.add("show1");
  load.classList.add("show2");

  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var email = document.getElementById("email");
  var password = document.getElementById("password");
  var mobile = document.getElementById("mobile");
  var gender = document.getElementById("gender");

  var form = new FormData();
  form.append("f", fname.value);
  form.append("l", lname.value);
  form.append("e", email.value);
  form.append("p", password.value);
  form.append("m", mobile.value);
  form.append("g", gender.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      if (response == "success") {
        fname.value = "";
        lname.value = "";
        email.value = "";
        password.value = "";
        mobile.value = "";

        shade.classList.add("hide");
        load.classList.add("hide");
        shade.classList.remove("show1");
        load.classList.remove("show2");

    

        setTimeout(function () {
          document.getElementById("error-box").innerHTML =
            "Registration Successful";
          document.getElementById("error-box").className = "ok-show";
          er_box.classList.remove("d-none");
        }, 300);
      } else {
        shade.classList.add("hide");
        load.classList.add("hide");
        shade.classList.remove("show1");
        load.classList.remove("show2");


        setTimeout(function () {
          document.getElementById("error-box").innerHTML = response;
          document.getElementById("error-box").className = "error-show";
          er_box.classList.remove("d-none");
        }, 300);
      }
    }
  };

  request.open("POST", "Process/registerProcess.php", true);
  request.send(form);
}

function signin() {
  shade.classList.remove("hide");
  load.classList.remove("hide");
  shade.classList.add("show1");
  load.classList.add("show2");

  var email = document.getElementById("email2");
  var password = document.getElementById("password2");
  var rememberme = document.getElementById("rememberme");

  var form = new FormData();
  form.append("e", email.value);
  form.append("p", password.value);
  form.append("r", rememberme.checked);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      if (response == "success") {
        email.value = "";
        password.value = "";
        shade.classList.add("hide");
        load.classList.add("hide");
        shade.classList.remove("show1");
        load.classList.remove("show2");


        setTimeout(function () {
          window.location = "index.php";
        }, 300);
      } else if (response == "blocked") {
        shade.classList.add("hide");
        load.classList.add("hide");
        shade.classList.remove("show1");
        load.classList.remove("show2");

        setTimeout(function () {
          showAlert(
            "You have been Blocked!",
            "Zedcore has blocked you from using this application. If you think this is a mistake, feel free to contact Zedcore support team. fstwhatsapp@gmail.com",
            "error"
          );
        }, 300);
      } else {
        shade.classList.add("hide");
        load.classList.add("hide");
        shade.classList.remove("show1");
        load.classList.remove("show2");
       

        setTimeout(function () {
          document.getElementById("error-box").innerHTML = response;
          document.getElementById("error-box").className = "error-show";
          er_box.classList.remove("d-none");
        }, 300);
      }
    }
  };

  request.open("POST", "Process/signInProcess.php", true);
  request.send(form);
}

function verifymdl() {
  var modal = document.getElementById("fpmodal");
  forgotPasswordModal = new bootstrap.Modal(modal, {});
  forgotPasswordModal.show();
  er_box.classList.remove("d-none");
}
var emailsentModal;
var forgotPasswordModal;
function fgPw() {
  shade.classList.remove("hide");
  load.classList.remove("hide");
  shade.classList.add("show1");
  load.classList.add("show2");

  var email = document.getElementById("email2");
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;

      if (response == "Success") {
        shade.classList.add("hide");
        load.classList.add("hide");
        shade.classList.remove("show1");
        load.classList.remove("show2");


        setTimeout(function () {
          var modal = document.getElementById("emsent");
          emailsentModal = new bootstrap.Modal(modal, {});
          emailsentModal.show();
          er_box.classList.remove("d-none");
        }, 300);
      } else {
        shade.classList.add("hide");
        load.classList.add("hide");
        shade.classList.remove("show1");
        load.classList.remove("show2");



        setTimeout(function () {
          document.getElementById("error-box").innerHTML = response;
          document.getElementById("error-box").className = "error-show";
          er_box.classList.remove("d-none");
        }, 300);
      }
    }
  };

  request.open("GET", "Process/forgotPassword.php?e=" + email.value, true);
  request.send();
}

function closemodl1() {
  shade.classList.add("hide");
  load.classList.add("hide");
  shade.classList.remove("show1");
  load.classList.remove("show2");
}
function closemodl2() {
  shade.classList.add("hide");
  load.classList.add("hide");
  shade.classList.remove("show1");
  load.classList.remove("show2");
}

var forgotPasswordModal2;
function ckCode() {
  shade.classList.remove("hide");
  load.classList.remove("hide");
  shade.classList.add("show1");
  load.classList.add("show2");

  var code = document.getElementById("code");

  var form = new FormData();
  form.append("c", code.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;

      if (response == "success") {
        code.value = "";
        document.getElementById("error-boxpop").classList.remove("error-show");
        er_box.classList.add("d-none");
        forgotPasswordModal.hide();
        shade.classList.add("hide");
        load.classList.add("hide");
        shade.classList.remove("show1");
        load.classList.remove("show2");
        var modal = document.getElementById("fpmoda2");
        forgotPasswordModal2 = new bootstrap.Modal(modal, {});
        forgotPasswordModal2.show();
        er_box.classList.remove("d-none");
      } else {
        shade.classList.add("hide");
        load.classList.add("hide");
        shade.classList.remove("show1");
        load.classList.remove("show2");
        document.getElementById("error-boxpop").innerHTML = response;
        document.getElementById("error-boxpop").classList.add("error-show");
        er_box.classList.remove("d-none");
      }
    }
  };

  request.open("POST", "Process/pwCode.php", true);
  request.send(form);
}

function upDt() {
  shade.classList.remove("hide");
  load.classList.remove("hide");
  shade.classList.add("show1");
  load.classList.add("show2");

  var pw1 = document.getElementById("pw1");
  var pw2 = document.getElementById("pw2");
  var email = document.getElementById("email2");

  var form = new FormData();
  form.append("p1", pw1.value);
  form.append("p2", pw2.value);
  form.append("e", email.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;

      if (response == "success") {
        pw1.value = "";
        pw2.value = "";

        shade.classList.add("hide");
        load.classList.add("hide");
        shade.classList.remove("show1");
        load.classList.remove("show2");

        forgotPasswordModal2.hide();


        setTimeout(function () {
          document.getElementById("error-box").innerHTML =
            "Password changed successfully";
          document.getElementById("error-box").className = "ok-show";
          er_box.classList.remove("d-none");
        }, 300);
      } else {
        shade.classList.add("hide");
        load.classList.add("hide");
        shade.classList.remove("show1");
        load.classList.remove("show2");

        setTimeout(function () {
          document.getElementById("error-boxpop2").innerHTML = response;
          document.getElementById("error-boxpop2").className = "error-show";
          er_box.classList.remove("d-none");
        }, 300);
      }
    }
  };

  request.open("POST", "Process/updatePw.php", true);
  request.send(form);
}

function showAlert(title, text, icon) {
  Swal.fire({
    title: title,
    text: text,
    icon: icon,
  });
}
