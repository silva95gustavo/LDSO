angular.module('starter.directives', []).directive('directives', function ($scope) {
    return {
        setHomeImage: function (url) {
            $('.view-with-bg').css('background-image', 'url(' + url + ')');
        }
    };
})
