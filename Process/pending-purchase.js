function changeAddressModal() {
  $(".ui.modal")
    .modal("setting", "transition", "fade up")
    .modal("setting", "closable", false)
    .modal("show");
}

function changeAddress() {
  var orderid = document.getElementById("orderId");
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
  form.append("id", orderid.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      if (response == "1") {
        showAlert("Enter delivery address!", "error");
      } else if (response == "2") {
        showAlert("Select your city!", "error");
      } else if (response == "5") {
        showAlert("Enter the zipcode!", "error");
      } else if (response == "fail") {
        showAlert("Failed to update address", "error");
      } else {
        showAlert("Delivery address updated successfully", "success");

        $(".ui.modal")
          .modal("setting", "transition", "fade up")
          .modal("setting", "closable", false)
          .modal("hide");

        document.getElementById("line").innerHTML = response;
      }
    }
  };

  request.open("POST", "Process/invoiceAddress-process.php", true);
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

function placeOrder() {
    var order = document.getElementById("oid").value;
  window.location = "pay.php?i=" + order;
}
