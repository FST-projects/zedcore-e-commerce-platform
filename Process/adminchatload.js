var InnerBox = document.getElementById("ChatScroll");

InnerBox.onmouseover = function(){
    InnerBox.classList.add("active");
}
InnerBox.onmouseleave = function(){
    InnerBox.classList.remove("active");
}

function adminChatLoad() {
  var InnerBox = document.getElementById("ChatScroll");

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      InnerBox.innerHTML = response;
      if(!InnerBox.classList.contains("active")){
        scrollToBottom();
      }
    }
  };

  request.open("POST", "Process/chatadminLoader.php", true);
  request.send();
}

setInterval(adminChatLoad, 500);


function scrollToBottom(){
    InnerBox.scrollTop = InnerBox.scrollHeight;
}



function SendMsg() {
  var txt = document.getElementById("typedTxt");

  var form = new FormData();
  form.append("t", txt.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      var response = request.responseText;
      txt.value ="";
      if(response == "fail"){
        alert("Sending fail!");
      }
    }
  };

  request.open("POST", "Process/chatadminSave.php", true);
  request.send(form);
}
