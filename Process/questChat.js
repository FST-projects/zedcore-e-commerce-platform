function custLoader() {
  var box = document.getElementById("cusList");
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      box.innerHTML = response;
    }
  };

  request.open("POST", "Process/productItemChat.php", true);
  request.send();
}

setInterval(custLoader, 1000);

function openChatAdmin(pid) {
  var cuspage = document.getElementById("cusPage");
  var chatPage = document.getElementById("chatPage");
  id = pid;
  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      chatPage.innerHTML = response;
      cuspage.classList.remove("d-block");
      cuspage.classList.add("d-none");
      chatPage.classList.remove("d-none");
      chatPage.classList.add("d-block");

      var form = document.querySelectorAll("#form");
      form.forEach((element) => {
        element.onsubmit = (e) => {
          e.preventDefault();
        };
      });
    }
  };
  var loopId = setInterval(chatLoadLoop, 1000);
  blasetId = loopId;

  request.open("GET", "Process/productChatLoader.php?cid=" + pid, true);
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

      var form = document.querySelectorAll("#form");
      form.forEach((element) => {
        element.onsubmit = (e) => {
          e.preventDefault();
        };
      });
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
  request.open("GET", "Process/productQuestChatLoop.php?cid=" + id, true);
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

function UpAnswer(productId) {
  var txt = document.getElementById("typedTxt" + productId);

  var form = new FormData();
  form.append("t", txt.value);
  form.append("sid", productId);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      txt.value = "";
      if (response == "fail") {
        alert("Sending fail!");
      }
      var loopId = setInterval(chatLoadLoop, 1000);
      blasetId = loopId;
    }
  };

  request.open("POST", "Process/updateqesAnswer.php", true);
  request.send(form);
}

function stopLoop() {
  clearInterval(blasetId);
}
