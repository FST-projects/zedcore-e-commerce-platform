var searchBar = document.getElementById("searchbar");
var searchBar2 = document.getElementById("searchbar2");
var result_box = document.getElementById("resultBox");
var result_box2 = document.getElementById("resultBox2");

var slideBox = document.getElementById("filterBox2");
var FilterBtn = document.getElementById("slideTrig");
var Dback = document.getElementById("dback");
var body = document.querySelector("body");

var shade = document.getElementById("shade");
var load = document.getElementById("load");

function changeproductImage() {
  var image = document.getElementById("image");

  image.onchange = function () {
    var file_count = image.files.length;

    if (file_count == 1) {
      var file = image.files[0];
      var url = window.URL.createObjectURL(file);
      document.getElementById("ImagePlace").src = url;
    } else {
      alert("Only 1 image can be selected!");
    }
  };
}

function sendawareMsg() {
  var image = document.getElementById("image");
  var title = document.getElementById("title");
  var desc = document.getElementById("desc");
  var shop = document.getElementById("shopid");

  var form = new FormData();
  form.append("image", image.files[0]);
  form.append("title", title.value);
  form.append("desc", desc.value);
  form.append("shop", shop.value);
  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      if (response == "title") {
        showAlert("Please enter Title", "error");
      } else if (response == "desc") {
        showAlert("Please enter Description", "error");
      } else if (response == "something went wrong!") {
        showAlert("Something went wrong!", "error");
      } else if (response == "success") {
        showAlert("Send Successfully", "success");
        $(".ui.modal")
          .modal("setting", "transition", "fade up")
          .modal("setting", "closable", false)
          .modal("hide");
      } else {
        showAlert("Error : " + response, "error");
      }
    }
  };
  request.open("POST", "Process/sendShopAlerts.php", true);
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

searchBar.onkeyup = () => {
  var searchTerm = searchBar.value;
  if (searchTerm == "" || searchTerm == null) {
    result_box.classList.add("d-none");
  } else {
    var form = new FormData();
    form.append("s", searchTerm);
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
      if ((request.readyState == 4) & (request.status == 200)) {
        var response = request.responseText;
        result_box.classList.remove("d-none");
        result_box.innerHTML = response;
      }
    };
    request.open("POST", "Process/Myproductsearch.php", true);
    request.send(form);
  }
};

searchBar2.onkeyup = () => {
  var searchTerm = searchBar2.value;
  if (searchTerm == "" || searchTerm == null) {
    result_box2.classList.add("d-none");
  } else {
    var form = new FormData();
    form.append("s", searchTerm);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
      if ((request.readyState == 4) & (request.status == 200)) {
        var response = request.responseText;

        result_box2.classList.remove("d-none");
        result_box2.innerHTML = response;
      }
    };

    request.open("POST", "Process/Myproductsearch.php", true);
    request.send(form);
  }
};

var product_rsBox = document.getElementById("pdrs");
function choseProd(x) {
  shade.classList.remove("hide");
  load.classList.remove("hide");
  shade.classList.add("show1");
  load.classList.add("show2");

  page = 1;

  var form = new FormData();
  form.append("pid", x);
  form.append("page", page);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      shade.classList.add("hide");
      load.classList.add("hide");
      shade.classList.remove("show1");
      load.classList.remove("show2");
      slideBox.classList.add("filterBox2");
      slideBox.classList.remove("activeSlide");
      Dback.classList.add("dBack");
      Dback.classList.remove("dBackShow");
      body.classList.remove("bodyStuck");


      setTimeout(function () {
        product_rsBox.innerHTML = response;
      }, 300);
    }
  };

  request.open("POST", "Process/Myproductload.php", true);
  request.send(form);
}

function filter(x) {
  shade.classList.remove("hide");
  load.classList.remove("hide");
  shade.classList.add("show1");
  load.classList.add("show2");

  var minPrice1 = document.getElementById("minP").value;
  var maxPrice1 = document.getElementById("maxP").value;
  var minPrice2 = document.getElementById("minP2").value;
  var maxPrice2 = document.getElementById("maxP2").value;

  maxPrice = "";
  minPrice = "";

  if (minPrice1 != "" || maxPrice1 != "") {
    var minPrice = minPrice1;
    var maxPrice = maxPrice1;
  } else if (minPrice2 != "" || maxPrice2 != "") {
    var minPrice = minPrice2;
    var maxPrice = maxPrice2;
  }

  var categroy = document.getElementById("select1");
  var categroy2 = document.getElementById("select2");
  var sort = document.getElementById("select");

  condition = 0;
  sale = 0;

  if (document.getElementById("bn").checked) {
    condition = 1;
  } else if (document.getElementById("ud").checked) {
    condition = 2;
  }
  if (document.getElementById("bn2").checked) {
    condition = 1;
  } else if (document.getElementById("ud2").checked) {
    condition = 2;
  }

  var searchBar = document.getElementById("searchbar").value;
  var searchBar2 = document.getElementById("searchbar2").value;
  searchTerm = "";

  if (searchBar != "") {
    var searchTerm = searchBar;
  } else if (searchBar2 != "") {
    var searchTerm = searchBar2;
  }
  var form = new FormData();
  form.append("s", searchTerm);
  form.append("min", minPrice);
  form.append("max", maxPrice);
  form.append("c", categroy.value);
  form.append("c2", categroy2.value);
  form.append("condi", condition);
  form.append("sort", sort.value);
  form.append("page", x);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      shade.classList.add("hide");
      load.classList.add("hide");
      shade.classList.remove("show1");
      load.classList.remove("show2");
      slideBox.classList.add("filterBox2");
      slideBox.classList.remove("activeSlide");
      Dback.classList.add("dBack");
      Dback.classList.remove("dBackShow");
      body.classList.remove("bodyStuck");
    

      setTimeout(function () {
        if (response == "Enter valid price range") {
          showAlert(response, "error");
        } else {
          product_rsBox.innerHTML = response;
        }
      }, 300);
    }
  };

  request.open("POST", "Process/Myproductload.php", true);
  request.send(form);
}

function clearFil(z) {
  shade.classList.remove("hide");
  load.classList.remove("hide");
  shade.classList.add("show1");
  load.classList.add("show2");

  document.getElementById("bn").checked = false;
  document.getElementById("ud").checked = false;
  document.getElementById("bn2").checked = false;
  document.getElementById("ud2").checked = false;
  document.getElementById("minP").value = null;
  document.getElementById("maxP").value = null;
  document.getElementById("minP2").value = null;
  document.getElementById("maxP2").value = null;

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      shade.classList.add("hide");
      load.classList.add("hide");
      shade.classList.remove("show1");
      load.classList.remove("show2");
     

      setTimeout(function () {
        product_rsBox.innerHTML = response;
      }, 300);
    }
  };

  request.open("POST", "Process/clearSearch.php?page=" + z, true);
  request.send();
}

function changeStatus(id) {
  shade.classList.remove("hide");
  load.classList.remove("hide");
  shade.classList.add("show1");
  load.classList.add("show2");

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      if (response == "success") {
        shade.classList.add("hide");
        load.classList.add("hide");
        shade.classList.remove("show1");
        load.classList.remove("show2");
     

        setTimeout(function () {
          window.location.reload();
        }, 300);
      } else {
      }
    }
  };

  request.open("GET", "Process/updateStatus.php?id=" + id, true);
  request.send();
}

function updatebtn(upid) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      if (response == "success") {
        window.location = "updateproduct.php";
      } else {
        alert(response);
      }
    }
  };

  request.open("GET", "Process/sendupdateid.php?id=" + upid, true);
  request.send();
}

function awarefollowersModal() {
  $(".ui.modal")
    .modal("setting", "transition", "fade up")
    .modal("setting", "closable", false)
    .modal("show");
}

function adminBlockPd() {
  showAlert(
    "Zedcore Admin has Blocked your product, Contact zedcore for more information",
    "warning"
  );
}
