function payhereload() {
  var orderId = document.getElementById("oid").value;

  var form = new FormData();
  form.append("id", orderId);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      if (response == "fail") {
        showAlert("Something went wrong", "error");
        setTimeout(function () {
          window.location = "pending-purchase.php?i=" + orderId;
        }, 1500);
      } else if (response == "orderNotFound") {
        showAlert("Order Not Found!", "error");
        setTimeout(function () {
          window.location = "pending-purchase.php?i=" + orderId;
        }, 1500);
      } else if (response == "addressNotFound") {
        showAlert("Address Not Found!", "error");
        setTimeout(function () {
          window.location = "pending-purchase.php?i=" + orderId;
        }, 1500);
      } else {
        var obj = JSON.parse(response);

        var mail = obj["umail"];
        var amount = obj["amount"];
        var uid = obj["uid"];

        // Payment completed. It can be a successful failure.
        payhere.onCompleted = function onCompleted(orderId) {
          console.log("Payment completed. OrderID:" + orderId);
          // Note: validate the payment and show success or failure page to the customer
          saveInvoice(orderId, uid);
        };

        // Payment window closed
        payhere.onDismissed = function onDismissed() {
          // Note: Prompt user to pay again or show an error page
          console.log("Payment dismissed");
          window.history.back();
        };

        // Error occurred
        payhere.onError = function onError(error) {
          // Note: show an error page
          console.log("Error:" + error);
          window.history.back();
        };

        // Put the payment variables here
        var payment = {
          sandbox: true,
          merchant_id: obj["mid"], // Replace your Merchant ID
          return_url: "http://localhost/project/order-history.php", // Important
          cancel_url: "http://localhost/project/order-history.php", // Important
          notify_url: "http://localhost/project/order-history.php",
          order_id: obj["id"],
          items: obj["item"],
          amount: amount + ".00",
          currency: "LKR",
          hash: obj["hash"], // *Replace with generated hash retrieved from backend
          first_name: obj["fname"],
          last_name: obj["lname"],
          email: mail,
          phone: obj["mobile"],
          address: obj["address"],
          city: obj["city"],
          country: "Sri Lanka",
          delivery_address: obj["address"],
          delivery_city: obj["city"],
          delivery_country: "Sri Lanka",
          custom_1: "",
          custom_2: "",
        };

        // Show the payhere.js popup, when "PayHere Pay" is clicked
        // document.getElementById("payhere-payment").onclick = function (e) {
        payhere.startPayment(payment);
        // };
      }
    }
  };

  request.open("POST", "Process/payment-process.php", true);
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

function saveInvoice(orderId, id) {
  var form = new FormData();
  form.append("o", orderId);
  form.append("id", id);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      if (response == "success") {
        url = "invoice.php?id=" + orderId;
        var newWindow = window.open(url, "_newtab");
        if (newWindow == false) {
          showAlert(
            "New window could not be opened. Please check your popup blocker settings!",
            "error"
          );
          setTimeout(function () {
            window.location = "pending-purchase.php?i=" + orderId;
          }, 1500);
        }
        window.location = "pending-purchase.php?i=" + orderId;
      } else {
        alert(response);
      }
    }
  };
  request.open("POST", "Process/saveInvoiceProcess.php", true);
  request.send(form);
}
