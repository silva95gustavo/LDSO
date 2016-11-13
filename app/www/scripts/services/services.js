angular.module('starter.services', []).factory('services', function ($http) {
    return {
        getHomeText : function () {
           return $http.get('http://staging.cuidadores.tk?_format=json');
        }
    }
});