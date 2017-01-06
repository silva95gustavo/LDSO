angular.module('starter.controllers.community', [])

.controller('communityCtrl', function ($scope, $ionicLoading, API, $sce) {
    var ctrl = this;
    ctrl.domain = $sce.trustAsResourceUrl(API.community);

    $scope.loading = $ionicLoading.show();

    $('iframe').on('load', function() {
      $ionicLoading.hide();
    });
  })
