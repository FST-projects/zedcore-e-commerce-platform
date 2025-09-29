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

var searchBarmain = document.getElementById("mainsearchbar");
var result_boxmain = document.getElementById("homereslt");

var slideBox = document.getElementById("filterBox2");
var FilterBtn = document.getElementById("slideTrig");
var Dback = document.getElementById("dback");
var body = document.querySelector("body");

var shade = document.getElementById("shade");
var load = document.getElementById("load");

function slider() {
  var Dback = document.getElementById("dback");

  slideBox.classList.toggle("filterBox2");
  slideBox.classList.toggle("activeSlide");
  Dback.classList.toggle("dBack");
  Dback.classList.toggle("dBackShow");
  body.classList.add("bodyStuck");
}

function onLoadsearch(page) {
  var minPrice1 = document.getElementById("max").value;
  var maxPrice1 = document.getElementById("min").value;
  var categroy2 = document.getElementById("cat2").value;
  var categroy = document.getElementById("cat").value;
  var brand = document.getElementById("brand").value;
  var model = document.getElementById("model").value;
  var clr = document.getElementById("clr").value;
  var sort = document.getElementById("sort").value;
  var search = document.getElementById("sterm").value;
  var condition = document.getElementById("condi").value;

  var resultBox = document.getElementById("resultGrid");

  var form = new FormData();
  form.append("page", page);
  form.append("sterm", search);
  form.append("min", minPrice1);
  form.append("max", maxPrice1);
  form.append("cat2", categroy2);
  form.append("cat", categroy);
  form.append("brand", brand);
  form.append("model", model);
  form.append("clr", clr);
  form.append("condi", condition);
  form.append("sort", sort);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      if (response == "Enter valid price range") {
        showAlert(response, "error");
      } else {
        resultBox.innerHTML = response;
      }
      initializeRatings();
    }
  };
  request.open("POST", "Process/searchProcess.php", true);
  request.send(form);
}

function initializeRatings() {
  var ratingElements = document.querySelectorAll(".ui.rating");

  ratingElements.forEach(function (element) {
    $(element).rating("disable");
  });
}

function addToCart(pid) {
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

function addToWish(wid) {
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

function clearFil(z) {
  document.getElementById("bn").checked = false;
  document.getElementById("ud").checked = false;
  document.getElementById("minP").value = null;
  document.getElementById("maxP").value = null;
}

function filter(page) {
  var Dback = document.getElementById("dback");

  slideBox.classList.add("filterBox2");
  slideBox.classList.remove("activeSlide");
  Dback.classList.add("dBack");
  Dback.classList.remove("dBackShow");
  body.classList.remove("bodyStuck");

  var resultBox = document.getElementById("resultGrid");
  var minPrice1 = document.getElementById("minP").value;
  var maxPrice1 = document.getElementById("maxP").value;
  var categroy2 = document.getElementById("select2").value;
  var categroy = document.getElementById("select").value;
  var brand = document.getElementById("select4");
  var model = document.getElementById("select5");
  var clr = document.getElementById("select6");
  var sort = document.getElementById("select7").value;
  var search = document.getElementById("mainsearchbar").value;

  maxPrice = "";
  minPrice = "";

  if (minPrice1 != "" || maxPrice1 != "") {
    var minPrice = minPrice1;
    var maxPrice = maxPrice1;
  }

  condition = 0;

  if (document.getElementById("bn").checked) {
    condition = 1;
  } else if (document.getElementById("ud").checked) {
    condition = 2;
  }

  searchTerm = "";

  if (search != "") {
    var searchTerm = search;
  }

  var sortnum = 0;
  if (sort != null) {
    if (sort.value != "") {
      sortnum = sort;
    }
  }


  var form = new FormData();
  form.append("s", searchTerm);
  form.append("min", minPrice);
  form.append("max", maxPrice);
  form.append("c2", categroy2);
  form.append("c", categroy);
  form.append("b", brand.value);
  form.append("m", model.value);
  form.append("clr", clr.value);
  form.append("condi", condition);
  form.append("sort", sortnum);
  form.append("page", page);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      if (response == "Enter valid price range") {
        showAlert(response, "error");
      } else {
        resultBox.innerHTML = response;
      }
      initializeRatings();
    }
  };

  request.open("POST", "Process/aftersearch.php", true);
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
