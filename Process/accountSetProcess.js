var shade = document.getElementById("shade");
var load = document.getElementById("load");

var msgBox = document.getElementById("msg_box");
var msgBox2 = document.getElementById("msg_box2");
var msgBox3 = document.getElementById("msg_box3");

function profileSave() {
  shade.classList.remove("hide");
  load.classList.remove("hide");
  shade.classList.add("show1");
  load.classList.add("show2");

  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var day = document.getElementById("day");
  var month = document.getElementById("month");
  var year = document.getElementById("year");
  var mobile = document.getElementById("mobile");
  var img = document.getElementById("newProfile");

  var form = new FormData();

  form.append("f", fname.value);
  form.append("l", lname.value);
  form.append("d", day.value);
  form.append("m", month.value);
  form.append("y", year.value);
  form.append("mob", mobile.value);
  form.append("i", img.files[0]);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      if (response == "success") {
        shade.classList.add("hide");
        load.classList.add("hide");
        shade.classList.remove("show1");
        load.classList.remove("show2");
        var delayInMilliseconds = 300; //1 second

        setTimeout(function () {
          msgBox.classList.remove("d-none");
          msgBox.classList.add("done");
          msgBox.classList.remove("error");
          msgBox.innerHTML = "Profile updated successfully.";
          window.location.reload();
        }, delayInMilliseconds);
      } else {
        shade.classList.add("hide");
        load.classList.add("hide");
        shade.classList.remove("show1");
        load.classList.remove("show2");

        msgBox.classList.remove("d-none");
        msgBox.classList.remove("done");
        msgBox.classList.add("error");
        msgBox.innerHTML = response;
      }
    }
  };

  request.open("POST", "Process/accSetProcess.php", true);
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
        var delayInMilliseconds = 300; //1 second

        setTimeout(function () {
          //your code to be executed after 1 second
          var modal = document.getElementById("emsent2");
          emailsentModal = new bootstrap.Modal(modal, {});
          emailsentModal.show();
          er_box.classList.remove("d-none");
        }, delayInMilliseconds);
      } else {
        shade.classList.add("hide");
        load.classList.add("hide");
        shade.classList.remove("show1");
        load.classList.remove("show2");

        var delayInMilliseconds = 300; //1 second

        setTimeout(function () {
          //your code to be executed after 1 second
          msgBox.classList.remove("d-none");
          msgBox.classList.remove("done");
          msgBox.classList.add("error");
          msgBox.innerHTML = response;
        }, delayInMilliseconds);
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

  var pw1 = document.getElementById("password2");
  var pw2 = document.getElementById("password");
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

        var delayInMilliseconds = 300; //1 second

        setTimeout(function () {
          //your code to be executed after 1 second
          msgBox2.classList.remove("d-none");
          msgBox2.classList.add("done");
          msgBox2.classList.remove("error");
          msgBox2.innerHTML = "Password changed successfully.";
        }, delayInMilliseconds);
      } else {
        shade.classList.add("hide");
        load.classList.add("hide");
        shade.classList.remove("show1");
        load.classList.remove("show2");
        var delayInMilliseconds = 300; //1 second

        setTimeout(function () {
          //your code to be executed after 1 second
          document.getElementById("error-boxpop2").innerHTML = response;
          document.getElementById("error-boxpop2").classList.add("error-show");
          er_box.classList.remove("d-none");
        }, delayInMilliseconds);
      }
    }
  };

  request.open("POST", "Process/updatePw.php", true);
  request.send(form);
}

function saveaddress(){
  shade.classList.remove("hide");
  load.classList.remove("hide");
  shade.classList.add("show1");
  load.classList.add("show2");

  var address1 = document.getElementById("inputAddress");
  var city = document.getElementById("city");
  var district = document.getElementById("district");
  var province = document.getElementById("province");
  var zipcode = document.getElementById("inputZip");

  var form = new FormData();
  form.append("a1", address1.value);
  form.append("c", city.value);
  form.append("d", district.value);
  form.append("p", province.value);
  form.append("z", zipcode.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function(){
    if(request.readyState == 4 & request.status == 200){
      var response = request.responseText;
      if(response == "success"){
        var delayInMilliseconds = 300; //1 second
        shade.classList.add("hide");
        load.classList.add("hide");
        shade.classList.remove("show1");
        load.classList.remove("show2");
        setTimeout(function () {
          msgBox3.classList.remove("d-none");
          msgBox3.classList.add("done");
          msgBox3.classList.remove("error");
          msgBox3.innerHTML = "address details updated successfully.";
          window.location.reload();
        }, delayInMilliseconds);
      }else{
        shade.classList.add("hide");
        load.classList.add("hide");
        shade.classList.remove("show1");
        load.classList.remove("show2");

        msgBox3.classList.remove("d-none");
        msgBox3.classList.remove("done");
        msgBox3.classList.add("error");
        msgBox3.innerHTML = response;
      }
      
    }
  }

  request.open("POST","Process/addressUpProcess.php",true);
  request.send(form);
}
