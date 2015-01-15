(function ($) {
    $.mustache = function (template, view, partials) {
        return Mustache.render(template, view, partials);
    };

    $.fn.mustache = function (view, partials) {
        return $(this).map(function (i, elm) {
            var template = $.trim($(elm).html());
            var output = $.mustache(template, view, partials);
            return $(output).get();
        });
    };
})(jQuery);
