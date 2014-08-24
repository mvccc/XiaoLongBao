// Delete event in calendar when delete button is clicked.
+function($){
    $(document).ready(function(){
        $("button[name='delete-event']").click(function(){
            var id = $(this).attr('target-id');
            var target = "#event-" + id;
            var url = $(this).attr('url');
            // alert(url);
            $(target).slideUp();
            $.post(url, null, function(data,status){
                // TODO: 
                // alert("Data: " + data + "\nStatus: " + status);
            });
        });
    });
}(jQuery);

//Delete sunday message when delete button is clicked.
+function($){
    $(document).ready(function(){
        $("button[name='delete-sundaymessage']").click(function(){
            var id = $(this).attr('target-id');
            var target = "#sundaymessage-" + id;
            var url = $(this).attr('url');
            // alert(url);
            $(target).slideUp();
            $.post(url, null, function(data,status){
                // TODO: 
                // alert("Data: " + data + "\nStatus: " + status);
            });
        });
    });
}(jQuery);

// JQuery scroll panel
+function($){
    $(document).ready(function(){
        $("#scroll_panel").slimScroll({
          height: '300px'
        });
    });
}(jQuery)

// Calendar create event popup
/*
+function($){
    $(document).ready(function(){
        $(".calendarDay").click(function(){
            number = $(this).find(".calDay").html();
            $(this).popover({ title: 'Look! A bird!', placement: 'left'});
        });
    });
}(jQuery)
*/
+function($){
    $(document).ready(function(){
        $(".form-prayer").on("click", ".btn-deleteprayer", function($event){
            $($event.target).closest("li.li-prayer").remove();
        });
        $(".form-prayer").on("click", ".btn-addprayer", function($event){
            var $currentItem = $($event.target).closest("li.li-prayer");
            var $newItem = $currentItem.clone();
            $newItem.find(".textbox-prayer").val("");
            $currentItem.after($newItem);
            
        });
    });
}(jQuery)


$(function(){
    $.stellar({
        horizontalScrolling: false,
        verticalOffset: 40
    });
});