angular.module('starter.controllers.community', [])

.controller('communityCtrl', function ($scope, $ionicLoading) {

    $scope.loading = $ionicLoading.show();

    $('iframe').on('load', function() {
      $ionicLoading.hide();
    });
  })
