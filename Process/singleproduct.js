var descHead = document.getElementById("descHead");
var specHead = document.getElementById("specHead");
var revHead = document.getElementById("revHead");

var descmin = document.getElementById("descmin");
var specmin = document.getElementById("specmin");
var revmin = document.getElementById("revmin");

var desc = document.getElementById("desc");
var spec = document.getElementById("spec");
var reviewSec = document.getElementById("reviewSec");

descHead.onclick = function () {
  descmin.classList.add("active");
  specmin.classList.remove("active");
  revmin.classList.remove("active");

  desc.classList.remove("d-none");
  spec.classList.add("d-none");
  reviewSec.classList.add("d-none");

  desc.classList.add("d-flex");
  spec.classList.remove("d-flex");
  reviewSec.classList.remove("d-flex");
};

specHead.onclick = function () {
  descmin.classList.remove("active");
  specmin.classList.add("active");
  revmin.classList.remove("active");
  desc.classList.add("d-none");
  spec.classList.remove("d-none");
  reviewSec.classList.add("d-none");
  desc.classList.remove("d-flex");
  spec.classList.add("d-flex");
  reviewSec.classList.remove("d-flex");
};

revHead.onclick = function () {
  descmin.classList.remove("active");
  specmin.classList.remove("active");
  revmin.classList.add("active");

  desc.classList.add("d-none");
  spec.classList.add("d-none");
  reviewSec.classList.remove("d-none");

  desc.classList.remove("d-flex");
  spec.classList.remove("d-flex");
  reviewSec.classList.add("d-block");
};

function LoadImg(id) {
  var sample_img = document.getElementById("productImg" + id).src;
  var main_img = document.getElementById("mainImg");

  main_img.src = sample_img;
}

function qtyup(pId, Tqty) {
  var qtyFeild = document.getElementById("amount" + pId);

  if (parseInt(qtyFeild.value) < Tqty) {
    qtyFeild.value = parseInt(qtyFeild.value) + 1;
  } else {
    showAlert("Reached to maximum quantity!", "error");
  }
}

function qtydown(pId) {
  var qtyFeild = document.getElementById("amount" + pId);
  var tikbg = document.getElementById("tik" + pId);

  if (parseInt(qtyFeild.value) > 1) {
    qtyFeild.value = parseInt(qtyFeild.value) - 1;
  } else {
    showAlert("Reached to minimum quantity!", "error");
  }
}

function btnDisable() {
  document.getElementById("buyBtn").classList.remove("orange");
  document.getElementById("addToCart").classList.remove("green");
  document.getElementById("buyBtn").classList.add("disableBtn");
  document.getElementById("addToCart").classList.add("disableBtn");
}
function btnAnable() {
  document.getElementById("buyBtn").classList.remove("disableBtn");
  document.getElementById("addToCart").classList.remove("disableBtn");
  document.getElementById("buyBtn").classList.add("orange");
  document.getElementById("addToCart").classList.add("green");
}

function addToWish(wid) {
  let checkboxes = document.getElementsByName("color");

  for (var i = 0; i < checkboxes.length; i++) {
    if (checkboxes[i].checked) {
      wid = checkboxes[i].value;
    }
  }

  var offheart = document.getElementById("offheart" + wid);
  var onheart = document.getElementById("onheart" + wid);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      if (response == "success") {
        showAlert("Added to Wishlist Successfully", "success");

        offheart.classList.remove("d-flex");
        offheart.classList.add("d-none");
        onheart.classList.remove("d-none");
        onheart.classList.add("d-flex");
      } else if (response == "remove") {
        showAlert("Removed from Wishlist Successfully", "success");

        onheart.classList.remove("d-flex");
        onheart.classList.add("d-none");
        offheart.classList.remove("d-none");
        offheart.classList.add("d-flex");
      } else if (response == "fail") {
        showAlert("Please SignIn to Use Wishlist!", "error");
      } else if (response == "something") {
        showAlert("Something went wrong! Please relogin.", "error");
      } else {
        alert(response);
      }
    }
  };
  request.open("GET", "Process/addWishProcess.php?wid=" + wid, true);
  request.send();
}

function addToWish2(wid) {
  var offheart = document.getElementById("offheart" + wid);
  var onheart = document.getElementById("onheart" + wid);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      if (response == "success") {
        showAlert("Added to Wishlist Successfully", "success");

        offheart.classList.remove("d-flex");
        offheart.classList.add("d-none");
        onheart.classList.remove("d-none");
        onheart.classList.add("d-flex");
      } else if (response == "remove") {
        showAlert("Removed from Wishlist Successfully", "success");

        onheart.classList.remove("d-flex");
        onheart.classList.add("d-none");
        offheart.classList.remove("d-none");
        offheart.classList.add("d-flex");
      } else if (response == "fail") {
        showAlert("Please SignIn to Use Wishlist!", "error");
      } else if (response == "something") {
        showAlert("Something went wrong! Please relogin.", "error");
      } else {
        alert(response);
      }
    }
  };
  request.open("GET", "Process/addWishProcess.php?wid=" + wid, true);
  request.send();
}

function addToCart(pid) {
  let checkboxes = document.getElementsByName("color");
  var qty = document.getElementById("amount" + pid).value;

  for (var i = 0; i < checkboxes.length; i++) {
    if (checkboxes[i].checked) {
      pid = checkboxes[i].value;
    }
  }

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      if (response == "success") {
        showAlert("Added to Cart Successfully", "success");
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
  request.open(
    "GET",
    "Process/addCartProcess.php?pid=" + pid + "&qty=" + qty,
    true
  );
  request.send();
}

function addToCart2(pid) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      if (response == "success") {
        showAlert("Added to Cart Successfully", "success");
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

function follow(sid) {
  var follow = document.getElementById("follow");

  var form = new FormData();
  form.append("sid", sid);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      if (response == "followed") {
        showAlert("Followed successfully", "success");

        follow.innerHTML = "Following";
      } else if (response == "nFollowed") {
        showAlert("Unfollowed successfully", "success");

        follow.innerHTML = "Follow";
      } else if (response == "fail") {
        showAlert(" Signin to follow shops!", "error");
      } else if (response == "something") {
        showAlert("Something went wrong! Please relogin.", "error");
      } else {
        alert(response);
      }
    }
  };
  request.open("POST", "Process/followProcess.php", true);
  request.send(form);
}

function send(fid) {
  var quesdata = document.getElementById("quesdata");

  var form = new FormData();
  form.append("pid", fid);
  form.append("ques", quesdata.value);

  quesdata.value = "";
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      if (response == "success") {
        quesLoad(fid);
      } else if (response == "fail") {
        showAlert("Signin to Ask Questions!", "error");
      } else if (response == "Something") {
        showAlert("Something went wrong! Please relogin.", "error");
      } else {
        alert(response);
      }
    }
  };
  request.open("POST", "Process/quesSendProcess.php", true);
  request.send(form);
}

function quesLoad(pid) {
  var quesboxload = document.getElementById("quesboxload");

  var form = new FormData();
  form.append("pid", pid);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      quesboxload.innerHTML = response;
    }
  };
  request.open("POST", "Process/quesLoacProcess.php", true);
  request.send(form);
}

function singleProductView(pid) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      if (response == "success") {
        window.location.href = "productView.php?pid=" + pid;
      } else {
        alert(response);
      }
    }
  };

  request.open("GET", "Process/viewProces.php?id=" + pid, true);
  request.send();
}

function preBuy(pid) {
  var qty = document.getElementById("amount" + pid);

  let checkboxes = document.getElementsByName("color");

  for (var i = 0; i < checkboxes.length; i++) {
    if (checkboxes[i].checked) {
      pid = checkboxes[i].value;
    }
  }
  var form = new FormData();
  form.append("pid", pid);
  form.append("qty", qty.value);

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

function phonesDivScrolLeft() {
  const scrollContainer = document.getElementById("phones");
  scrollContainer.scrollLeft -= 230;
}
function phonesDivScrolRight() {
  const scrollContainer = document.getElementById("phones");
  scrollContainer.scrollLeft += 230;
}
