angular.module('starter.controllers.services', [])

  .controller('servicesCtrl', function ($scope, $ionicLoading) {
    $scope.loading = $ionicLoading.show();

    $('iframe').on('load', function () {
      $ionicLoading.hide();
      $('iframe').contents().find("#cuidadores_header").remove();
      $('iframe').contents().find("#block-cuidadores-footer").remove();
      $('iframe').contents().find("footer").remove();
      $('iframe').contents().find(".main-container").css("margin-top", "1em");
      $('iframe').contents().find(".page-header").css({
        "font-size": "220%",
        "text-align": "center",
        "font-weight": "bold",
        "margin-top": "0.5em "
      });
      $('iframe').contents().find(".content").css({
        "font-size": "115%",
        "text-align": "justify"
      });
    });
  })
