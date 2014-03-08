+function($){
    $(document).ready(function() {
        var $container = $('#container');
        // initialize
        $container.masonry({
            columnWidth: 0,
            itemSelector: '.gallery-item'
        });
    });
}(jQuery)