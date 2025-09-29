var signupBtn = document.getElementById("signup");

function signout() {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      if (response == "success") {
        window.location.reload();
      }
    }
  };

  request.open("POST", "homeProcess/signout.php", true);
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
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      if (response == "success") {
        showAlert("Added to Wishlist Successfully", "success");

        var offheart = document.querySelectorAll(".charticon1.offheart" + wid);
        var onheart = document.querySelectorAll(".charticon14.onheart" + wid);

        offheart.forEach(function (element) {
          element.classList.remove("d-flex");
          element.classList.add("d-none");
        });
        onheart.forEach(function (element) {
          element.classList.remove("d-none");
          element.classList.add("d-flex");
        });
      } else if (response == "remove") {
        showAlert("Removed from Wishlist Successfully", "success");
        var offheart = document.querySelectorAll(".charticon1.offheart" + wid);
        var onheart = document.querySelectorAll(".charticon14.onheart" + wid);

        onheart.forEach(function (element) {
          element.classList.remove("d-flex");
          element.classList.add("d-none");
        });
        offheart.forEach(function (element) {
          element.classList.remove("d-none");
          element.classList.add("d-flex");
        });
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

var searchBarmain = document.getElementById("mainsearchbar");
var result_boxmain = document.getElementById("homereslt");

var slideBox = document.getElementById("filterBox2");
var FilterBtn = document.getElementById("slideTrig");
var Dback = document.getElementById("notifyblackbg");
var Dback2 = document.getElementById("dback");

var body = document.querySelector("body");

var shade = document.getElementById("shade");
var load = document.getElementById("load");

function slider() {
  slideBox.classList.toggle("filterBox2");
  slideBox.classList.toggle("activeSlide");
  Dback2.classList.toggle("dBack");
  Dback2.classList.toggle("dBackShow");
  body.classList.add("bodyStuck");
}

searchBarmain.onkeyup = () => {
  var searchTerm = searchBarmain.value;
  if (searchTerm == "") {
    result_boxmain.classList.add("d-none");
  } else {
    var form = new FormData();
    form.append("s", searchTerm);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
      if ((request.readyState == 4) & (request.status == 200)) {
        var response = request.responseText;

        result_boxmain.classList.remove("d-none");
        result_boxmain.innerHTML = response;
      }
    };

    request.open("POST", "Process/homesearchmain.php", true);
    request.send(form);
  }
};

function choseProd(model) {
  window.location.href =
    "searchresult.php?sterm=&min=&max=&cat2=&cat=&brand=&model=" +
    model +
    "&clr=&condi=0&sort=0";
}

function filter() {
  var minPrice1 = document.getElementById("minP").value;
  var maxPrice1 = document.getElementById("maxP").value;
  var categroy2 = document.getElementById("select2").value;
  var categroy = document.getElementById("select").value;
  var brand = document.getElementById("select4");
  var model = document.getElementById("select5");
  var clr = document.getElementById("select6");
  var sort = document.getElementById("select12");
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

  window.location.href =
    "searchresult.php?sterm=" +
    searchTerm +
    "&min=" +
    minPrice +
    "&max=" +
    maxPrice +
    "&cat2=" +
    categroy2 +
    "&cat=" +
    categroy +
    "&brand=" +
    brand.value +
    "&model=" +
    model.value +
    "&clr=" +
    clr.value +
    "&condi=" +
    condition +
    "&sort=" +
    sortnum;
}

function clearFil(z) {
  document.getElementById("bn").checked = false;
  document.getElementById("ud").checked = false;
  document.getElementById("minP").value = null;
  document.getElementById("maxP").value = null;
}

function seeAll(cat) {
  var categroy2 = "";
  var categroy = "";
  var brand = "";
  var model = "";
  var clr = "";

  maxPrice = "";
  minPrice = "";

  condition = 0;

  searchTerm = "";

  var sortnum = 0;

  // if (searchTerm != "") {
  var form = new FormData();
  form.append("s", searchTerm);
  form.append("min", minPrice);
  form.append("max", maxPrice);
  form.append("c2", cat);
  form.append("c", categroy);
  form.append("b", brand);
  form.append("m", model);
  form.append("clr", clr);
  form.append("condi", condition);
  form.append("sort", sortnum);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;

      if (response == "success") {
        window.location.href = "searchresult.php";
      } else if (response == "fail") {
        window.location.reload();
      } else {
        alert(response);
      }
    }
  };

  request.open("POST", "Process/seeAllses.php", true);
  request.send(form);
  // }else{
  //   window.location.reload();
  // }
}

function notification() {
  var notifyBack = document.querySelectorAll("#notifyBack");
  var notifyBar = document.getElementById("sideBarNotify");
  var Dback = document.getElementById("notifyblackbg");

  notifyBar.classList.add("notifyTrans");

  Dback.classList.remove("blackdisplay");
  Dback.classList.add("blackdisplayView");

  notifyBack.forEach(function (element) {
    element.classList.add("d-none");
  });

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      if (response == "fail") {
        showAlert("Reading status fail to update", "warning");
      } else if (response == "success") {
      } else {
        alert(response);
      }
    }
  };
  request.open("POST", "Process/notificationReadProcess.php", true);
  request.send();
}

function notifiNone() {
  showAlert("Please signin to see notifications", "error");
}

function notificationNumLoad() {
  var notifyBack = document.querySelectorAll("#notifyBack");
  var notifyNum = document.querySelectorAll("#notifyNum");

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;

      if (response > 0) {
        notifyBack.forEach(function (element) {
          element.classList.remove("d-none");
        });
        notifyNum.forEach(function (element) {
          element.innerHTML = response;
        });
      } else if (response == 0) {
        notifyBack.forEach(function (element) {
          element.classList.add("d-none");
        });
      }
    }
  };
  request.open("POST", "Process/notificationNumProcess.php", true);
  request.send();
}

setInterval(notificationNumLoad, 500);

function notificationLoad() {
  var notifyBox = document.getElementById("notifyBox");

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;

      notifyBox.innerHTML = response;
    }
  };
  request.open("POST", "Process/notificationLoadProcess.php", true);
  request.send();
}
setInterval(notificationLoad, 2000);

var reviewModel = document.getElementById("reviewmodel");
reviewModelnew = new bootstrap.Modal(reviewModel, {});

function reviewOpen(id) {
  $(".ui.sidebar").sidebar("toggle");
  var reviewBox = document.getElementById("reviewBox");
  var request = new XMLHttpRequest();

  reviewId = id;
  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      reviewBox.innerHTML = response;
      $(".ui.rating.review").rating("enable");

      reviewModelnew.show();

      var ratingElement = document.querySelector(".ui.star.rating.review");

      var ratingPromise = new Promise(function (resolve, reject) {
        $(ratingElement).rating({
          onRate: function (value) {
            resolve(value);
          },
        });
      });

      ratingPromise.then(function (newRating) {
        newrate = newRating;
        $(".ui.rating.review").rating("disable");
      });
    }
  };
  request.open("POST", "Process/reviewload.php?id=" + id, true);
  request.send();
}

var reviewId = 0;
var newrate = 0;
function postReview() {
  var textfield = document.getElementById("reviewText");
  var alertId = document.getElementById("alertId");
  var form = new FormData();
  form.append("r", reviewId);
  form.append("s", newrate);
  form.append("t", textfield.value);
  form.append("a", alertId.value);
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      reviewModelnew.hide();
    }
  };
  request.open("POST", "Process/updateReview.php", true);
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

function loadHomeCat() {
  var LoadArea = document.getElementById("categoryLoads");

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      LoadArea.innerHTML = response;
      initializeRatings();
    }
  };
  request.open("POST", "Process/homeCategoryLoadProcess.php", true);
  request.send();
}
function initializeRatings() {
  var ratingElements = document.querySelectorAll(".ui.rating");

  ratingElements.forEach(function (element) {
    $(element).rating("disable");
  });
}
