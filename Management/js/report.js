var barGraph = null;
$(document).ready(function () {
  $.datepicker.setDefaults({
    dateFormat: "yy-mm-dd",
    changeMonth: true,
    changeYear: true,
    maxDate: 0,
  });
  $(function () {
    $("#from_date").datepicker({
      onSelect: function () {
        var from_date = $("#from_date").val();
        var to_date = $("#to_date").val();
        if (from_date != "" && to_date != "") {
          $.ajax({
            url: "./php/report.php",
            method: "POST",
            data: { from_date: from_date, to_date: to_date },
            success: function (data) {
              //$('#order_table').html(data);
              var date = [];
              var total = [];
              var jdata = JSON.parse(data);
              var overall = 0;

              jdata.forEach((val) => {
                date.push(val.date);
                total.push(val.total);
                overall += parseInt(val.total);
              });

              var chartdata = {
                labels: date,
                datasets: [
                  {
                    label: "Sales Report",
                    backgroundColor: "#88242a",
                    borderColor: "#cf242a",
                    hoverBackgroundColor: "#CCCCCC",
                    hoverBorderColor: "#666666",
                    data: total,
                  },
                ],
              };

              barGraph.destroy();

              var chart = $("#myChart");

              barGraph = new Chart(chart, {
                type: "line",
                data: chartdata,
                options: {
                  responsive: true,
                  plugins: {
                    legend: {
                      position: "top",
                    },
                    title: {
                      display: true,
                      text: `Total : P ${numberWithCommas(overall)}`,
                    },
                  },
                },
              });
            },
          });
        }
      },
    });

    $("#to_date").datepicker({
      onSelect: function () {
        var from_date = $("#from_date").val();
        var to_date = $("#to_date").val();
        if (from_date != "" && to_date != "") {
          $.ajax({
            url: "./php/report.php",
            method: "POST",
            data: { from_date: from_date, to_date: to_date },
            success: function (data) {
              //$('#order_table').html(data);
              //const ctx = document.getElementById('myChart').getContext('2d');
              var date = [];
              var total = [];
              var jdata = JSON.parse(data);
              var overall = 0;

              jdata.forEach((val) => {
                date.push(val.date);
                total.push(val.total);
                overall += parseInt(val.total);
              });

              var chartdata = {
                labels: date,
                datasets: [
                  {
                    label: "Sales Report",
                    backgroundColor: "#88242a",
                    borderColor: "#cf242a",
                    hoverBackgroundColor: "#CCCCCC",
                    hoverBorderColor: "#666666",
                    data: total,
                  },
                ],
              };

              barGraph.destroy();

              var chart = $("#myChart");

              barGraph = new Chart(chart, {
                type: "line",
                data: chartdata,
                options: {
                  responsive: true,
                  plugins: {
                    legend: {
                      position: "top",
                    },
                    title: {
                      display: true,
                      text: `Total : P ${numberWithCommas(overall)}`,
                    },
                  },
                },
              });
            },
          });
        } else {
          alert("Please Select a date range first !");
        }
      },
    });
  });
  $("#filter").click(function () {
    var from_date = $("#from_date").val();
    var to_date = $("#to_date").val();
    if (from_date != "" && to_date != "") {
      $.ajax({
        url: "./php/report.php",
        method: "POST",
        data: { from_date: from_date, to_date: to_date },
        success: function (data) {
          $("#order_table").html(data);
        },
      });
    } else {
      alert("Please Select a date range first !");
    }
  });

  $.ajax({
    url: "./php/report.php",
    method: "POST",
    data: { all: true },
    success: function (data) {
      var date = [];
      var total = [];
      var jdata = JSON.parse(data);

      var overall = 0;
      jdata.forEach((val) => {
        date.push(val.date);
        total.push(val.total);
        overall += parseInt(val.total);
      });

      var chartdata = {
        labels: date,
        datasets: [
          {
            label: "Sales Report",
            backgroundColor: "#88242a",
            borderColor: "#cf242a",
            hoverBackgroundColor: "#CCCCCC",
            hoverBorderColor: "#666666",
            data: total,
          },
        ],
      };

      var chart = $("#myChart");

      barGraph = new Chart(chart, {
        type: "line",
        data: chartdata,
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: "top",
            },
            title: {
              display: true,
              text: `Total : P ${numberWithCommas(overall)}`,
            },
          },
        },
      });
    },
  });

  function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }
});
