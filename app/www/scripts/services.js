/**
 * This service is used for authentication purposes, all other pages require authenticated state in order to be presented
 * Check end of app.js
 */

 angular.module('starter.services', [])

 .factory('requests', function ($http, API) {
     return {
         getHomeImage: function () {
             return $http.get(API.images + 'home.png');
         },
         getHomeText: function () {
             return $http.get(API.domain + '?_format=json');
         },
         login: function (username, password) {
             return $http({
                 url: API.login,
                 method: "POST",
                 data: JSON.stringify({
                     name: username,
                     pass: password,
                 }),
                 headers: {
                     accept: "application/json"
                 }
             });
         },
         logout: function () {
             return $http.get(API.domain + '/user/logout');
         }
     }
 });"@@"
