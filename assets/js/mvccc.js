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
                // alert("Data: " + data + "\nStatus: " + status);
            });
        });
    });
}(jQuery);


// TinyMCE
+function($){
    $(document).ready(function(){
        tinymce.init({
            selector: "textarea"
        });
    });
}(jQuery);

// Data picker
+function($){
    $(document).ready(function(){
        $(".input-group.date").datepicker({
            autoclose: true, 
            todayHighlight: true
        });
    });
}(jQuery);