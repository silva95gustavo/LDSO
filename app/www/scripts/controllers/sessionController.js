angular.module('starter.controllers').controller('sessionController', function ($scope, $ionicModal, $http, $timeout) {

  // With the new view caching in Ionic, Controllers are only called
  // when they are recreated or on app start, instead of every page change.
  // To listen for when this page is active (for example, to refresh data),
  // listen for the $ionicView.enter event:

  // Form data for the login modal
  $scope.loginData = {};
  $scope.$on('$ionicView.enter', function (e) {
    $scope.loginData.username = "admin@cuidadores.tk";
    $scope.loginData.password = "qlamiepho4";
  });
  // Create the login modal that we will use later
  $ionicModal.fromTemplateUrl('views/login.html', {
    scope: $scope
  }).then(function (modal) {
    $scope.modal = modal;
  });

  // Triggered in the login modal to close it
  $scope.closeLogin = function () {
    $scope.modal.hide();
  };

  // Open the login modal
  $scope.login = function () {
    $scope.modal.show();
  };

  // Perform the login action when the user submits the login form
  $scope.doLogin = function () {
    console.log('Doing login', $scope.loginData);
    $http.get('http://staging.cuidadores.tk/rest/session/token').then(function (response) {
      console.log(response.data);
      var settings = {
        "async": true,
        "crossDomain": true,
        "url": "http://staging.cuidadores.tk/user/login",
        "method": "POST",
        /*"data": {
          "username": "admin",
          "password": "qlamiepho4",
        },*/
        "headers": {
          "x-csrf-token": response.data,
          "accept": "application/hal+json",
          "content-type": "application/hal+json",
          "authorization": "Basic " + btoa("admin:qlamiepho4"),
          "cache-control": "no-cache",
        }
      }
      $.ajax(settings).done(function (response) {
        console.log(response);
        $scope.closeLogin();
      });
    });
    /*
    $.ajax({
        "async": true,
        "crossDomain": true,
        "url": "http://staging.cuidadores.tk/user/login",
        "method": "POST",
        "data": {
          "username": "admin@cuidadores.tk",
          "password": "qlamiepho4",
        },
        "headers": {
          //"x-csrf-token": response.data,
          "accept": "application/hal+json",
          "content-type": "application/hal+json",
          "authorization": "Basic YWRtaW5AY3VpZGFkb3Jlcy50azpxbGFtaWVwaG80",
          "cache-control": "no-cache",
        }
      }).done(function (response) {
        console.log(response);
      });
    
    
    $http({
      method: 'POST',
      url: 'http://staging.cuidadores.tk/user',
      data: $.param($scope.loginData),  // pass in data as strings
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)
    }).success(function(response){
      console.log(response);
    });*/
    /*$(function () {
      var settings = {
        "async": true,
        "crossDomain": true,
        "url": "http://staging.cuidadores.tk/user/login", // Change to your Drupal URL
        "method": "POST",
        "headers": { "Content-Type": "application/json" },
        "data": {
          "name": "admin", // Change to your real login
          "pass": "password", // Change to your real password
          "form_id": "user_login_form"
        }
      }

      $.ajax(settings).done(function (response) {
        console.log(response);
      });

      curl -X POST -i -H "Content-type: application/json" -c cookies.txt -X POST http://staging.cuidadores.tk/service/user/login -d '{"username":"user", "password":"password"}'
      curl -X POST -H "X-CSRF-Token: qj-tSmuik7pWfBA6HELB2TgZXpV5auMcACqqKR-NUMQ" -H "Accept: application/hal+json" -H "Content-Type: application/hal+json" -H "Authorization: Basic YWRtaW46YWRtaW4=" -H "Cache-Control: no-cache" -H "Postman-Token: 02ca9291-a112-4a0e-d254-6c775effa969" -d 'false' "http://localhost:8888/user/login"
    });*/


    // Simulate a login delay. Remove this and replace with your login
    // code if using a login system
    /*$timeout(function () {
      $scope.closeLogin();
    }, 1000);*/
  };
})