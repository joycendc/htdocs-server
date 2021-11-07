var data = null;

(function runForever() {
  $.ajax({
    type: "POST",
    url: "./php/fetchOrders.php",
    success: function (res) {
      var length = Object.keys(JSON.parse(res)).length;
      //console.log(length);

      var data = localStorage.getItem("length");
      //console.log(data);

      if (data == null) {
        localStorage.setItem("length", length);
      } else if (data != length) {
        localStorage.setItem("length", length);
        window.location.reload(1);
      }
    },
  });
  setTimeout(runForever, 500);
})();

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

  if (confirm("Really?")) {
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
  }
});

$(".paid").click((e) => {
  data = e.target.dataset.id;

  if (confirm("Really?")) {
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
  }
});

window.onkeyup = function (event) {
  if (event.keyCode == 32) {
    window.location.reload(1);
  }
  if (event.keyCode == 13) {
    $(".btnmain").click();
  }
};
