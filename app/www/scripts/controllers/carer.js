angular.module('starter.controllers.carer', [])

  .controller('carerCtrl', function ($scope, $ionicLoading) {
    $scope.loading = $ionicLoading.show();

    $('iframe').on('load', function() {
      $ionicLoading.hide();
      $('iframe').contents().find("header").remove();
      $('iframe').contents().find("div .col-md-8").remove();
      $('iframe').contents().find(".footer").remove();
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
