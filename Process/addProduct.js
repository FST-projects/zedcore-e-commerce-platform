var shade = document.getElementById("shade");
var load = document.getElementById("load");

function changeproductImage() {
  var image = document.getElementById("imageUp");

  image.onchange = function () {
    var file_count = image.files.length;

    if (file_count <= 5) {
      for (var x = 0; x < file_count; x++) {
        var file = this.files[x];
        var url = window.URL.createObjectURL(file);
        document.getElementById("i" + x).src = url;
      }
    } else {
      showAlert(
        file_count +
          " images are selected! Only 5 images can maximum be uploaded per product!",
        "error"
      );
    }
  };
}

function modeladd(x) {
  shade.classList.remove("hide");
  load.classList.remove("hide");
  shade.classList.add("show1");
  load.classList.add("show2");

  var modeladd = document.getElementById("modeladd");
  var model = document.getElementById("modelDrop");

  if (x == null) {
    x = 1;
  }
  var newId = parseInt(x) + 1;

  var form = new FormData();
  form.append("mv", newId);
  form.append("mn", modeladd.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;

      if (response == "success") {
        shade.classList.add("hide");
        load.classList.add("hide");
        shade.classList.remove("show1");
        load.classList.remove("show2");
        var delayInMilliseconds = 300; //1 second

        setTimeout(function () {
          if (modeladd.value != "") {
            model.innerHTML +=
              '<option selected value="' +
              newId +
              '">' +
              modeladd.value +
              "</option>";
          }
          modeladd.value = "";
        }, delayInMilliseconds);
      } else {
        shade.classList.add("hide");
        load.classList.add("hide");
        shade.classList.remove("show1");
        load.classList.remove("show2");
        var delayInMilliseconds = 300; //1 second

        setTimeout(function () {
          showAlert("Field is Empty!", "error");
        }, delayInMilliseconds);
      }
    }
  };

  request.open("POST", "Process/addnewprop.php", true);
  request.send(form);
}

function brandadd(u) {
  shade.classList.remove("hide");
  load.classList.remove("hide");
  shade.classList.add("show1");
  load.classList.add("show2");

  var brandadd = document.getElementById("brandadd");
  var brand = document.getElementById("brandDrop");

  if (u == null) {
    u = 1;
  }
  var newId = parseInt(u) + 1;

  var form = new FormData();
  form.append("bv", newId);
  form.append("bn", brandadd.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;

      if (response == "success") {
        shade.classList.add("hide");
        load.classList.add("hide");
        shade.classList.remove("show1");
        load.classList.remove("show2");
        var delayInMilliseconds = 300; //1 second

        setTimeout(function () {
          if (brandadd.value != "") {
            brand.innerHTML +=
              '<option selected value="' +
              newId +
              '">' +
              brandadd.value +
              "</option>";
          }
          brandadd.value = "";
        }, delayInMilliseconds);
      } else {
        shade.classList.add("hide");
        load.classList.add("hide");
        shade.classList.remove("show1");
        load.classList.remove("show2");
        var delayInMilliseconds = 300; //1 second

        setTimeout(function () {
          showAlert("Field is Empty!", "error");
        }, delayInMilliseconds);
      }
    }
  };

  request.open("POST", "Process/addnewprop.php", true);
  request.send(form);
}

function catadd(c) {
  shade.classList.remove("hide");
  load.classList.remove("hide");
  shade.classList.add("show1");
  load.classList.add("show2");

  var catadd = document.getElementById("category");
  var category = document.getElementById("CatDrop");

  if (c == null) {
    c = 1;
  }
  var newId = parseInt(c) + 1;

  var form = new FormData();
  form.append("catv", newId);
  form.append("catn", catadd.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;

      if (response == "success") {
        shade.classList.add("hide");
        load.classList.add("hide");
        shade.classList.remove("show1");
        load.classList.remove("show2");
        var delayInMilliseconds = 300; //1 second

        setTimeout(function () {
          if (catadd.value != "") {
            category.innerHTML +=
              '<option selected value="' +
              newId +
              '">' +
              catadd.value +
              "</option>";
          }
          catadd.value = "";
        }, delayInMilliseconds);
      } else {
        shade.classList.add("hide");
        load.classList.add("hide");
        shade.classList.remove("show1");
        load.classList.remove("show2");
        var delayInMilliseconds = 300; //1 second

        setTimeout(function () {
          showAlert("Field is Empty!", "error");
        }, delayInMilliseconds);
      }
    }
  };

  request.open("POST", "Process/addnewprop.php", true);
  request.send(form);
}

function clradd(q) {
  shade.classList.remove("hide");
  load.classList.remove("hide");
  shade.classList.add("show1");
  load.classList.add("show2");

  var clradd = document.getElementById("coloradd");
  var color = document.getElementById("colorDrop");

  if (q == null) {
    q = 1;
  }
  var newId = parseInt(q) + 1;

  var form = new FormData();
  form.append("cv", newId);
  form.append("cn", clradd.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;

      if (response == "success") {
        shade.classList.add("hide");
        load.classList.add("hide");
        shade.classList.remove("show1");
        load.classList.remove("show2");
        var delayInMilliseconds = 300; //1 second

        setTimeout(function () {
          if (clradd.value != "") {
            color.innerHTML +=
              '<option selected value="' +
              newId +
              '">' +
              clradd.value +
              "</option>";
          }
          clradd.value = "";
        }, delayInMilliseconds);
      } else {
        shade.classList.add("hide");
        load.classList.add("hide");
        shade.classList.remove("show1");
        load.classList.remove("show2");
        var delayInMilliseconds = 300; //1 second

        setTimeout(function () {
          showAlert("Field is Empty!", "error");
        }, delayInMilliseconds);
      }
    }
  };

  request.open("POST", "Process/addnewprop.php", true);
  request.send(form);
}

var qtyFeild = document.getElementById("amount");
var addBtn = document.getElementById("add");
var subBtn = document.getElementById("sub");

addBtn.onclick = function () {
  qtyFeild.value = parseInt(qtyFeild.value) + 1;
};
subBtn.onclick = function () {
  if (qtyFeild.value > 0) {
    qtyFeild.value = parseInt(qtyFeild.value) - 1;
  }
};

function addProduct() {
  shade.classList.remove("hide");
  load.classList.remove("hide");
  shade.classList.add("show1");
  load.classList.add("show2");

  var model = document.getElementById("modelDrop");
  var brand = document.getElementById("brandDrop");
  var category = document.getElementById("CatDrop");
  var clr = document.getElementById("colorDrop");
  var qty = document.getElementById("amount");

  var condition = 0;
  if (document.getElementById("b").checked) {
    condition = 1;
  } else if (document.getElementById("u").checked) {
    condition = 2;
  }
  var title = document.getElementById("title");
  var desc = document.getElementById("desc");
  var spec = document.getElementById("spec");
  var price = document.getElementById("price");

 

  var image = document.getElementById("imageUp");

  var form = new FormData();
  form.append("m", model.value);
  form.append("b", brand.value);
  form.append("ca", category.value);
  form.append("col", clr.value);
  form.append("q", qty.value);
  form.append("con", condition);
  form.append("t", title.value);
  form.append("de", desc.value);
  form.append("sp", spec.value);
  form.append("p", price.value);

  var file_count = image.files.length;
  for (var x = 0; x < file_count; x++) {
    form.append("image" + x, image.files[x]);
  }

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
          showAlert("Product added successfully!", "success");

          window.location = "myproduct.php";
        }, 300);
      } else {
        shade.classList.add("hide");
        load.classList.add("hide");
        shade.classList.remove("show1");
        load.classList.remove("show2");

        setTimeout(function () {
          showAlert(response, "error");
        }, 300);
      }
    }
  };

  request.open("POST", "Process/addProductProcess.php", true);
  request.send(form);
}

var popback = document.getElementById("popback");
var menu = document.getElementById("menupop");
var profilebtn = document.getElementById("profilebox");

function showMenu() {
  if (popback.classList.contains("eventsoff")) {
    //remove pop menu

    popback.classList.toggle("eventson");
    popback.classList.toggle("eventsoff");
    menu.classList.toggle("menuclose");
    menu.classList.toggle("menuanimate");
  } else {
    popback.classList.toggle("eventson");
    popback.classList.toggle("eventsoff");
    menu.classList.toggle("menuclose");
    menu.classList.toggle("menuanimate");
  }
}

document.onclick = function (e) {
  if (!menu.contains(e.target) && !profilebtn.contains(e.target)) {
    menu.classList.add("menuclose");
    menu.classList.remove("menuanimate");
    popback.classList.add("eventsoff");
    popback.classList.remove("eventson");
  }
};

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

function upProduct() {
  shade.classList.remove("hide");
  load.classList.remove("hide");
  shade.classList.add("show1");
  load.classList.add("show2");

  var qty = document.getElementById("amount");
  var title = document.getElementById("title");
  var desc = document.getElementById("desc");
  var spec = document.getElementById("spec");
  var image = document.getElementById("imageUp");

  var form = new FormData();
  form.append("q", qty.value);
  form.append("t", title.value);
  form.append("de", desc.value);
  form.append("sp", spec.value);

  var file_count = image.files.length;
  for (var x = 0; x < file_count; x++) {
    form.append("image" + x, image.files[x]);
  }

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
          showAlert("Product Updated successfully!", "success");
          window.location = "myproduct.php";
        }, 300);
      } else {
        shade.classList.add("hide");
        load.classList.add("hide");
        shade.classList.remove("show1");
        load.classList.remove("show2");
 

        setTimeout(function () {
          showAlert(response, "error");
        }, 300);
      }
    }
  };

  request.open("POST", "Process/upProductProcess.php", true);
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
