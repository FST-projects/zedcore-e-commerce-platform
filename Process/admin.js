var dashboard = document.getElementById("Dashboard");
var product = document.getElementById("product");
var chat = document.getElementById("chat");
var user = document.getElementById("user");
var order = document.getElementById("orders");
var seller = document.getElementById("shop");
var hist = document.getElementById("History");
var admin = document.getElementById("admin");
var home = document.getElementById("home");
var report = document.getElementById("report");

function dashToggle() {
  dashOrders(1);
  dashboard.classList.remove("d-none");
  dashboard.classList.add("d-block");

  product.classList.remove("d-block");
  product.classList.add("d-none");

  chat.classList.remove("d-block");
  chat.classList.add("d-none");

  user.classList.remove("d-block");
  user.classList.add("d-none");

  order.classList.remove("d-block");
  order.classList.add("d-none");

  seller.classList.remove("d-block");
  seller.classList.add("d-none");

  hist.classList.remove("d-block");
  hist.classList.add("d-none");

  admin.classList.remove("d-block");
  admin.classList.add("d-none");

  home.classList.remove("d-block");
  home.classList.add("d-none");

  report.classList.remove("d-block");
  report.classList.add("d-none");
}

function productToggle() {
  searchProduct(1);
  dashboard.classList.remove("d-block");
  dashboard.classList.add("d-none");

  product.classList.remove("d-none");
  product.classList.add("d-block");

  chat.classList.remove("d-block");
  chat.classList.add("d-none");

  user.classList.remove("d-block");
  user.classList.add("d-none");

  order.classList.remove("d-block");
  order.classList.add("d-none");

  seller.classList.remove("d-block");
  seller.classList.add("d-none");

  hist.classList.remove("d-block");
  hist.classList.add("d-none");

  admin.classList.remove("d-block");
  admin.classList.add("d-none");

  home.classList.remove("d-block");
  home.classList.add("d-none");

  report.classList.remove("d-block");
  report.classList.add("d-none");
}

function chatToggle() {
  dashboard.classList.remove("d-block");
  dashboard.classList.add("d-none");

  product.classList.remove("d-block");
  product.classList.add("d-none");

  chat.classList.remove("d-none");
  chat.classList.add("d-block");

  user.classList.remove("d-block");
  user.classList.add("d-none");

  order.classList.remove("d-block");
  order.classList.add("d-none");

  seller.classList.remove("d-block");
  seller.classList.add("d-none");

  hist.classList.remove("d-block");
  hist.classList.add("d-none");

  admin.classList.remove("d-block");
  admin.classList.add("d-none");

  home.classList.remove("d-block");
  home.classList.add("d-none");

  report.classList.remove("d-block");
  report.classList.add("d-none");
}
function userToggle() {
  searchUser(1);
  dashboard.classList.remove("d-block");
  dashboard.classList.add("d-none");

  product.classList.remove("d-block");
  product.classList.add("d-none");

  chat.classList.remove("d-block");
  chat.classList.add("d-none");

  user.classList.remove("d-none");
  user.classList.add("d-block");

  order.classList.remove("d-block");
  order.classList.add("d-none");

  seller.classList.remove("d-block");
  seller.classList.add("d-none");

  hist.classList.remove("d-block");
  hist.classList.add("d-none");

  admin.classList.remove("d-block");
  admin.classList.add("d-none");

  home.classList.remove("d-block");
  home.classList.add("d-none");

  report.classList.remove("d-block");
  report.classList.add("d-none");
}

function sellerToggle() {
  searchShop(1);
  dashboard.classList.remove("d-block");
  dashboard.classList.add("d-none");

  product.classList.remove("d-block");
  product.classList.add("d-none");

  chat.classList.remove("d-block");
  chat.classList.add("d-none");

  user.classList.remove("d-block");
  user.classList.add("d-none");

  order.classList.remove("d-block");
  order.classList.add("d-none");

  seller.classList.remove("d-none");
  seller.classList.add("d-block");

  hist.classList.remove("d-block");
  hist.classList.add("d-none");

  admin.classList.remove("d-block");
  admin.classList.add("d-none");

  home.classList.remove("d-block");
  home.classList.add("d-none");

  report.classList.remove("d-block");
  report.classList.add("d-none");
}

function orderToggle() {
  searchOrders(1);

  dashboard.classList.remove("d-block");
  dashboard.classList.add("d-none");

  product.classList.remove("d-block");
  product.classList.add("d-none");

  chat.classList.remove("d-block");
  chat.classList.add("d-none");

  user.classList.remove("d-block");
  user.classList.add("d-none");

  order.classList.remove("d-none");
  order.classList.add("d-block");

  seller.classList.remove("d-block");
  seller.classList.add("d-none");

  hist.classList.remove("d-block");
  hist.classList.add("d-none");

  admin.classList.remove("d-block");
  admin.classList.add("d-none");

  home.classList.remove("d-block");
  home.classList.add("d-none");

  report.classList.remove("d-block");
  report.classList.add("d-none");
}

function historyToggle() {
  searchHistory(1);

  dashboard.classList.remove("d-block");
  dashboard.classList.add("d-none");

  product.classList.remove("d-block");
  product.classList.add("d-none");

  chat.classList.remove("d-block");
  chat.classList.add("d-none");

  user.classList.remove("d-block");
  user.classList.add("d-none");

  order.classList.remove("d-block");
  order.classList.add("d-none");

  seller.classList.remove("d-block");
  seller.classList.add("d-none");

  hist.classList.remove("d-none");
  hist.classList.add("d-block");

  admin.classList.remove("d-block");
  admin.classList.add("d-none");

  home.classList.remove("d-block");
  home.classList.add("d-none");

  report.classList.remove("d-block");
  report.classList.add("d-none");
}
function adminToggle() {
  searchAdmin(1);
  searchAdminreset(1);
  dashboard.classList.remove("d-block");
  dashboard.classList.add("d-none");

  product.classList.remove("d-block");
  product.classList.add("d-none");

  chat.classList.remove("d-block");
  chat.classList.add("d-none");

  user.classList.remove("d-block");
  user.classList.add("d-none");

  order.classList.remove("d-block");
  order.classList.add("d-none");

  seller.classList.remove("d-block");
  seller.classList.add("d-none");

  hist.classList.remove("d-block");
  hist.classList.add("d-none");

  admin.classList.remove("d-none");
  admin.classList.add("d-block");

  home.classList.remove("d-block");
  home.classList.add("d-none");

  report.classList.remove("d-block");
  report.classList.add("d-none");
}

function homeToggle() {
  categoryChartLoad();
  dashboard.classList.remove("d-block");
  dashboard.classList.add("d-none");

  product.classList.remove("d-block");
  product.classList.add("d-none");

  chat.classList.remove("d-block");
  chat.classList.add("d-none");

  user.classList.remove("d-block");
  user.classList.add("d-none");

  order.classList.remove("d-block");
  order.classList.add("d-none");

  seller.classList.remove("d-block");
  seller.classList.add("d-none");

  hist.classList.remove("d-block");
  hist.classList.add("d-none");

  admin.classList.remove("d-block");
  admin.classList.add("d-none");

  home.classList.remove("d-none");
  home.classList.add("d-block");

  report.classList.remove("d-block");
  report.classList.add("d-none");
}
function reportToggle() {
  dashboard.classList.remove("d-block");
  dashboard.classList.add("d-none");

  product.classList.remove("d-block");
  product.classList.add("d-none");

  chat.classList.remove("d-block");
  chat.classList.add("d-none");

  user.classList.remove("d-block");
  user.classList.add("d-none");

  order.classList.remove("d-block");
  order.classList.add("d-none");

  seller.classList.remove("d-block");
  seller.classList.add("d-none");

  hist.classList.remove("d-block");
  hist.classList.add("d-none");

  admin.classList.remove("d-block");
  admin.classList.add("d-none");

  home.classList.remove("d-block");
  home.classList.add("d-none");

  report.classList.remove("d-none");
  report.classList.add("d-block");
}

function searchProduct(page) {
  var product_input = document.getElementById("productInput");
  var order_input = document.getElementById("orderInput");
  var user_input = document.getElementById("userInput");
  var history_input = document.getElementById("historyInput");
  var shop_input = document.getElementById("shopInput");
  var adminInput = document.getElementById("adminInput");

  adminInput.value = "";
  order_input.value = "";
  user_input.value = "";
  history_input.value = "";
  shop_input.value = "";

  var product_inner = document.getElementById("productInner");

  // if (product_input != "") {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      product_inner.innerHTML = response;
    }
  };

  request.open(
    "GET",
    "Process/adminProductSearch.php?term=" +
      product_input.value +
      "&page=" +
      page,
    true
  );
  request.send();
  // }
}

function openModal(mid) {
  var product_model = document.getElementById("ProductModel");

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      product_model.innerHTML = response;
      $(".ui.modal.p").modal("show");
    }
  };

  request.open("GET", "Process/productModelLoad.php?pid=" + mid, true);
  request.send();
}

function changeProductStatus(changeid) {
  var statusBtn = document.getElementById("productstatus" + changeid);
  statusBtn.classList.add("loading");

  var form = new FormData();
  form.append("cid", changeid);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      if (response == "2") {
        statusBtn.classList.remove("loading");
        statusBtn.classList.remove("blue");
        statusBtn.classList.remove("orange");
        statusBtn.classList.add("red");
        statusBtn.innerHTML = "Blocked";
      } else if (response == "3") {
        statusBtn.classList.remove("loading");
        statusBtn.classList.remove("red");
        statusBtn.classList.remove("orange");
        statusBtn.classList.add("blue");
        statusBtn.innerHTML = "Activated";
      } else if (response == "4") {
        statusBtn.classList.remove("loading");
        statusBtn.classList.remove("blue");
        statusBtn.classList.remove("red");
        statusBtn.classList.add("orange");
        statusBtn.innerHTML = "Deactivated";
      }
    }
  };

  request.open("POST", "Process/changeProductStatus.php", true);
  request.send(form);
}

function searchOrders(page) {
  var product_input = document.getElementById("productInput");
  var order_input = document.getElementById("orderInput");
  var user_input = document.getElementById("userInput");
  var history_input = document.getElementById("historyInput");
  var shop_input = document.getElementById("shopInput");
  var adminInput = document.getElementById("adminInput");

  adminInput.value = "";
  product_input.value = "";
  user_input.value = "";
  history_input.value = "";
  shop_input.value = "";
  var order_inner = document.getElementById("orderInner");

  // if (product_input != "") {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      order_inner.innerHTML = response;
    }
  };

  request.open(
    "GET",
    "Process/adminOrderSearch.php?term=" + order_input.value + "&page=" + page,
    true
  );
  request.send();
  // }
}
function dashOrders() {
  var product_input = document.getElementById("productInput");
  var order_input = document.getElementById("orderInput");
  var user_input = document.getElementById("userInput");
  var history_input = document.getElementById("historyInput");
  var shop_input = document.getElementById("shopInput");
  var adminInput = document.getElementById("adminInput");

  adminInput.value = "";
  order_input.value = "";
  product_input.value = "";
  user_input.value = "";
  history_input.value = "";
  shop_input.value = "";
  var order_inner = document.getElementById("orderdash");

  // if (product_input != "") {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      order_inner.innerHTML = response;
    }
  };

  request.open("GET", "Process/adminOrderDash.php", true);
  request.send();
  // }
}

function changeOrderStatus(changeid) {
  var statusBtn = document.querySelectorAll("#orderstatus" + changeid);
  statusBtn.forEach(function (element) {
    element.classList.add("loading");
  });

  var form = new FormData();
  form.append("cid", changeid);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      if (response == "1") {
        statusBtn.forEach(function (element) {
          element.classList.remove("loading");
          element.classList.remove("yellow");
          element.classList.add("orange");
          element.innerHTML = "Packed";
        });
      } else if (response == "2") {
        statusBtn.forEach(function (element) {
          element.classList.remove("loading");
          element.classList.remove("orange");
          element.classList.add("olive");
          element.innerHTML = "Dispatched";
        });
      } else if (response == "3") {
        statusBtn.forEach(function (element) {
          element.classList.remove("loading");
          element.classList.remove("olive");
          element.classList.add("green");
          element.innerHTML = "Delivered";
        });
      } else {
        statusBtn.forEach(function (element) {
          element.classList.remove("loading");
          showAlert(response, "error");
        });
      }
    }
  };

  request.open("POST", "Process/changeOrderStatus.php", true);
  request.send(form);
}

function searchHistory(page) {
  var product_input = document.getElementById("productInput");
  var order_input = document.getElementById("orderInput");
  var user_input = document.getElementById("userInput");
  var history_input = document.getElementById("historyInput");
  var shop_input = document.getElementById("shopInput");
  var adminInput = document.getElementById("adminInput");

  adminInput.value = "";
  order_input.value = "";
  user_input.value = "";
  product_input.value = "";
  shop_input.value = "";

  var history_inner = document.getElementById("historyInner");

  // if (product_input != "") {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      history_inner.innerHTML = response;
    }
  };

  request.open(
    "GET",
    "Process/adminHistorySearch.php?term=" +
      history_input.value +
      "&page=" +
      page,
    true
  );
  request.send();
  // }
}

function searchUser(page) {
  var product_input = document.getElementById("productInput");
  var order_input = document.getElementById("orderInput");
  var user_input = document.getElementById("userInput");
  var history_input = document.getElementById("historyInput");
  var shop_input = document.getElementById("shopInput");
  var adminInput = document.getElementById("adminInput");

  adminInput.value = "";
  order_input.value = "";
  product_input.value = "";
  history_input.value = "";
  shop_input.value = "";
  var user_inner = document.getElementById("userInner");

  // if (product_input != "") {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      user_inner.innerHTML = response;
    }
  };

  request.open(
    "GET",
    "Process/adminUserSearch.php?term=" + user_input.value + "&page=" + page,
    true
  );
  request.send();
  // }
}

function openUserModel(mid) {
  var product_model = document.getElementById("userModel");

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      product_model.innerHTML = response;
      $(".ui.modal.u").modal("show");
    }
  };

  request.open("GET", "Process/userModelLoad.php?pid=" + mid, true);
  request.send();
}

function changeUsertStatus(changeid) {
  var statusBtn = document.getElementById("userstatus" + changeid);
  var activeUsers = document.querySelectorAll("#activeUsers");

  statusBtn.classList.add("loading");

  var form = new FormData();
  form.append("cid", changeid);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      if (response == "2") {
        statusBtn.classList.remove("loading");
        statusBtn.classList.remove("teal");
        statusBtn.classList.add("red");
        statusBtn.innerHTML = "Blocked";

        activeUsers.forEach(function (element) {
          element.innerHTML = parseInt(element.innerHTML) - 1;
        });
      } else if (response == "1") {
        statusBtn.classList.remove("loading");
        statusBtn.classList.remove("red");
        statusBtn.classList.add("teal");
        statusBtn.innerHTML = "Activated";

        activeUsers.forEach(function (element) {
          element.innerHTML = parseInt(element.innerHTML) + 1;
        });
      } else {
        alert(response);
      }
    }
  };

  request.open("POST", "Process/changeUserStatus.php", true);
  request.send(form);
}
function changeAdminStatus(changeid) {
  var statusBtn = document.getElementById("adminstatus" + changeid);
  var activeUsers = document.querySelectorAll("#activeAdmins");

  statusBtn.classList.add("loading");

  var form = new FormData();
  form.append("cid", changeid);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      if (response == "2") {
        statusBtn.classList.remove("loading");
        statusBtn.classList.remove("teal");
        statusBtn.classList.add("red");
        statusBtn.innerHTML = "Blocked";

        activeUsers.forEach(function (element) {
          element.innerHTML = parseInt(element.innerHTML) - 1;
        });
      } else if (response == "1") {
        statusBtn.classList.remove("loading");
        statusBtn.classList.remove("red");
        statusBtn.classList.add("teal");
        statusBtn.innerHTML = "Activated";

        activeUsers.forEach(function (element) {
          element.innerHTML = parseInt(element.innerHTML) + 1;
        });
      } else {
        alert(response);
      }
    }
  };

  request.open("POST", "Process/changeAdminStatus.php", true);
  request.send(form);
}

function searchShop(page) {
  var product_input = document.getElementById("productInput");
  var order_input = document.getElementById("orderInput");
  var user_input = document.getElementById("userInput");
  var history_input = document.getElementById("historyInput");
  var shop_input = document.getElementById("shopInput");
  var adminInput = document.getElementById("adminInput");

  adminInput.value = "";
  order_input.value = "";
  user_input.value = "";
  history_input.value = "";
  product_input.value = "";

  var shop_inner = document.getElementById("shopInner");
  shop_input.innerHTML = "";

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      shop_inner.innerHTML = response;
    }
  };

  request.open(
    "GET",
    "Process/adminShopSearch.php?term=" + shop_input.value + "&page=" + page,
    true
  );
  request.send();
}
function searchAdmin(page) {
  var product_input = document.getElementById("productInput");
  var order_input = document.getElementById("orderInput");
  var user_input = document.getElementById("userInput");
  var history_input = document.getElementById("historyInput");
  var shop_input = document.getElementById("shopInput");
  var adminInput = document.getElementById("adminInput");

  order_input.value = "";
  user_input.value = "";
  history_input.value = "";
  product_input.value = "";
  shop_input.value = "";

  var adminInner = document.getElementById("adminInner");

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      adminInner.innerHTML = response;
    }
  };

  request.open(
    "GET",
    "Process/adminAdminSearch.php?term=" + adminInput.value + "&page=" + page,
    true
  );
  request.send();
}
function searchAdminreset() {
  var adminInner = document.getElementById("adminResetLoad");

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      adminInner.innerHTML = response;
    }
  };

  request.open(
    "GET",
    "Process/adminResetSearch.php?term=" + adminInput.value,
    true
  );
  request.send();
}

function changeShoptStatus(changeid) {
  var statusBtn = document.getElementById("shopstatus" + changeid);
  var activeUsers = document.querySelectorAll("#activeShops");

  statusBtn.classList.add("loading");

  var form = new FormData();
  form.append("cid", changeid);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      if (response == "2") {
        statusBtn.classList.remove("loading");
        statusBtn.classList.remove("teal");
        statusBtn.classList.add("red");
        statusBtn.innerHTML = "Blocked";

        activeUsers.forEach(function (element) {
          element.innerHTML = parseInt(element.innerHTML) - 1;
        });
      } else if (response == "1") {
        statusBtn.classList.remove("loading");
        statusBtn.classList.remove("red");
        statusBtn.classList.add("teal");
        statusBtn.innerHTML = "Activated";

        activeUsers.forEach(function (element) {
          element.innerHTML = parseInt(element.innerHTML) + 1;
        });
      } else {
        alert(response);
      }
    }
  };

  request.open("POST", "Process/changeShopStatus.php", true);
  request.send(form);
}

function bestCustomer() {
  var user_input = document.getElementById("userInput");
  var dashboard = document.getElementById("dashboardbtn");
  var users = document.getElementById("usersbtn");
  var bestCustomer = document.getElementById("bestcustomerId").dataset.value;
  user_input.value = bestCustomer;
  dashboard.classList.remove("active");
  users.classList.add("active");
  userToggle();
}
function bestShop() {
  var shop_input = document.getElementById("shopInput");
  var dashboard = document.getElementById("dashboardbtn");
  var shop = document.getElementById("shopbtn");
  var bestCustomer = document.getElementById("bestShopId").dataset.value;
  shop_input.value = bestCustomer;
  dashboard.classList.remove("active");
  shop.classList.add("active");
  sellerToggle();
}

function custLoader() {
  var box = document.getElementById("cusList");
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      box.innerHTML = response;
    }
  };

  request.open("POST", "Process/cusLoadAdmin.php", true);
  request.send();
}

setInterval(custLoader, 1000);

function openChatAdmin(cusId) {
  var cuspage = document.getElementById("cusPage");
  var chatPage = document.getElementById("chatPage");
  id = cusId;
  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      chatPage.innerHTML = response;
      cuspage.classList.remove("d-block");
      cuspage.classList.add("d-none");
      chatPage.classList.remove("d-none");
      chatPage.classList.add("d-block");
    }
  };
  var loopId = setInterval(chatLoadLoop, 500);
  blasetId = loopId;

  request.open("GET", "Process/chatadminLoader.php?cid=" + cusId, true);
  request.send();
}
var id = 0;
var blasetId = 0;

function chatLoadLoop() {
  var chatBoxScroll = document.getElementById("scrollBoxchat");

  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      chatBoxScroll.innerHTML = response;
      if (!chatBoxScroll.classList.contains("active")) {
        scrollToBottom();
      }
      chatBoxScroll.onmouseover = function () {
        chatBoxScroll.classList.add("active");
      };
      chatBoxScroll.onmouseleave = function () {
        chatBoxScroll.classList.remove("active");
      };
      if (!chatBoxScroll.classList.contains("active")) {
        chatBoxScroll.scrollTop = chatBoxScroll.scrollHeight;
      }
    }
  };

  request.open("GET", "Process/adminChatLoop.php?cid=" + id, true);
  request.send();
}

function closeChatAdmin() {
  var cuspage = document.getElementById("cusPage");
  var chatPage = document.getElementById("chatPage");

  cuspage.classList.remove("d-none");
  cuspage.classList.add("d-block");
  chatPage.classList.remove("d-block");
  chatPage.classList.add("d-none");

  clearInterval(blasetId);
}

function SendMsg(userId) {
  var chatBoxScroll = document.getElementById("scrollBoxchat");
  var txt = document.getElementById("typedTxt");

  var form = new FormData();
  form.append("t", txt.value);
  form.append("sid", userId);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      txt.value = "";
      if (response == "fail") {
        alert("Sending fail!");
      }
      chatBoxScroll.scrollTop = chatBoxScroll.scrollHeight;
    }
  };

  request.open("POST", "Process/chatadminSave.php", true);
  request.send(form);
}

// Manage Categories, Brands, Colors
var modelIncrement = 1;
var brandIncrement = 1;
var catIncrement = 1;
var clrIncrement = 1;

var shade = document.getElementById("shade");
var load = document.getElementById("load");

function modeladd(x) {
  shade.classList.remove("hide2");
  load.classList.remove("hide2");
  shade.classList.add("show1");
  load.classList.add("show2");

  var modeladd = document.getElementById("modeladd");
  var model = document.getElementById("modelDrop");

  if (x == null) {
    x = 1;
  }

  var newId = parseInt(x) + modelIncrement;
  modelIncrement = modelIncrement + 1;

  var form = new FormData();
  form.append("mv", newId);
  form.append("mn", modeladd.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;

      if (response == "success") {
        shade.classList.add("hide2");
        load.classList.add("hide2");
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
        shade.classList.add("hide2");
        load.classList.add("hide2");
        shade.classList.remove("show1");
        load.classList.remove("show2");
        var delayInMilliseconds = 300; //1 second

        setTimeout(function () {
          // alert("Field is Empty!");
          alert(response);
        }, delayInMilliseconds);
      }
    }
  };

  request.open("POST", "Process/addnewprop.php", true);
  request.send(form);
}

function brandadd(u) {
  shade.classList.remove("hide2");
  load.classList.remove("hide2");
  shade.classList.add("show1");
  load.classList.add("show2");

  var brandadd = document.getElementById("brandadd");
  var brand = document.getElementById("brandDrop");

  if (u == null) {
    u = 1;
  }
  var newId = parseInt(u) + brandIncrement;
  brandIncrement = brandIncrement + 1;

  var form = new FormData();
  form.append("bv", newId);
  form.append("bn", brandadd.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;

      if (response == "success") {
        shade.classList.add("hide2");
        load.classList.add("hide2");
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
        shade.classList.add("hide2");
        load.classList.add("hide2");
        shade.classList.remove("show1");
        load.classList.remove("show2");
        var delayInMilliseconds = 300; //1 second

        setTimeout(function () {
          alert(response);
        }, delayInMilliseconds);
      }
    }
  };

  request.open("POST", "Process/addnewprop.php", true);
  request.send(form);
}

function catadd(c) {
  shade.classList.remove("hide2");
  load.classList.remove("hide2");
  shade.classList.add("show1");
  load.classList.add("show2");

  var catadd = document.getElementById("category");
  var category = document.getElementById("CatDrop");

  if (c == null) {
    c = 1;
  }
  var newId = parseInt(c) + catIncrement;
  catIncrement = catIncrement + 1;

  var form = new FormData();
  form.append("catv", newId);
  form.append("catn", catadd.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;

      if (response == "success") {
        shade.classList.add("hide2");
        load.classList.add("hide2");
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
        shade.classList.add("hide2");
        load.classList.add("hide2");
        shade.classList.remove("show1");
        load.classList.remove("show2");
        var delayInMilliseconds = 300; //1 second

        setTimeout(function () {
          alert(response);
        }, delayInMilliseconds);
      }
    }
  };

  request.open("POST", "Process/addnewprop.php", true);
  request.send(form);
}

function clradd(q) {
  shade.classList.remove("hide2");
  load.classList.remove("hide2");
  shade.classList.add("show1");
  load.classList.add("show2");

  var clradd = document.getElementById("coloradd");
  var color = document.getElementById("colorDrop");

  if (q == null) {
    q = 1;
  }
  var newId = parseInt(q) + clrIncrement;
  clrIncrement = clrIncrement + 1;

  var form = new FormData();
  form.append("cv", newId);
  form.append("cn", clradd.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;

      if (response == "success") {
        shade.classList.add("hide2");
        load.classList.add("hide2");
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
        shade.classList.add("hide2");
        load.classList.add("hide2");
        shade.classList.remove("show1");
        load.classList.remove("show2");
        var delayInMilliseconds = 300; //1 second

        setTimeout(function () {
          alert(response);
        }, delayInMilliseconds);
      }
    }
  };

  request.open("POST", "Process/addnewprop.php", true);
  request.send(form);
}

// remove product properties

function modelDel() {
  shade.classList.remove("hide2");
  load.classList.remove("hide2");
  shade.classList.add("show1");
  load.classList.add("show2");

  var model = document.getElementById("modelDrop");

  var x = model.value;

  var form = new FormData();
  form.append("mv", x);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;

      if (response == "success") {
        shade.classList.add("hide2");
        load.classList.add("hide2");
        shade.classList.remove("show1");
        load.classList.remove("show2");

        $("#catManage").load(location.href + " #catManage");
      } else {
        shade.classList.add("hide2");
        load.classList.add("hide2");
        shade.classList.remove("show1");
        load.classList.remove("show2");

        setTimeout(function () {
          alert("Products are registered to this model!");
        }, 300);
      }
    }
  };

  request.open("POST", "Process/removePropadmin.php", true);
  request.send(form);
}

function brandDel() {
  shade.classList.remove("hide2");
  load.classList.remove("hide2");
  shade.classList.add("show1");
  load.classList.add("show2");

  var brand = document.getElementById("brandDrop");

  var u = brand.value;

  var form = new FormData();
  form.append("bn", u);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;

      if (response == "success") {
        shade.classList.add("hide2");
        load.classList.add("hide2");
        shade.classList.remove("show1");
        load.classList.remove("show2");

        $("#catManage").load(location.href + " #catManage");
      } else {
        shade.classList.add("hide2");
        load.classList.add("hide2");
        shade.classList.remove("show1");
        load.classList.remove("show2");

        setTimeout(function () {
          alert("Products are registered to this brand!");
        }, 300);
      }
    }
  };

  request.open("POST", "Process/removePropadmin.php", true);
  request.send(form);
}

function catDel() {
  shade.classList.remove("hide2");
  load.classList.remove("hide2");
  shade.classList.add("show1");
  load.classList.add("show2");

  var category = document.getElementById("CatDrop");

  var c = category.value;

  var form = new FormData();
  form.append("catn", c);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;

      if (response == "success") {
        shade.classList.add("hide2");
        load.classList.add("hide2");
        shade.classList.remove("show1");
        load.classList.remove("show2");

        $("#catManage").load(location.href + " #catManage");
      } else {
        shade.classList.add("hide2");
        load.classList.add("hide2");
        shade.classList.remove("show1");
        load.classList.remove("show2");

        setTimeout(function () {
          alert("Products are registered to this category!");
        }, 300);
      }
    }
  };

  request.open("POST", "Process/removePropadmin.php", true);
  request.send(form);
}

function clrDel() {
  shade.classList.remove("hide2");
  load.classList.remove("hide2");
  shade.classList.add("show1");
  load.classList.add("show2");

  var color = document.getElementById("colorDrop");

  var q = color.value;

  var form = new FormData();
  form.append("cn", q);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;

      if (response == "success") {
        shade.classList.add("hide2");
        load.classList.add("hide2");
        shade.classList.remove("show1");
        load.classList.remove("show2");

        $("#catManage").load(location.href + " #catManage");
      } else {
        shade.classList.add("hide2");
        load.classList.add("hide2");
        shade.classList.remove("show1");
        load.classList.remove("show2");

        setTimeout(function () {
          alert("Products are registered to this color!");
        }, 300);
      }
    }
  };

  request.open("POST", "Process/removePropadmin.php", true);
  request.send(form);
}

function profileModal() {
  $(".ui.modal")
    .modal("setting", "transition", "fade up")
    .modal("setting", "closable", true)
    .modal("show");
}

function addAdmin() {
  var fname = document.getElementById("adminfname");
  var lname = document.getElementById("adminlname");
  var email = document.getElementById("adminemail");
  var role = document.getElementById("role");
  var gender = document.getElementById("genderId");
  var dashboard = document.getElementById("dashCheck");
  var product = document.getElementById("prodCheck");
  var order = document.getElementById("orderCheck");
  var history = document.getElementById("histCheck");
  var user = document.getElementById("userCheck");
  var shop = document.getElementById("shopCheck");
  var admin = document.getElementById("adminCheck");
  var home = document.getElementById("homeCheck");

  var btn = document.getElementById("adminAddBtn");
  btn.classList.add("loading");
  var activeUsers = document.querySelectorAll("#activeAdmins");

  var form = new FormData();
  form.append("fname", fname.value);
  form.append("lname", lname.value);
  form.append("email", email.value);
  form.append("role", role.value);
  form.append("gender", gender.value);
  form.append("dash", dashboard.checked);
  form.append("product", product.checked);
  form.append("order", order.checked);
  form.append("hist", history.checked);
  form.append("user", user.checked);
  form.append("shop", shop.checked);
  form.append("admin", admin.checked);
  form.append("home", home.checked);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;

      if (response == "success") {
        btn.classList.remove("loading");
        showAlert("Admin added Successfully", "success");
        searchAdmin(1);
        activeUsers.forEach(function (element) {
          element.innerHTML = parseInt(element.innerHTML) + 1;
        });
        fname.value = "";
        lname.value = "";
        email.value = "";
        role.value = "";
        gender.value = "";
        dashboard.checked = false;
        product.checked = false;
        order.checked = false;
        history.checked = false;
        user.checked = false;
        shop.checked = false;
        admin.checked = false;
        home.checked = false;
      } else {
        btn.classList.remove("loading");
        showAlert(response, "error");
      }
    }
  };

  request.open("POST", "Process/addAdminProcess.php", true);
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

function reqPasswordReset(adminId) {
  var btn = document.getElementById("adminreset" + adminId);
  btn.classList.add("loading");

  var form = new FormData();
  form.append("id", adminId);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;

      if (response == "success") {
        showAlert("Reset password Confirmed", "success");
        searchAdminreset();
      } else {
        showAlert(response, "error");
      }
    }
  };

  request.open("POST", "Process/resetPasswordSendProcess.php", true);
  request.send(form);
}

function reqpwReset() {
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

  request.open("POST", "Process/reqRestPassword.php", true);
  request.send();
}

function changeProf() {
  var image = document.getElementById("image");

  image.onchange = function () {
    var file = this.files[0];
    var url = window.URL.createObjectURL(file);

    document.getElementById("ImagePlace").src = url;
    document.getElementById("profilepic").src = url;
  };
}

function updateadminProfile() {
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var image = document.getElementById("image");
  var fname2 = document.getElementById("profFname");

  var form = new FormData();
  form.append("fname", fname.value);
  form.append("lname", lname.value);
  form.append("image", image.files[0]);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;

      if (response == "success") {
        showAlert("Profile Updated Successfully", "success");
        fname2.innerHTML = fname.value;
        $(".ui.modal").modal("hide");
      } else {
        showAlert(response, "error");
      }
    }
  };

  request.open("POST", "Process/updateAdminProfile.php", true);
  request.send(form);
}
function closeprofilemodel() {
  $(".ui.modal").modal("hide");
}

function changeslides(id) {
  var image = document.getElementById("imageUp" + id);

  image.onchange = function () {
    var file_count = image.files.length;

    if (file_count <= 3) {
      for (var x = 0; x < file_count; x++) {
        var file = this.files[x];
        var url = window.URL.createObjectURL(file);
        document.getElementById("img" + id + x).src = url;
      }
      var form = new FormData();
      form.append("id", id);
      for (var x = 0; x < file_count; x++) {
        form.append("image" + x, image.files[x]);
      }
      var request = new XMLHttpRequest();

      request.onreadystatechange = function () {
        if ((request.readyState == 4) & (request.status == 200)) {
          var response = request.responseText;
          if (response == "success") {
            showAlert("Slides Updated successfully", "success");
          } else {
            showAlert(response, "error");
          }
        }
      };
      request.open("POST", "Process/updateCategorySlideImg.php", true);
      request.send(form);
    } else {
      showAlert(
        file_count +
          " images are selected! Only 3 images can maximum be uploaded per Category!",
        "error"
      );
    }
  };
}

function categoryStatus(id) {
  var tik = document.getElementById("cat" + id);
  var form = new FormData();
  form.append("id", id);
  form.append("tik", tik.checked);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      if (response == "success") {
        showAlert("Home Content Updated", "success");
        document.getElementById("homePreview").src =
          document.getElementById("homePreview").src;
      } else {
        showAlert(response, "error");
        tik.checked = false;
      }
    }
  };
  request.open("POST", "Process/updateCategoryContentStatus.php", true);
  request.send(form);
}

function redirectPrint() {
  var type = document.getElementById("SelectReport");
  var startD = document.getElementById("startDate");
  var endD = document.getElementById("endDate");
  var status = document.getElementById("reportstatusBtn");
  if (type.value == "") {
    status.classList.add("disabled");
  } else {
    status.classList.remove("disabled");
    window.open(
      "report.php?type=" +
        type.value +
        "&sD=" +
        startD.value +
        "&eD=" +
        endD.value +
        "&status=" +
        status.value,
      "_newtab"
    );
  }
}
function changeRportStatus() {
  var status = document.getElementById("reportstatusBtn");

  if (status.value == 3) {
    status.value = 1;
    status.classList.add("green");
    status.innerHTML = "Active";
  } else if (status.value == 1) {
    status.value = 2;
    status.classList.remove("green");
    status.classList.add("red");
    status.innerHTML = "Inactive";
  } else if (status.value == 2) {
    status.value = 3;
    status.classList.remove("red");
    status.innerHTML = "All";
  }
}

function disableActive() {
  var status = document.getElementById("reportstatusBtn");
  var type = document.getElementById("SelectReport");

  if (type.value == "5") {
    status.classList.add("disabled");
  } else if (type.value == "6") {
    status.classList.add("disabled");
  } else {
    status.classList.remove("disabled");
  }
}

function logoutAdmin() {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      if (response == "success") {
        window.location.reload();
      }
    }
  };

  request.open("POST", "process/adminSignout.php", true);
  request.send();
}

function SellerAccess() {
  var modal = document.getElementById("sellerModalAccees");
  var brand = document.getElementById("sellerBrandAccees");
  var cat = document.getElementById("sellerCategoryAccees");
  var clr = document.getElementById("sellerColorAccees");

  var form = new FormData();
  form.append("m", modal.checked);
  form.append("b", brand.checked);
  form.append("cat", cat.checked);
  form.append("clr", clr.checked);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      if (response == "success") {
        showAlert("Permissions Updated successfully", "success");
      } else {
        showAlert(response, "error");
      }
    }
  };

  request.open("POST", "process/SellerProductPermissionProcess.php", true);
  request.send(form);
}

function categoryChartLoad() {
  var chart = document.getElementById("categorySummary");
  var nochart = document.getElementById("nochart");
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      if (response == "noresult") {
        nochart.classList.remove("d-none");
        nochart.classList.add("d-flex");
      } else {
        json = JSON.parse(response);

        new Chart(chart, {
          type: "doughnut",
          data: {
            labels: json.names,
            datasets: [
              {
                label: "# of sold products",
                data: json.num,
                borderWidth: 1,
              },
            ],
          },
          options: {
            scales: {
              y: {
                beginAtZero: true,
              },
            },
          },
        });
      }
    }
  };

  request.open("POST", "process/CategoryChartLoadProcess.php", true);
  request.send();
}
