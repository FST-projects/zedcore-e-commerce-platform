var popback = document.getElementById("popback");
var menu = document.getElementById("menupop");
var profilebtn = document.getElementById("profilebox");
var searchBar = document.getElementById("searchbar");
var searchBar2 = document.getElementById("searchbar2");
var result_box = document.getElementById("resultBox");
var result_box2 = document.getElementById("resultBox2");

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
  if (!slideBox.contains(e.target) && !FilterBtn.contains(e.target)) {
    slideBox.classList.add("filterBox2");
    slideBox.classList.remove("activeSlide");
    Dback.classList.add("dBack");
    Dback.classList.remove("dBackShow");
    body.classList.remove("bodyStuck");
  }
  if (!searchBar.contains(e.target)) {
    result_box.classList.add("d-none");
  }
  if (!searchBar2.contains(e.target)) {
    result_box2.classList.add("d-none");
  }
};

var slideBox = document.getElementById("filterBox2");
var FilterBtn = document.getElementById("slideTrig");
var Dback = document.getElementById("dback");
var body = document.querySelector("body");
function slider() {
  slideBox.classList.toggle("filterBox2");
  slideBox.classList.toggle("activeSlide");
  Dback.classList.toggle("dBack");
  Dback.classList.toggle("dBackShow");
  body.classList.add("bodyStuck");
}

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
