var data = null;
var isEqualsJson = (obj1, obj2) => {
  keys1 = Object.keys(obj1);
  keys2 = Object.keys(obj2);

  return (
    keys1.length === keys2.length &&
    Object.keys(obj1).every((key) => obj1[key] == obj2[key])
  );
};

const getOrders = () => {
  $.ajax({
    type: "POST",
    url: "./php/fetchOrders.php",
    success: (res) => {
      // console.log(data);
      var newData = res;

      var data = localStorage.getItem("queue");

      if (data == null) {
        localStorage.setItem("queue", newData);
      } else if (!isEqualsJson(data, newData)) {
        localStorage.setItem("queue", newData);
        window.location.reload(1);
      }
      getOrders();
    },
    error: (res) => {
      // console.log(res);
      getOrders();
    },
  });
};

// initialize jQuery
$(function () {
  getOrders();
});

// (function runForever() {
//   $.ajax({
//     type: "POST",
//     url: "./php/fetchOrders.php",
//     success: function (res) {
//       console.log(res);
//       var newData = res;

//       var data = localStorage.getItem("queue");

//       if (data == null) {
//         localStorage.setItem("queue", newData);
//       } else if (!isEqualsJson(data, newData)) {
//         localStorage.setItem("queue", newData);
//         window.location.reload(1);
//       }
//     },
//   });
//   setTimeout(runForever, 800);
// })();

$(document).ready(function (e) {
  // $(".hide").slideUp(0);
  $('[data-toggle="toggle"]').click(function () {
    if ($(this).parents().next(".hide").is(":visible")) {
      $(this).parents().next(".hide").slideUp(0);
      //$(".plusminus" + $(this).children().children().attr("id")).text("+");
      $(this).removeClass().addClass("row");
    } else {
      $(this).parents().next(".hide").slideDown(0);
      //$(".plusminus" + $(this).children().children().attr("id")).text("-");
      $(this).removeClass().addClass("row_open");
    }
  });
});

$(".btnedit").click((e) => {
  data = e.target.dataset.id;

  e.stopPropagation();

  var overlayme = document.getElementById("dialog-container");
  var title = document.querySelector(".popup_title");

  title.innerHTML = "Mark this customer as done ?";

  overlayme.onclick = function () {
    overlayme.style.display = "none";
  };

  /* A function to show the dialog window */
  if (overlayme.style.display === "none") {
    overlayme.style.display = "block";
  } else {
    overlayme.style.display = "none";
  }

  // If confirm btn is clicked , the function confim() is executed
  document.getElementById("confirm").onclick = function () {
    $.ajax({
      type: "POST",
      url: "./php/api.php",
      data: { id: data, type: "remove" },
      success: function () {
        window.location.reload(1);
      },
      error: function () {
        window.location.reload(1);
      },
    });
    overlayme.style.display = "none";
  };

  // If cancel btn is clicked , the function cancel() is executed
  document.getElementById("cancel").onclick = function () {
    overlayme.style.display = "none";
  };
});

$(".paid").click((e) => {
  data = e.target.dataset.id;

  e.stopPropagation();

  var overlayme = document.getElementById("dialog-container");
  var title = document.querySelector(".popup_title");

  title.innerHTML = "Mark this customer as paid ?";

  overlayme.onclick = function () {
    overlayme.style.display = "none";
  };

  /* A function to show the dialog window */
  if (overlayme.style.display === "none") {
    overlayme.style.display = "block";
  } else {
    overlayme.style.display = "none";
  }

  // If confirm btn is clicked , the function confim() is executed
  document.getElementById("confirm").onclick = function () {
    $.ajax({
      type: "POST",
      url: "./php/api.php",
      data: { id: data, type: "pay" },
      success: function () {
        window.location.reload(1);
      },
      error: function () {
        window.location.reload(1);
      },
    });
    overlayme.style.display = "none";
  };

  // If cancel btn is clicked , the function cancel() is executed
  document.getElementById("cancel").onclick = function () {
    overlayme.style.display = "none";
  };
});

window.onkeyup = function (event) {
  if (event.keyCode == 32) {
    window.location.reload(1);
  }
  if (event.keyCode == 13) {
    $(".btnmain").click();
  }
};
