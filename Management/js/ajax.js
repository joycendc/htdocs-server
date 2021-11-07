$(document).on("click", "#btn-add", function (e) {
  // var data = $("#product_form").serialize();
  // console.log(data)
  var form = $("#product_form");
  var formData = new FormData(form[0]);

  $.ajax({
    data: formData,
    type: "POST",
    url: "./backend/product.php",
    processData: false,
    contentType: false,
    success: function (dataResult) {
      var dataResult = JSON.parse(dataResult);

      if (dataResult.statusCode == 200) {
        $("#addProductModal").modal("hide");
        alert("Data added successfully !");
        location.reload();
      } else if (dataResult.statusCode == 201) {
        alert(dataResult);
      }
    },
  });
});

$(document).on("click", ".update", function (e) {
  var id = $(this).attr("data-id");
  var name = $(this).attr("data-name");
  var desc = $(this).attr("data-desc");
  var price = $(this).attr("data-price");
  var cat = $(this).attr("data-cat");
  $("#id_u").val(id);
  $("#name_u").val(name);
  $("#desc_u").val(desc);
  $("#price_u").val(price);
  var category = document.getElementById("cat_u");
  for (i = 0; i < category.options.length; i++) {
    if (category.options[i].value == cat) {
      // Item is found. Set its property and exit
      category.options[i].selected = true;
      break;
    }
  }
});

$(document).on("click", "#update", function (e) {
  var data = $("#update_form").serialize();
  console.log(data);
  $.ajax({
    data: data,
    type: "POST",
    url: "./backend/product.php",
    success: function (dataResult) {
      console.log(dataResult);
      var dataResult = JSON.parse(dataResult);
      if (dataResult.statusCode == 200) {
        $("#editEmployeeModal").modal("hide");
        alert("Data updated successfully !");
        location.reload();
      } else if (dataResult.statusCode == 201) {
        alert(dataResult);
      }
    },
  });
});

$(document).on("click", ".delete", function () {
  var id = $(this).attr("data-id");
  $("#id_d").val(id);
});

$(document).on("click", "#delete", function () {
  $.ajax({
    url: "./backend/product.php",
    type: "POST",
    cache: false,
    data: {
      type: 3,
      id: $("#id_d").val(),
    },
    success: function (dataResult) {
      console.log(dataResult);
      $("#deleteProductModal").modal("hide");
      $("#" + dataResult).remove();
    },
  });
});

$(document).on("click", "#delete_multiple", function () {
  var user = [];
  $(".user_checkbox:checked").each(function () {
    user.push($(this).data("user-id"));
  });
  if (user.length <= 0) {
    alert("Please select records.");
  } else {
    WRN_PROFILE_DELETE =
      "Are you sure you want to delete " +
      (user.length > 1 ? "these" : "this") +
      " row?";
    var checked = confirm(WRN_PROFILE_DELETE);
    if (checked == true) {
      var selected_values = user.join(",");
      console.log(selected_values);
      $.ajax({
        type: "POST",
        url: "backend/save.php",
        cache: false,
        data: {
          type: 4,
          id: selected_values,
        },
        success: function (response) {
          var ids = response.split(",");
          for (var i = 0; i < ids.length; i++) {
            $("#" + ids[i]).remove();
          }
        },
      });
    }
  }
});

$(document).ready(function () {
  $('[data-toggle="tooltip"]').tooltip();
  var checkbox = $('table tbody input[type="checkbox"]');
  $("#selectAll").click(function () {
    if (this.checked) {
      checkbox.each(function () {
        this.checked = true;
      });
    } else {
      checkbox.each(function () {
        this.checked = false;
      });
    }
  });
  checkbox.click(function () {
    if (!this.checked) {
      $("#selectAll").prop("checked", false);
    }
  });
});
