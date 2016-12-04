angular.module('starter.controllers.restricted', [])

.controller('restrictedCtrl', function ($scope) {

  var ctrl = this;

  ctrl.login = $scope.login();

  localforage.getItem('session').then(function(value){
    ctrl.session = value;
  })
})
