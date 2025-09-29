$(document).ready(function () {
  $("#menu1").click(function () {
    event.stopPropagation();
    $("#menu1").removeClass("rotate_back");
    $("#menu1").addClass("rotate");

    $("#sidebar1").animate(
      {
        left: "0px",
      },
      500,
      function () {}
    );
    $("#dim_home").animate(
      {
        opacity: "show",
        display: "block",
      },
      500,
      function () {}
    );
  });

  $("#side_close").click(function () {
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
  });
 

  function responsive(maxWidth) {
    if (maxWidth.matches) {
      $("#profile").click(function () {
        if ($("#signpop").hasClass("active_signpop")) {
          $("#signpop").animate(
            {
              top: 50,
              opacity: 1,
            },
            100,
            function () {
              $(this).removeClass("active_signpop");
              $(this).css("pointer-events", "all");
            }
          );
        } else {
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
      });
      $("#top_img").animate(
        {
          left: 50,
        },
        300,
        function () {}
      );
      $("#top_but").animate(
        {
          left: 220,
          opacity: 0,
        },
        300,
        function () {
          $("#top_but").css("display", "none");
        }
      );

      $("#menu1").animate(
        {
          opacity: 1,
        },
        300,
        function () {}
      );
      $("#signdiv").animate(
        {
          right: 0,
          opacity: 0,
        },
        300,
        function () {
          $(this).css("pointer-events", "none");
        }
      );
      $("#option").animate(
        {
          right: 50,
        },
        300,
        function () {}
      );
    } else {
      $("#carouselExampleCaptions").animate({
        transfrom: 800
      },300,function(){

      });
      $("#signpop").animate(
        {
          top: -30,
          opacity: 0,
        },
        100,
        function () {
          $(this).addClass("active_signpop");
          $(this).css("pointer-events", "none");
          $("#profile").off("click");
        }
      );
      $("#top_img").animate(
        {
          left: 0,
        },
        300,
        function () {}
      );
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
