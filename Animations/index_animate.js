$(document).ready(function () {
  

  $("#lg-btn").click(function () {
    $("#lg-btn").css("color", "rgb(17, 196, 142)");
    $("#reg-btn").css("color", "black");
    
    $("#pill-1").css(
      {
        bottom: "-40px",
        left: "-70px",
        position: "absolute",
        width: "120px",
        height: "200px",
        background: "linear-gradient(#6de2ff, #107aa3, #3e379c)",
        "border-radius": "40px",
      },
      function () {}
    );
    $("#pill-2").css(
      {
        top: "-280px",
        left: "-150px",
        position: "absolute",
        height: "420px",
        width: "130px",
        background: "linear-gradient(#ff966d, #53bdfa, #4d379c)",
        "border-radius": "200px",
        border: "30px solid #bdeeee",
      },
      function () {}
    );
    $("#pill-3").css(
      {
        top: "-100px",
        left: "190px",
        position: "absolute",
        height: "200px",
        width: "100px",
        background: "linear-gradient(#b6b1af, #4fd1f1, #89379c)",
        "border-radius": "70px",
      },
      function () {}
    );
    $("#pill-4").css(
      {
        bottom: "-220px",
        left: "220px",
        position: "absolute",
        height: "300px",
        width: "120px",
        background: "linear-gradient(#1660a5,#178bc0, #225d6e)",
        "border-radius": "70px",
      },
      function () {}
    );
    $("#pill-5").css(
      {
        top: "80px",
        left: "350px",
        position: "absolute",
        height: "300px",
        width: "220px",
        background: "linear-gradient(#1660a5,#178bc0, #225d6e)",
        "border-radius": "70px",
      },
      function () {}
    );
    $("#des-img").css(
      {
        position: "absolute",
        width: "200px",
        top: "90px",
        left: "90px",
      },
      function () {}
    );
  });
  $("#reg-btn").click(function () {
    $("#reg-btn").css("color", "rgb(17, 196, 142)");
    $("#lg-btn").css("color", "black");
    $("#pill-1").css(
      {
        bottom: "0px",
        left: "-70px",
        position: "absolute",
        width: "120px",
        height: "200px",
        background: "linear-gradient(#6de2ff, #107aa3, #3e379c)",
        "border-radius": "40px",
      },
      function () {}
    );
    $("#pill-2").css(
      {
        top: "-220px",
        left: "-180px",
        position: "absolute",
        height: "420px",
        width: "180px",
        background: "linear-gradient(#ff966d, #53bdfa, #4d379c)",
        "border-radius": "200px",
        border: "30px solid #bdeeee",
      },
      function () {}
    );
    $("#pill-3").css(
      {
        top: "-100px",
        left: "160px",
        position: "absolute",
        height: "200px",
        width: "100px",
        background: "linear-gradient(#b6b1af, #4fd1f1, #89379c)",
        "border-radius": "70px",
      },
      function () {}
    );
    $("#pill-4").css(
      {
        bottom: "-180px",
        left: "220px",
        position: "absolute",
        height: "300px",
        width: "120px",
        background: "linear-gradient(#1660a5,#178bc0, #225d6e)",
        "border-radius": "70px",
      },
      function () {}
    );
    $("#pill-5").css(
      {
        top: "80px",
        left: "350px",
        position: "absolute",
        height: "300px",
        width: "220px",
        background: "linear-gradient(#1660a5,#178bc0, #225d6e)",
        "border-radius": "70px",
      },
      function () {}
    );
    $("#des-img").css(
      {
        position: "absolute",
        width: "200px",
        top: "180px",
        left: "100px",
      },
      function () {}
    );
  });

  $("#reg-btn").click(function () {
    $("#signin").css(
      {
        transform: "translateX(-300px)",
        transition: "400ms",
      },
      400,
      function () {}
    );
    $("#signin").css("display", "none");
    $("#signup").css("display", "flex");
    $("#signin").animate(
      {
        opacity: 1,
      },
      400,
      function () {}
    );

    $("#signup").css(
      {
        transform: "translateX(0px)",
        transition: "400ms",
        "pointer-events": "all",
      },
      400,
      function () {}
    );
  });

  $("#lg-btn").click(function () {
    $("#signin").css("display", "flex");
    
    
    $("#signin").animate(
      {
        opacity: 1,
      },
      400,
      function () {}
    );
    $("#signup").css(
      {
        transform: "translateX(500px)",
        transition: "400ms",
        "pointer-events": "none",
      },
      400,
      function () {}
    );

    $("#signup").css("display", "none");

    $("#signin").css(
      {
        transform: "translateX(0px)",
        transition: "400ms",
      },
      400,
      function () {}
    );
  });
  $("#create-acc").click(function () {
    $("#reg-btn").css("color", "rgb(17, 196, 142)");
    $("#lg-btn").css("color", "black");
    $("#pill-1").css(
      {
        bottom: "0px",
        left: "-70px",
        position: "absolute",
        width: "120px",
        height: "200px",
        background: "linear-gradient(#6de2ff, #107aa3, #3e379c)",
        "border-radius": "40px",
      },
      function () {}
    );
    $("#pill-2").css(
      {
        top: "-220px",
        left: "-180px",
        position: "absolute",
        height: "420px",
        width: "180px",
        background: "linear-gradient(#ff966d, #53bdfa, #4d379c)",
        "border-radius": "200px",
        border: "30px solid #bdeeee",
      },
      function () {}
    );
    $("#pill-3").css(
      {
        top: "-100px",
        left: "160px",
        position: "absolute",
        height: "200px",
        width: "100px",
        background: "linear-gradient(#b6b1af, #4fd1f1, #89379c)",
        "border-radius": "70px",
      },
      function () {}
    );
    $("#pill-4").css(
      {
        bottom: "-180px",
        left: "220px",
        position: "absolute",
        height: "300px",
        width: "120px",
        background: "linear-gradient(#1660a5,#178bc0, #225d6e)",
        "border-radius": "70px",
      },
      function () {}
    );
    $("#pill-5").css(
      {
        top: "80px",
        left: "350px",
        position: "absolute",
        height: "300px",
        width: "220px",
        background: "linear-gradient(#1660a5,#178bc0, #225d6e)",
        "border-radius": "70px",
      },
      function () {}
    );
    $("#des-img").css(
      {
        position: "absolute",
        width: "200px",
        top: "180px",
        left: "100px",
      },
      function () {}
    );
    
    $("#signin").css(
      {
        transform: "translateX(-300px)",
        transition: "400ms",
      },
      400,
      function () {}
    );
    $("#signin").css("display", "none");
    $("#signup").css("display", "flex");
    $("#signin").animate(
      {
        opacity: 1,
      },
      400,
      function () {}
    );

    $("#signup").css(
      {
        transform: "translateX(0px)",
        transition: "400ms",
        "pointer-events": "all",
      },
      400,
      function () {}
    );

  });

  $("#hav-acc").click(function(){
    // alert('Have an account? Click here to sign in');
    $("#signin").css("display", "flex");

    $("#signin").animate(
      {
        opacity: 1,
      },
      400,
      function () {}
    );
    $("#signup").css(
      {
        transform: "translateX(500px)",
        transition: "400ms",
        "pointer-events": "none",
      },
      400,
      function () {}
    );

    $("#signup").css("display", "none");

    $("#signin").css(
      {
        transform: "translateX(0px)",
        transition: "400ms",
      },
      400,
      function () {}
    );

    $("#lg-btn").css("color", "rgb(17, 196, 142)");
    $("#reg-btn").css("color", "black");
    $("#pill-1").css(
      {
        bottom: "-40px",
        left: "-70px",
        position: "absolute",
        width: "120px",
        height: "200px",
        background: "linear-gradient(#6de2ff, #107aa3, #3e379c)",
        "border-radius": "40px",
      },
      function () {}
    );
    $("#pill-2").css(
      {
        top: "-280px",
        left: "-150px",
        position: "absolute",
        height: "420px",
        width: "130px",
        background: "linear-gradient(#ff966d, #53bdfa, #4d379c)",
        "border-radius": "200px",
        border: "30px solid #bdeeee",
      },
      function () {}
    );
    $("#pill-3").css(
      {
        top: "-100px",
        left: "190px",
        position: "absolute",
        height: "200px",
        width: "100px",
        background: "linear-gradient(#b6b1af, #4fd1f1, #89379c)",
        "border-radius": "70px",
      },
      function () {}
    );
    $("#pill-4").css(
      {
        bottom: "-220px",
        left: "220px",
        position: "absolute",
        height: "300px",
        width: "120px",
        background: "linear-gradient(#1660a5,#178bc0, #225d6e)",
        "border-radius": "70px",
      },
      function () {}
    );
    $("#pill-5").css(
      {
        top: "80px",
        left: "350px",
        position: "absolute",
        height: "300px",
        width: "220px",
        background: "linear-gradient(#1660a5,#178bc0, #225d6e)",
        "border-radius": "70px",
      },
      function () {}
    );
    $("#des-img").css(
      {
        position: "absolute",
        width: "200px",
        top: "120px",
        left: "90px",
      },
      function () {}
    );
  })
  function responsive(maxWidth) {
    if (maxWidth.matches) {
    } else {
      $("#top_but").animate(
        {
          left: 190,
          opacity: 1,
        },
        300,
        function () {
          $("#top_but").css("display", "flex");
        }
      );

      $("#menu1").animate(
        {
          opacity: 0,
        },
        300,
        function () {}
      );

      $("#signdiv").css("display", "flex");
      $("#signdiv").animate(
        {
          right: 70,
          opacity: 1,
        },
        300,
        function () {
          $(this).css("pointer-events", "all");
        }
      );
      $("#option").animate(
        {
          right: 200,
        },
        300,
        function () {}
      );
    }
  }
  var maxWidth = window.matchMedia("(max-width: 940px)");

  responsive(maxWidth);
  maxWidth.addListener(responsive);

  $(document).on("click", function (event) {
    // Check if the click is not inside #myDiv
    if (!$(event.target).closest("#profile").length) {
      // If not, hide the div
      $("#signpop").animate(
        {
          top: -30,
          opacity: 0,
        },
        100,
        function () {
          $(this).addClass("active_signpop");
          $(this).css("pointer-events", "none");
        }
      );
    }

    if (!$(event.target).closest("#sidebar1").length) {
      // If not, hide the div
    }

    // Hide the div when clicking outside of it
    $(document).on("click", function (event) {
      // Check if the click is not inside #myDiv and not on #toggleButton
      if (
        !$(event.target).closest("#sidebar1").length &&
        !$(event.target).is("#menu1")
      ) {
        // If not, hide the div
        $("#menu1").removeClass("rotate");
        $("#menu1").addClass("rotate_back");
        $("#sidebar1").animate(
          {
            left: "-350px",
          },
          500,
          function () {}
        );
        $("#dim_home").animate(
          {
            opacity: "hide",
            display: "none",
          },
          500,
          function () {}
        );
      }
    });
  });
});

