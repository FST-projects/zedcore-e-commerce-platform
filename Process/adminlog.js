var shade = document.getElementById("shade");
var load = document.getElementById("load");

function ckCode() {
  shade.classList.remove("hide");
  load.classList.remove("hide");
  shade.classList.add("show1");
  load.classList.add("show2");

  var code = document.getElementById("password2");
  var email = document.getElementById("email2");

  var form = new FormData();
  form.append("c", code.value);
  form.append("e", email.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;

      if (response == "Success") {
        code.value = "";

        shade.classList.add("hide");
        load.classList.add("hide");
        shade.classList.remove("show1");
        load.classList.remove("show2");
        setTimeout(function () {
          window.location = "admin.php";
        }, 400);
      } else if (response == "blocked") {
        shade.classList.add("hide");
        load.classList.add("hide");
        shade.classList.remove("show1");
        load.classList.remove("show2");
        Swal.fire({
          title: "Your Admin Account has been blocked!",
          text: "Zedcore has blocked your Admin Account from this application. If you think this is a mistake, feel free to contact Zedcore support team. fstwhatsapp@gmail.com",
          icon: "error",
          confirmButtonText: "OK",
        }).then((result) => {
          if (result.isConfirmed) {
            window.location = "adminlogin.php";
          }
        });
      } else {
        shade.classList.add("hide");
        load.classList.add("hide");
        shade.classList.remove("show1");
        load.classList.remove("show2");

        showAlert(response, "error");
      }
    }
  };

  request.open("POST", "Process/adminCodeVeri.php", true);
  request.send(form);
}

function reset() {
  var password = document.getElementById("password");
  var password2 = document.getElementById("password2");
  var email = document.getElementById("email");

  var form = new FormData();
  form.append("p1", password.value);
  form.append("p2", password2.value);
  form.append("e", email.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;

      if (response == "success") {
        showAlert("Password Changed Successfully", "success");
        window.location = "adminlogin.php";
      } else {
        showAlert(response, "error");
      }
    }
  };

  request.open("POST", "Process/adminResetPasswordProcess.php", true);
  request.send(form);
}

function showAlert(text, icon) {
  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 1500,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.onmouseenter = Swal.stopTimer;
      toast.onmouseleave = Swal.resumeTimer;
    },
  });
  Toast.fire({
    icon: icon,
    title: text,
  });
}
function reqpwReset() {
  var email = document.getElementById("email2");


  var form = new FormData();
  form.append("admin", email.value);
  
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;

      if (response == "success") {
        showAlert("Request Send Successfully", "success");
      } else {
        showAlert(response, "error");
      }
    }
  };

  request.open("POST", "Process/reqRestPasswordlogin.php", true);
  request.send(form);
}
