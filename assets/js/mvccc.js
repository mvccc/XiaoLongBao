// Delete event in calendar when delete button is clicked.
+function($){
    $(document).ready(function(){
        $("button[name='delete-event']").click(function(){
            var id = $(this).attr('target-id');
            var target = "#event-" + id;
            var url = $(this).attr('url');
            // alert(url);
            $(target).slideUp();
            $.post(url, null,function(data,status){
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