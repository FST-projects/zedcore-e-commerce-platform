function historyLoad(page) {
  var content = document.getElementById("histContent");
  var btn = document.getElementById("loadMoreBtn");

  var form = new FormData();
  form.append("page", page);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      content.innerHTML = response;
    }
  };

  request.open("POST", "Process/orderHistoryLoadProcess.php", true);
  request.send(form);
}

function btnHistoryLoad(page) {
  var content = document.getElementById("histContent");
  var btn = document.getElementById("loadMoreBtn");

  btn.classList.add("loading");

  var form = new FormData();
  form.append("page", page);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = request.responseText;
      content.innerHTML = response;
    //   btn.classList.remove("loading");
    }
  };

  request.open("POST", "Process/orderHistoryLoadProcess.php", true);
  request.send(form);
}
