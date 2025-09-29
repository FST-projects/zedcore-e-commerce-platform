var popback = document.getElementById("popback");
var menu = document.getElementById("menupop");
var profilebtn = document.getElementById("profilebox");
var searchBarmain = document.getElementById("mainsearchbar");
var result_boxmain = document.getElementById("homereslt");
var slideBox = document.getElementById("filterBox2");
var FilterBtn = document.getElementById("slideTrig");
var Dback2 = document.getElementById("dback");
var Dback = document.getElementById("notifyblackbg");
var body = document.querySelector("body");
var notifyBar = document.getElementById("sideBarNotify");
var notibtn = document.getElementById("notibtn");

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
  if (menu && profilebtn) {
    if (!menu.contains(e.target) && !profilebtn.contains(e.target)) {
      menu.classList.add("menuclose");
      menu.classList.remove("menuanimate");
      popback.classList.add("eventsoff");
      popback.classList.remove("eventson");
    }
  }
  if (slideBox && FilterBtn) {
    if (!slideBox.contains(e.target) && !FilterBtn.contains(e.target)) {
      slideBox.classList.add("filterBox2");
      slideBox.classList.remove("activeSlide");
      Dback2.classList.add("dBack");
      Dback2.classList.remove("dBackShow");
      body.classList.remove("bodyStuck");
    }
  }
  if (searchBarmain) {
    if (!searchBarmain.contains(e.target)) {
      result_boxmain.classList.add("d-none");
    }
  }
  if (notifyBar && notibtn) {
    if (!notifyBar.contains(e.target) && !notibtn.contains(e.target)) {
      notifyBar.classList.remove("notifyTrans");
      Dback.classList.add("blackdisplay");
      Dback.classList.remove("blackdisplayView");
    }
  }
};

function bestDivScrolLeft(id) {
  const scrollContainer = document.getElementById("best"+id);
  scrollContainer.scrollLeft -= 230;
}
function bestDivScrolRight(id) {
  const scrollContainer = document.getElementById("best"+id);
  scrollContainer.scrollLeft += 230;
}
function mostViewDivScrolLeft() {
  const scrollContainer = document.getElementById("mostView");
  scrollContainer.scrollLeft -= 230;
}
function mostViewDivScrolRight() {
  const scrollContainer = document.getElementById("mostView");
  scrollContainer.scrollLeft += 230;
}
function speakersDivScrolLeft(id) {
  const scrollContainer = document.getElementById("slideId" + id);
  scrollContainer.scrollLeft -= 230;
}
function speakersDivScrolRight(id) {
  const scrollContainer = document.getElementById("slideId" + id);
  scrollContainer.scrollLeft += 230;
}
