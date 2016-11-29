/**
 * This service is used for authentication purposes, all other pages require authenticated state in order to be presented
 * Check end of app.js
 */

 angular.module('starter.services', [])

 .factory('requests', function ($http, HOST, IMAGES) {
     return {
         getHomeImage: function () {
             return $http.get(HOST.domain + IMAGES.url + 'home.png');
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
     }
 });"@@"
