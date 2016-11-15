angular.module('starter.controllers.menu', [])

.controller('menuCtrl', function ($scope, $ionicModal, $http, $timeout, requests) {
  // With the new view caching in Ionic, Controllers are only called
  // when they are recreated or on app start, instead of every page change.
  // To listen for when this page is active (for example, to refresh data),
  // listen for the $ionicView.enter event:

  var ctrl = this;

  // Form data for the login modal
  ctrl.loginData = {};
  $scope.$on('$ionicView.enter', function (e) {
    ctrl.loginData.username = "admin";
    ctrl.loginData.password = "qlamiepho4";
  });
  // Create the login modal that we will use later
  $ionicModal.fromTemplateUrl('views/login.html', {
    scope: $scope
  }).then(function (modal) {
    $scope.modal = modal;
  });

  // Triggered in the login modal to close it
  this.closeLogin = function () {
    $scope.modal.hide();
  };

  // Open the login modal
  this.login = function () {
    $scope.modal.show();
  };

  // Perform the login action when the user submits the login form
  this.doLogin = function () {
    requests.login(ctrl.loginData.username, ctrl.loginData.password)
    .then(
      function(response){
        console.log(response);
        $scope.session = {
          uid : response.data.current_user.uid,
          user : response.data.current_user.name,
          csrf_token : response.data.csrf_token,
          logout_token : response.data.logout_token,
          authenticated : (response.data.current_user.roles[0] === "authenticated"),
          administrator : (response.data.current_user.roles[1] === "administrator"),
        }
        console.log($scope.session);
      },
      function(response){
        console.log(response);
      }
    );
  };
})
