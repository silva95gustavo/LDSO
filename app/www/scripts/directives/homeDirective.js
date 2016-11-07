angular.module('starter.directives', []).directive('homeDirective', function () {
    return {
        restrict: 'A',
        link: function() {
            angular.element(document).ready(function (){
                $('.view-with-bg').css('background', 'url(../img/home.png)', 'no-repeat', 'top', 'center');
                $('.view-with-bg').css('-webkit-background-size', '100%');
                $('.view-with-bg').css('-moz-background-size', '100%');
                $('.view-with-bg').css('-o-background-size', '100%');
                $('.view-with-bg').css('background-size', '100%');
            });
        }
    };
})
