angular.module('starter.controllers.menu', [])

  .controller('menuCtrl', function ($scope, $ionicModal, $ionicPopup, $state, $http, $timeout, requests) {
    // With the new view caching in Ionic, Controllers are only called
    // when they are recreated or on app start, instead of every page change.
    // To listen for when this page is active (for example, to refresh data),
    // listen for the $ionicView.enter event:

    $scope.session = {};
    $scope.session.authenticated = false;

    var ctrl = this;

    // Form data for the login modal
    ctrl.loginData = {};
    $scope.$on('$ionicView.enter', function (e) {
      ctrl.loginData.username = "admin@cuidadores.tk";
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
      if (!$scope.session.authenticated)
        $scope.modal.show();
      else $state.go('restricted');
    };

    // Perform the login action when the user submits the login form
    this.doLogin = function () {
      requests.login(ctrl.loginData.username, ctrl.loginData.password)
        .success(function (response) {
          console.log(response);
          $scope.session = {
            set: true,
            uid: response.current_user.uid,
            user: response.current_user.name,
            csrf_token: response.csrf_token,
            logout_token: response.logout_token,
            authenticated: (response.current_user.roles[0] === "authenticated"),
            administrator: (response.current_user.roles[1] === "administrator"),
          }
          console.log($scope.session);
          $scope.modal.hide();
          $state.go('restricted');
        })
        .error(function () {
          $ionicPopup.alert({
            title: 'Erro na autenticação',
            template: 'O nome de utilizador ou a palavra-chave estão errados.<br> Tente novamente'
          });
        })
    };

    this.logout = function () {
      requests.logout($scope.session.csrf_token, $scope.session.logout_token)
        .then(function (response) {
          console.log(response);
          $scope.session = {
            set: false,
            uid: null,
            user: null,
            csrf_token: null,
            logout_token: null,
            authenticated: false,
            administrator: false,
          }
          console.log($scope.session);
          $state.go('home');
        })
    };
  })
