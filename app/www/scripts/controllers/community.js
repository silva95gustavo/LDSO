angular.module('starter.controllers.community', [])

.controller('communityCtrl', function ($scope, $ionicLoading) {

    $scope.loading = $ionicLoading.show();

    $('iframe').on('load', function() {
      $ionicLoading.hide();
      $('iframe').contents().find("#cuidadores_header").remove();
      $('iframe').contents().find("div .col-md-8").remove();
    });
  })
