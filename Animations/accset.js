var acc_menu = document.getElementById("acc_menu");
var img_box = document.getElementById("img_box");
var img_circle = document.getElementById("img_circle");
var img = document.getElementById("img");
var name_box = document.getElementById("name_box");
var name_holder = document.getElementById("name_holder");
var d1 = document.getElementById("d1");
var d2 = document.getElementById("d2");
var d3 = document.getElementById("d3");
var icons = document.getElementById("icons");
var icons2 = document.getElementById("icons2");
var icons3 = document.getElementById("icons3");
var text = document.getElementById("text");
var text2 = document.getElementById("text2");
var text3 = document.getElementById("text3");
var acc_details = document.getElementById("acc_details");

//profile detail tabs
var editProfile = document.getElementById("editProfile");
var Security = document.getElementById("Security");
var Address = document.getElementById("Address");
var notification = document.getElementById("Notification");

var reshow = document.getElementById("reshow");

var menushow = false;

// media query event handler
if (matchMedia) {
  const mq = window.matchMedia("(max-width: 768px)");
  mq.addListener(WidthChange);
  WidthChange(mq);
}

// media query change
function WidthChange(mq) {
  if (mq.matches) {
    // window width is at least 500px

    d1.onclick = function () {
      if (menushow == false) {
        acc_menu.classList.toggle("acc-menu");
        img_box.classList.toggle("img-box");
        img_circle.classList.toggle("img-circle");
        img.classList.toggle("img");
        name_box.classList.toggle("name-box");
        name_holder.classList.toggle("name-holder");
        d1.classList.toggle("selection");
        d2.classList.toggle("selection");
        d3.classList.toggle("selection");
        icons.classList.toggle("icons");
        icons2.classList.toggle("icons");
        icons3.classList.toggle("icons");
        text.classList.toggle("text");
        text2.classList.toggle("text");
        text3.classList.toggle("text");
        acc_details.classList.toggle("acc-details");

        acc_menu.classList.toggle("acc-menu1");
        img_box.classList.toggle("img-box1");
        img_circle.classList.toggle("img-circle1");
        img.classList.toggle("img1");
        name_box.classList.toggle("name-box1");
        name_holder.classList.toggle("name-holder1");
        d1.classList.toggle("selection1");
        d2.classList.toggle("selection1");
        d3.classList.toggle("selection1");
        icons.classList.toggle("icons1");
        icons2.classList.toggle("icons1");
        icons3.classList.toggle("icons1");
        text.classList.toggle("text1");
        text2.classList.toggle("text1");
        text3.classList.toggle("text1");
        acc_details.classList.toggle("acc-details1");

        reshow.classList.toggle("d-none");
        menushow = true;
      }

      editProfile.classList.remove("d-none");
      Security.classList.add("d-none");
      Address.classList.add("d-none");
      notification.classList.add("d-none");

      d1.classList.toggle("actBtn");
      d2.classList.remove("actBtn");
      d3.classList.remove("actBtn");
    };

    d2.onclick = function () {
      if (menushow == false) {
        acc_menu.classList.toggle("acc-menu");
        img_box.classList.toggle("img-box");
        img_circle.classList.toggle("img-circle");
        img.classList.toggle("img");
        name_box.classList.toggle("name-box");
        name_holder.classList.toggle("name-holder");
        d1.classList.toggle("selection");
        d2.classList.toggle("selection");
        d3.classList.toggle("selection");
        icons.classList.toggle("icons");
        icons2.classList.toggle("icons");
        icons3.classList.toggle("icons");
        text.classList.toggle("text");
        text2.classList.toggle("text");
        text3.classList.toggle("text");
        acc_details.classList.toggle("acc-details");

        acc_menu.classList.toggle("acc-menu1");
        img_box.classList.toggle("img-box1");
        img_circle.classList.toggle("img-circle1");
        img.classList.toggle("img1");
        name_box.classList.toggle("name-box1");
        name_holder.classList.toggle("name-holder1");
        d1.classList.toggle("selection1");
        d2.classList.toggle("selection1");
        d3.classList.toggle("selection1");
        icons.classList.toggle("icons1");
        icons2.classList.toggle("icons1");
        icons3.classList.toggle("icons1");
        text.classList.toggle("text1");
        text2.classList.toggle("text1");
        text3.classList.toggle("text1");
        acc_details.classList.toggle("acc-details1");

        reshow.classList.toggle("d-none");
        menushow = true;
      }

      editProfile.classList.add("d-none");
      Security.classList.remove("d-none");
      Address.classList.add("d-none");
      notification.classList.add("d-none");

      d1.classList.remove("actBtn");
      d2.classList.toggle("actBtn");
      d3.classList.remove("actBtn");
    };

    d3.onclick = function () {
      if (menushow == false) {
        acc_menu.classList.toggle("acc-menu");
        img_box.classList.toggle("img-box");
        img_circle.classList.toggle("img-circle");
        img.classList.toggle("img");
        name_box.classList.toggle("name-box");
        name_holder.classList.toggle("name-holder");
        d1.classList.toggle("selection");
        d2.classList.toggle("selection");
        d3.classList.toggle("selection");
        icons.classList.toggle("icons");
        icons2.classList.toggle("icons");
        icons3.classList.toggle("icons");
        text.classList.toggle("text");
        text2.classList.toggle("text");
        text3.classList.toggle("text");
        acc_details.classList.toggle("acc-details");

        acc_menu.classList.toggle("acc-menu1");
        img_box.classList.toggle("img-box1");
        img_circle.classList.toggle("img-circle1");
        img.classList.toggle("img1");
        name_box.classList.toggle("name-box1");
        name_holder.classList.toggle("name-holder1");
        d1.classList.toggle("selection1");
        d2.classList.toggle("selection1");
        d3.classList.toggle("selection1");
        icons.classList.toggle("icons1");
        icons2.classList.toggle("icons1");
        icons3.classList.toggle("icons1");
        text.classList.toggle("text1");
        text2.classList.toggle("text1");
        text3.classList.toggle("text1");
        acc_details.classList.toggle("acc-details1");

        reshow.classList.toggle("d-none");
        menushow = true;
      }

      editProfile.classList.add("d-none");
      Security.classList.add("d-none");
      Address.classList.remove("d-none");
      notification.classList.add("d-none");

      d1.classList.remove("actBtn");
      d2.classList.remove("actBtn");
      d3.classList.toggle("actBtn");
    };



    reshow.onclick = function(){

      reshow.classList.toggle("d-none");// hide reshow btn
      menushow = false; // Avalable for toggle

      acc_menu.classList.toggle("acc-menu");
      img_box.classList.toggle("img-box");
      img_circle.classList.toggle("img-circle");
      img.classList.toggle("img");
      name_box.classList.toggle("name-box");
      name_holder.classList.toggle("name-holder");
      d1.classList.toggle("selection");
      d2.classList.toggle("selection");
      d3.classList.toggle("selection");
      icons.classList.toggle("icons");
      icons2.classList.toggle("icons");
      icons3.classList.toggle("icons");
      text.classList.toggle("text");
      text2.classList.toggle("text");
      text3.classList.toggle("text");
      acc_details.classList.toggle("acc-details");

      acc_menu.classList.toggle("acc-menu1");
      img_box.classList.toggle("img-box1");
      img_circle.classList.toggle("img-circle1");
      img.classList.toggle("img1");
      name_box.classList.toggle("name-box1");
      name_holder.classList.toggle("name-holder1");
      d1.classList.toggle("selection1");
      d2.classList.toggle("selection1");
      d3.classList.toggle("selection1");
      icons.classList.toggle("icons1");
      icons2.classList.toggle("icons1");
      icons3.classList.toggle("icons1");
      text.classList.toggle("text1");
      text2.classList.toggle("text1");
      text3.classList.toggle("text1");
      acc_details.classList.toggle("acc-details1");

    }
  } else {
    // window width is less than 500px
    reshow.classList.add("d-none");
    menushow = false;
    d1.onclick = function () {
      d1.classList.toggle("actBtn");
      d2.classList.remove("actBtn");
      d3.classList.remove("actBtn");

      editProfile.classList.remove("d-none");
      Security.classList.add("d-none");
      Address.classList.add("d-none");
      notification.classList.add("d-none");
    };
    d2.onclick = function () {
      d1.classList.remove("actBtn");
      d2.classList.toggle("actBtn");
      d3.classList.remove("actBtn");

      editProfile.classList.add("d-none");
      Security.classList.remove("d-none");
      Address.classList.add("d-none");
      notification.classList.add("d-none");
    };
    d3.onclick = function () {
      d1.classList.remove("actBtn");
      d2.classList.remove("actBtn");
      d3.classList.toggle("actBtn");

      editProfile.classList.add("d-none");
      Security.classList.add("d-none");
      Address.classList.remove("d-none");
      notification.classList.add("d-none");
    };


    acc_menu.classList.add("acc-menu");
    img_box.classList.add("img-box");
    img_circle.classList.add("img-circle");
    img.classList.add("img");
    name_box.classList.add("name-box");
    name_holder.classList.add("name-holder");
    d1.classList.add("selection");
    d2.classList.add("selection");
    d3.classList.add("selection");
    icons.classList.add("icons");
    icons2.classList.add("icons");
    icons3.classList.add("icons");
    text.classList.add("text");
    text2.classList.add("text");
    text3.classList.add("text");
    acc_details.classList.add("acc-details");

    acc_menu.classList.remove("acc-menu1");
    img_box.classList.remove("img-box1");
    img_circle.classList.remove("img-circle1");
    img.classList.remove("img1");
    name_box.classList.remove("name-box1");
    name_holder.classList.remove("name-holder1");
    d1.classList.remove("selection1");
    d2.classList.remove("selection1");
    d3.classList.remove("selection1");
    icons.classList.remove("icons1");
    icons2.classList.remove("icons1");
    icons3.classList.remove("icons1");
    text.classList.remove("text1");
    text2.classList.remove("text1");
    text3.classList.remove("text1");
    acc_details.classList.remove("acc-details1");
  }
}




function changeProf(){
  var image = document.getElementById("newProfile");

  image.onchange = function(){
    var file = this.files[0];
    var url = window.URL.createObjectURL(file);

    document.getElementById("inImg").src = url;
  }
}