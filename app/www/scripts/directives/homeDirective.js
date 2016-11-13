angular.module('starter.directives', []).directive('homeDirective', function () {
    return {
        restrict: 'A',
        link: function(scope) {
            var url = scope.home.image;
            $('.view-with-bg').css('background', 'url(' + url + ')', 'no-repeat', 'top', 'center');
            $('.view-with-bg').css('background-size', '100%');
        }
    };
})
