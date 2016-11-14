angular.module('starter.services', []).factory('services', function ($http) {
    return {
        getHomeText: function () {
            return $http.get('http://staging.cuidadores.tk?_format=json');
        },
        login: function (username, password) {
            return $http({
                crossDomain: true,
                url: "http://staging.cuidadores.tk/user/login",
                method: "POST",
                data: JSON.stringify({
                    name: username,
                    pass: password,
                }),
                headers: {
                    accept: "application/json",
                }
            });
        },
    }
});