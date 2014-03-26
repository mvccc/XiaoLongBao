+function($){
    $(document).ready(function() {
        $("img").load(function() {
            jQuery("#container").masonry();
        });

        var $container = $('#container');
        // initialize
        $container.masonry({
            columnWidth: 0,
            itemSelector: '.gallery-item'
        });
    });
}(jQuery)