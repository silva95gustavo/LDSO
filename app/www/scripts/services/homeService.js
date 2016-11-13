angular.module('starter.services', []).factory('homeService', function ($http) {
    return {
        getHomeText: function (func) {
            $http({
                method: "GET",
                url: "http://staging.cuidadores.tk?_format=json"
            }).then(function(response) {
                console.log(response);
                func(response);
                return response;
            })

        }
    }

});