function removeProd(pId) {
  var box = document.getElementById("pbox" + pId);
  var numrow = document.getElementById("numrow");
  var emtcart = document.getElementById("emtcart");

  if (box.classList.contains("d-flex")) {
    box.classList.remove("d-flex");
    box.classList.add("d-none");
  }
  numrow.innerHTML = parseInt(numrow.innerHTML) - 1;

  if (numrow.innerHTML == 0) {
    if (emtcart.classList.contains("d-none")) {
      emtcart.classList.remove("d-none");
      emtcart.classList.add("d-block");
    }
  }

  var form = new FormData();
  form.append("pid", pId);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      if (request.status == 200) {
        var response = request.responseText;
        if (response == "success") {
          showAlert("Product removed successfully!", "success");
        } else if (response == "fail") {
          showAlert("Something went wrong! Please relogin", "error");
        } else {
          alert("Error: " + response);
        }
      }
    }
  };
  request.open("POST", "Process/removewishProcess.php", true);
  request.send(form);
}

var modalsell = document.getElementById("staticBackdrop13");
newsellmodel = new bootstrap.Modal(modalsell, {});

function sellReg() {
  var shopnm = document.getElementById("shopnm");
  var pw = document.getElementById("pw");
  var shopalrt = document.getElementById("shopalrt");

  var form = new FormData();
  form.append("shop", shopnm.value);
  form.append("pw", pw.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      if (response == "success") {
        newsellmodel.hide();
        var modal = document.getElementById("emsent");
        emailsentModal = new bootstrap.Modal(modal, {});
        emailsentModal.show();
      } else {
        showAlert(response, "error");
      }
    }
  };
  request.open("POST", "Process/SellerReg.php", true);
  request.send(form);
}

function addToCart(pid) {
  var box = document.getElementById("pbox" + pid);
  var numrow = document.getElementById("numrow");
  var emtcart = document.getElementById("emtcart");

  if (box.classList.contains("d-flex")) {
    box.classList.remove("d-flex");
    box.classList.add("d-none");
  }
  numrow.innerHTML = parseInt(numrow.innerHTML) - 1;

  if (numrow.innerHTML == 0) {
    if (emtcart.classList.contains("d-none")) {
      emtcart.classList.remove("d-none");
      emtcart.classList.add("d-block");
    }
  }

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      if (response == "success") {
        showAlert("Product Successfully Added to My Cart!", "success");
      } else if (response == "exceed") {
        showAlert("Reached to maximum quantity!", "error");
      } else if (response == "fail") {
        showAlert("Please SignIn to Use Cart!", "error");
      } else if (response == "something") {
        showAlert("Something went wrong! Please relogin.", "error");
      } else {
        alert(response);
      }
    }
  };
  request.open("GET", "Process/addCartProcess.php?pid=" + pid, true);
  request.send();
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
