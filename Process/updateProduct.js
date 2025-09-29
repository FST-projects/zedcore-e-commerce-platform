

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


function help(){
    alert("Developing...")
}

function signout(){
    var request = new XMLHttpRequest();

    request.onreadystatechange= function(){
        if(request.status == 200 & request.readyState == 4){
            var response = request.responseText;
            if(response == "success"){
                window.location.reload();
            }
        }
    }

    request.open("POST", "homeProcess/signout.php", true);
    request.send();
}
