angular.module('starter.controllers.menu', [])

.controller('menuCtrl', function ($scope, $ionicModal, $http, $state, $window, $ionicPopup, $timeout, requests) {
  // With the new view caching in Ionic, Controllers are only called
  // when they are recreated or on app start, instead of every page change.
  // To listen for when this page is active (for example, to refresh data),
  // listen for the $ionicView.enter event:

  var ctrl = this;

  ctrl.reload = function(){
    $window.location.reload(true);
  }

  localforage.getItem('session').then(function(value){
    ctrl.session = value;
  })

  // Form data for the login modal
  ctrl.loginData = {};
  /*$scope.$on('$ionicView.enter', function (e) {
    ctrl.loginData.username = "admin@cuidadores.tk";
    ctrl.loginData.password = "qlamiepho4";
  });*/
  // Create the login modal that we will use later
  $ionicModal.fromTemplateUrl('views/login.html', {
    scope: $scope
  }).then(function (modal) {
    $scope.modal = modal;
  });

  // Triggered in the login modal to close it
  ctrl.closeLogin = function () {
    $scope.modal.hide();
  };

  // Open the login modal
  ctrl.login = function () {
    $scope.modal.show();
  };
  $scope.loginSuccess = function() {
    $ionicPopup.alert({
      title: 'Login',
      template: '<div style="text-align:center;">Login efetuado com sucesso.</div>'
    }).then(function (succ) {
      // redirect on login success
      $scope.modal.hide();
      $window.location.reload(true);
    })
  };
  $scope.loginFail = function() {
    $ionicPopup.alert({
      title: 'Login',
      template: '<div style="text-align:center;">Algo correu mal.<br>Verifique os seus dados.</div>'
    });
  };
  // Perform the login action when the user submits the login form
  ctrl.doLogin = function () {
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
        localforage.setItem('session', $scope.session);
        ctrl.session = $scope.session;
        $scope.loginSuccess();
      },
      function(response){
        console.log(response);
        $scope.loginFail();
      }
    );
  };

  ctrl.logout = function() {
    requests.logout().then(
      localforage.removeItem('session').then(function (value) {
        ctrl.session = null;
        $ionicPopup.alert({
          title: 'Logged out',
          template: 'Logged out successfully'
        }).then($state.go('home'));
      }
    ));
  }
})
