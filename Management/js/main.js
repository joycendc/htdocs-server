var data = null;

(function runForever(){
    var newData;
    $.ajax({
        type: 'POST',
        url: './php/fetchOrders.php',
        success: function(res) {
            newData = res;
            var length = Object.keys(JSON.parse(newData)).length;
            console.log(length);
            if(data == null) {
                data = newData;
            } else if(data != newData){
                data = newData;
                window.location.reload(1);
            }
            
        },
    });  
    setTimeout(runForever, 500)
})()

$(document).ready(function (e) {  
    //$('.hide').slideUp(0);  
    $('[data-toggle="toggle"]').click(function () {  
        if ($(this).parents().next(".hide").is(':visible')) {  
            $(this).parents().next('.hide').slideUp(0);
            $(".plusminus" + $(this).children().children().attr("id")).text('+');  
            $(this).removeClass().addClass("row");
            //css('background-color', '#00923f');  
            }  
        else {  
            $(this).parents().next('.hide').slideDown(0);  
            $(".plusminus" + $(this).children().children().attr("id")).text('- ');  
            $(this).removeClass().addClass("row_open");
        }  
    });  
});  

$(".btnedit").click( e =>{
    data = e.target.dataset.id;

    if (confirm('Really?')) {
        $.ajax({
            type: 'POST',
            url: './php/api.php',
            data: { id: data, type: 'remove' },
            success: function() {
                window.location.reload(1);
            },
            error: function() {
                window.location.reload(1);
            }
        });
    }
});

$(".paid").click( e =>{
    data = e.target.dataset.id;

    if (confirm('Really?')) {
        $.ajax({
            type: 'POST',
            url: './php/api.php',
            data: { id: data, type: 'pay' },
            success: function() {
                window.location.reload(1);
            },
            error: function() {
                window.location.reload(1);
            }
        });
    }
});


window.onkeypress = function(event) {
    location.reload(1);
}