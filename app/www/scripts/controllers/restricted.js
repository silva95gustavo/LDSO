angular.module('starter.controllers.restricted', [])

.controller('restrictedCtrl', function ($window, $scope, $ionicModal) {

  var ctrl = this;

  localforage.getItem('session').then(function(value){
    ctrl.session = value;
  })
})
