//  ADD PRODUCT //
$(document).on("click", "#btn-add", function (e) {
  e.preventDefault();

  if ($("#image").get(0).files.length === 0) {
    return alert("Please add an image!");
  }
  if (
    $(".addForm").filter(function () {
      return this.value === "";
    }).length > 0
  ) {
    return alert("All fields are required!");
  }
  var form = $("#product_form");
  var formData = new FormData(form[0]);
  const cookie = "; " + document.cookie;

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
      } else {
        alert(dataResult);
      }
    },
  });
});
//  END ADD PRODUCT //

//  ADD CUSTOMER //
$(document).on("click", "#customerAdd", function (e) {
  e.preventDefault();
  var data = $("#customerForm").serialize();

  if (
    $(".addForm").filter(function () {
      return this.value === "";
    }).length > 0
  ) {
    return alert("All fields are required!");
  }

  console.log(data);
  $.ajax({
    data: data,
    type: "POST",
    url: "./backend/customer.php",
    success: function (dataResult) {
      var dataResult = JSON.parse(dataResult);

      if (dataResult.statusCode == 200) {
        $("#addCustomerModal").modal("hide");
        alert("Data added successfully !");
        location.reload();
      } else {
        alert(dataResult);
      }
    },
  });
});
//  END ADD CUSTOMER //

//  ADD USER //
$(document).on("click", "#userAdd", function (e) {
  e.preventDefault();
  var data = $("#userForm").serialize();

  if (
    $(".addForm").filter(function () {
      return this.value === "";
    }).length > 0
  ) {
    return alert("All fields are required!");
  }

  $.ajax({
    data: data,
    type: "POST",
    url: "./backend/user.php",
    success: function (dataResult) {
      var dataResult = JSON.parse(dataResult);

      if (dataResult.statusCode == 200) {
        $("#addUserModal").modal("hide");
        alert("Data added successfully !");
        location.reload();
      } else {
        alert(dataResult);
      }
    },
  });
});
//  END ADD USER //

//  BIND PRODUCT //
$(document).on("click", ".update", function (e) {
  var id = $(this).attr("data-id");
  var name = $(this).attr("data-name");
  var desc = $(this).attr("data-desc");
  var price = $(this).attr("data-price");
  var cat = $(this).attr("data-cat");
  var url = $(this).attr("data-url");

  $("#id_u").val(id);
  $("#name_u").val(name);
  $("#desc_u").val(desc);
  $("#price_u").val(price);
  $("#img-edit").attr("src", "../API/images/" + url);

  var category = document.getElementById("cat_u");
  for (i = 0; i < category.options.length; i++) {
    if (category.options[i].value == cat) {
      // Item is found. Set its property and exit
      category.options[i].selected = true;
      break;
    }
  }
});
// END BIND PRODUCT //

//  BIND CUSTOMER //
$(document).on("click", ".customerUpdate", function (e) {
  var id = $(this).attr("data-id");
  var first_name = $(this).attr("data-first_name");
  var last_name = $(this).attr("data-last_name");
  var mobile_number = $(this).attr("data-mobile_number");

  $("#id_u").val(id);
  $("#fname_u").val(first_name);
  $("#lname_u").val(last_name);
  $("#number_u").val(mobile_number);
});
// END BIND CUSTOMER //

// BIND USER //
$(document).on("click", ".userUpdate", function (e) {
  var id = $(this).attr("data-id");
  var username = $(this).attr("data-username");
  var password = $(this).attr("data-password");
  var level = $(this).attr("data-level");

  $("#id_u").val(id);
  $("#username_u").val(username);
  $("#password_u").val(password);
  var category = document.getElementById("level_u");
  for (i = 0; i < category.options.length; i++) {
    if (category.options[i].value == level) {
      // Item is found. Set its property and exit
      category.options[i].selected = true;
      break;
    }
  }
});
// END BIND USER //

//  UPDATE PRODUCT //
$(document).on("click", "#update", function (e) {
  e.preventDefault();
  var data = null;

  if ($("#imageEdit").get(0).files.length === 0) {
    if (
      $(".editForm").filter(function () {
        return this.value === "";
      }).length > 0
    ) {
      return alert("All fields are required!");
    }

    data = $("#update_form").find(":input").not(".dont_serialize").serialize();

    $.ajax({
      data: data,
      type: "POST",
      url: "./backend/product.php",
      success: function (dataResult) {
        console.log(dataResult);
        var dataResult = JSON.parse(dataResult);
        if (dataResult.statusCode == 200) {
          $("#editProductModal").modal("hide");
          alert("Data updated successfully !");
          location.reload();
        } else {
          alert(dataResult);
        }
      },
    });
  } else {
    var form = $("#update_form");
    data = new FormData(form[0]);

    $.ajax({
      data: data,
      type: "POST",
      url: "./backend/product.php",
      processData: false,
      contentType: false,
      success: function (dataResult) {
        console.log(dataResult);
        var dataResult = JSON.parse(dataResult);
        if (dataResult.statusCode == 200) {
          $("#editProductModal").modal("hide");
          alert("Data updated successfully !");
          location.reload();
        } else {
          alert(dataResult);
        }
      },
    });
  }
});
// END UPDATE PRODUCT //

//  UPDATE CUSTOMER //
$(document).on("click", "#customerUpdate", function (e) {
  e.preventDefault();
  if (
    $(".customerEditForm").filter(function () {
      return this.value === "";
    }).length > 0
  ) {
    return alert("All fields are required!");
  }

  data = $("#customerUpdate_form").serialize();

  console.log(data);

  $.ajax({
    data: data,
    type: "POST",
    url: "./backend/customer.php",
    success: function (dataResult) {
      console.log(dataResult);
      var dataResult = JSON.parse(dataResult);
      if (dataResult.statusCode == 200) {
        $("#editUserModal").modal("hide");
        alert("User updated successfully !");
        location.reload();
      } else {
        alert(dataResult);
      }
    },
  });
});
//  UPDATE CUSTOMER //

//  UPDATE USER //
$(document).on("click", "#userUpdate", function (e) {
  e.preventDefault();
  if (
    $(".userEditForm").filter(function () {
      return this.value === "";
    }).length > 0
  ) {
    return alert("All fields are required!");
  }

  data = $("#userUpdate_form").serialize();

  $.ajax({
    data: data,
    type: "POST",
    url: "./backend/user.php",
    success: function (dataResult) {
      console.log(dataResult);
      var dataResult = JSON.parse(dataResult);
      if (dataResult.statusCode == 200) {
        $("#editUserModal").modal("hide");
        alert("User updated successfully !");
        location.reload();
      } else {
        alert(dataResult);
      }
    },
  });
});
// END UPDATE USER //

//  DELETE
$(document).on("click", ".delete", function () {
  var id = $(this).attr("data-id");
  var url = $(this).attr("data-url");

  $("#id_d").val(id);
  $("#url_d").val(url);
});

$(document).on("click", ".customerDelete", function () {
  var id = $(this).attr("data-id");

  $("#cid_d").val(id);
});
$(document).on("click", ".userDelete", function () {
  var id = $(this).attr("data-id");

  $("#uid_d").val(id);
});
$(document).on("click", ".userDelete", function () {
  var id = $(this).attr("data-id");

  $("#id_d").val(id);
});

// DELETE PRODUCT //
$(document).on("click", "#delete", function () {
  $.ajax({
    url: "./backend/product.php",
    type: "POST",
    cache: false,
    data: {
      type: 3,
      id: $("#id_d").val(),
      url: $("#url_d").val(),
    },
    success: function (dataResult) {
      $("#deleteProductModal").modal("hide");
      $("#" + dataResult).remove();
      alert("User deleted successfully !");
    },
  });
});
// END DELETE PRODUCT //

// DELETE CUSTOMER //
$(document).on("click", "#customerDelete", function () {
  $.ajax({
    url: "./backend/customer.php",
    type: "POST",
    cache: false,
    data: {
      type: 3,
      id: $("#cid_d").val(),
    },
    success: function (dataResult) {
      $("#deleteCustomerModal").modal("hide");
      $("#" + dataResult).remove();
      alert("User deleted successfully !");
    },
  });
});
// END DELETE CUSTOMER //

// USER CUSTOMER //
$(document).on("click", "#userDelete", function () {
  $.ajax({
    url: "./backend/user.php",
    type: "POST",
    cache: false,
    data: {
      type: 3,
      id: $("#uid_d").val(),
    },
    success: function (dataResult) {
      $("#deleteUserModal").modal("hide");
      $("#" + dataResult).remove();
      alert("User deleted successfully !");
    },
  });
});
// END DELETE USER //

// VIEW ORDER //
$(document).on("click", ".order", function (e) {
  $("#showOrderModal").modal("show");
  var id = $(this).attr("data-id");
  var date = $(this).attr("data-date");
  var name = $(this).attr("data-name");

  $.ajax({
    url: "./backend/orders.php",
    type: "POST",
    cache: false,
    data: {
      id: id,
      date: date,
    },
    success: function (response) {
      var json = $.parseJSON(response);

      $(".header").empty();
      $(".orders").empty();

      $(".header").append(
        $("<h2/>", { text: name }).append($("<h2/>", { text: date }))
      );

      $.each(json, function (k, val) {
        $(".orders").append(
          $("<li/>", { class: "item" })
            .append($("<h2/>", { text: val.qty }))
            .append($("<h2/>", { text: val.item_name }))
            .append($("<h2/>", { text: val.price }))
        );
      });
    },
    error: function (error) {
      console.log(error, "err");
    },
  });
});
// END VIEW ORDER //

// $(document).on("click", "#delete_multiple", function () {
//   var user = [];
//   $(".user_checkbox:checked").each(function () {
//     user.push($(this).data("user-id"));
//   });
//   if (user.length <= 0) {
//     alert("Please select records.");
//   } else {
//     WRN_PROFILE_DELETE =
//       "Are you sure you want to delete " +
//       (user.length > 1 ? "these" : "this") +
//       " row?";
//     var checked = confirm(WRN_PROFILE_DELETE);
//     if (checked == true) {
//       var selected_values = user.join(",");
//       console.log(selected_values);
//       $.ajax({
//         type: "POST",
//         url: "backend/save.php",
//         cache: false,
//         data: {
//           type: 4,
//           id: selected_values,
//         },
//         success: function (response) {
//           var ids = response.split(",");
//           for (var i = 0; i < ids.length; i++) {
//             $("#" + ids[i]).remove();
//           }
//         },
//       });
//     }
//   }
// });

// $(document).ready(function () {
//   $('[data-toggle="tooltip"]').tooltip();
//   var checkbox = $('table tbody input[type="checkbox"]');
//   $("#selectAll").click(function () {
//     if (this.checked) {
//       checkbox.each(function () {
//         this.checked = true;
//       });
//     } else {
//       checkbox.each(function () {
//         this.checked = false;
//       });
//     }
//   });
//   checkbox.click(function () {
//     if (!this.checked) {
//       $("#selectAll").prop("checked", false);
//     }
//   });
// });
