var summeryBox = document.getElementById("sumHolder");
var sum2box = document.getElementById("sumbox");

function qtyup(pId, Tqty) {
  var qtyFeild = document.getElementById("amount" + pId);
  var tikbg = document.getElementById("tik" + pId);

  if (parseInt(qtyFeild.value) < Tqty) {
    qtyFeild.value = parseInt(qtyFeild.value) + 1;

    var form = new FormData();
    form.append("pid", pId);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
      if (request.readyState == 4) {
        if (request.status == 200) {
          var response = request.responseText;
          if (response == "success") {
            paymentDetailsUpdate();
            //added
          } else {
            alert("Error: " + response);
          }
        }
      }
    };

    request.open("POST", "Process/qtyUpProcess.php", true);
    request.send(form);
  } else {
    showAlert("Reached to maximum quantity!", "error");
  }
}

function qtydown(pId) {
  var qtyFeild = document.getElementById("amount" + pId);
  var tikbg = document.getElementById("tik" + pId);

  if (parseInt(qtyFeild.value) > 1) {
    qtyFeild.value = parseInt(qtyFeild.value) - 1;

    var form = new FormData();
    form.append("pid", pId);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
      if (request.readyState == 4) {
        if (request.status == 200) {
          var response = request.responseText;
          if (response == "success") {
            paymentDetailsUpdate();
            //subbed

          } else {
            alert("Error: " + response);
          }
        }
      }
    };

    request.open("POST", "Process/qtyDownProcess.php", true);
    request.send(form);
  } else {
    showAlert("Reached to minimum quantity!", "error");
  }
}

function removeProd(pId) {
  var box = document.getElementById("pbox" + pId);
  var numrow = document.getElementById("numrow");
  var emtcart = document.getElementById("emtcart");
  var tik = document.getElementById("d" + pId);

  if (tik) {
    if (tik.checked == true) {
      multipurch(pId);
    }
  }

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
        } else {
          alert("Error: " + response);
        }
      }
    }
  };
  request.open("POST", "Process/pRemoveProcess.php", true);
  request.send(form);
}

function multipurch(id) {
  var tik = document.getElementById("d" + id);
  var tikbg = document.getElementById("tik" + id);
  var summeryBox = document.getElementById("sumHolder");
  var sum2box = document.getElementById("sumbox");
  var itemnum = document.getElementById("itemnum");
  var itemprice = document.getElementById("itemprice");
  var del = document.getElementById("delivery");
  var total = document.getElementById("total");

  if (tik.checked == true) {
    tikbg.classList.add("tikchang");

    summeryBox.classList.remove("sumHide");
    sum2box.classList.remove("sumHide");
    sum2box.classList.remove("sumpadoff");
    summeryBox.classList.add("sumShow");
    sum2box.classList.add("sumShow");
    sum2box.classList.add("sumpad");
  } else {
    tikbg.classList.remove("tikchang");
  }

  var form = new FormData();
  form.append("id", id);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      if (request.status == 200) {
        var response = request.responseText;
        var obj = JSON.parse(response);

        itemnum.innerHTML = obj["totItems"];
        itemprice.innerHTML = obj["price"];
        del.innerHTML = obj["del"];
        total.innerHTML = obj["total"];

        if (obj["totItems"] == 0) {
          itemnum.innerHTML = obj["totItems"];
          itemprice.innerHTML = obj["price"];
          del.innerHTML = obj["del"];
          total.innerHTML = obj["total"];

          summeryBox.classList.remove("sumShow");
          sum2box.classList.remove("sumShow");
          sum2box.classList.remove("sumpad");
          summeryBox.classList.add("sumHide");
          sum2box.classList.add("sumHide");
          sum2box.classList.add("sumpadoff");
        }
      }
    }
  };

  request.open("POST", "Process/cartProcess.php", true);
  request.send(form);
}
function paymentDetailsUpdate() {
  var summeryBox = document.getElementById("sumHolder");
  var sum2box = document.getElementById("sumbox");
  var itemnum = document.getElementById("itemnum");
  var itemprice = document.getElementById("itemprice");
  var del = document.getElementById("delivery");
  var total = document.getElementById("total");


  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      if (request.status == 200) {
        var response = request.responseText;

        var obj = JSON.parse(response);

        itemnum.innerHTML = obj["totItems"];
        itemprice.innerHTML = obj["price"];
        del.innerHTML = obj["del"];
        total.innerHTML = obj["total"];

        if (obj["totItems"] == 0) {
          itemnum.innerHTML = obj["totItems"];
          itemprice.innerHTML = obj["price"];
          del.innerHTML = obj["del"];
          total.innerHTML = obj["total"];

          summeryBox.classList.remove("sumShow");
          sum2box.classList.remove("sumShow");
          sum2box.classList.remove("sumpad");
          summeryBox.classList.add("sumHide");
          sum2box.classList.add("sumHide");
          sum2box.classList.add("sumpadoff");
        }
      }
    }
  };

  request.open("POST", "Process/qtyupdatecartProcess.php", true);
  request.send();
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
        shopalrt.classList.remove("d-none");
        shopalrt.classList.add("d-flex");
        shopalrt.innerHTML = response;
      }
    }
  };
  request.open("POST", "Process/SellerReg.php", true);
  request.send(form);
}

function showsum() {
  if (summeryBox.classList.contains("sumHide")) {
    summeryBox.classList.remove("sumHide");
    sum2box.classList.remove("sumHide");
    sum2box.classList.remove("sumpadoff");
    summeryBox.classList.add("sumShow");
    sum2box.classList.add("sumShow");
    sum2box.classList.add("sumpad");
  } else if (summeryBox.classList.contains("sumShow")) {
    summeryBox.classList.remove("sumShow");
    sum2box.classList.remove("sumShow");
    sum2box.classList.remove("sumpad");
    summeryBox.classList.add("sumHide");
    sum2box.classList.add("sumHide");
    sum2box.classList.add("sumpadoff");
  }
}
function tikclear() {
  var inputs = document.getElementsByTagName("input");

  for (var i = 0; i < inputs.length; i++) {
    if (inputs[i].type == "checkbox") {
      inputs[i].checked = false;
    }
  }

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      if (response == "success") {
      } else {
        alert(response);
        window.location.reload();
      }
    }
  };
  request.open("POST", "Process/cartTikclearProcess.php", true);
  request.send();
}

var product_id;



function preBuy(product_id) {
  var form = new FormData();
  form.append("pid", product_id);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      if (response == "fail") {
        showAlert("Something went wrong", "error");
      } else if (response == "noaddress") {
        showAlert("Update address on your profile to continue", "error");
      } else {
        window.location = "pending-purchase.php?i=" + response;
      }
    }
  };

  request.open("POST", "Process/preBuyProcess.php", true);
  request.send(form);
}




function preBuy2() {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      if (response == "fail") {
        showAlert("Something went wrong", "error");
      } else if (response == "noAddress") {
        showAlert("Update address on your profile to continue", "error");
      } else {
        var inputs = document.getElementsByTagName("input");

        for (var i = 0; i < inputs.length; i++) {
          if (inputs[i].type == "checkbox") {
            inputs[i].checked = false;
          }
        }

        window.location = "pending-purchase.php?i=" + response;
      }
    }
  };

  request.open("POST", "Process/multipurch.php", true);
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
