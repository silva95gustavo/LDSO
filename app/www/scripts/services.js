/**
 * This service is used for authentication purposes, all other pages require authenticated state in order to be presented
 * Check end of app.js
 */

angular.module('starter.services', [])

    .factory('requests', function ($http, HOST, IMAGES) {
        return {
            getHomeImage: function () {
                return $http.get(HOST.domain + IMAGES.url + 'home_0.png');
            },
            getHomeText: function () {
                return $http.get(HOST.domain + '?_format=json');
            },
            login: function (username, password) {
                return $http({
                    crossDomain: true,
                    url: HOST.domain + "/user/login",
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
            logout: function (csrfToken, logoutToken) {
                return $http({
                    crossDomain: true,
                    url: HOST.domain + "/user/logout",
                    method: "POST",
                    data : {
                        
                        'x-csrf-token': csrfToken,
                        'logout-token': logoutToken
                    },
                    headers: {
                        accept: "application/json"

                    }
                });
            }
        }
    }); "@@"
