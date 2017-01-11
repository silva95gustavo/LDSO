angular.module('starter.controllers.home', ['ngSanitize'])

  .controller('homeCtrl', function ($scope, $ionicLoading, $sce, API) {
    var ctrl = this;
    ctrl.domain = $sce.trustAsResourceUrl(API.domain);
    $scope.loading = $ionicLoading.show();

    $('iframe').on('load', function() {
      $ionicLoading.hide();
      $('iframe').contents().find("#cuidadores_header").remove();
     // $('iframe').contents().find("aside").remove();
      $('iframe').contents().find("#block-cuidadores-footer").remove();
      $('iframe').contents().find(".external_links").remove();
      $('iframe').contents().find(".main-container").css("margin-top", "1em");
      $('iframe').contents().find(".region").css({"padding": "0px"});
      $('iframe').contents().find(".page-header").css({
        "font-size": "220%",
        "text-align": "center",
        "font-weight": "bold",
        "margin-top": "0.5em "
    });
    });
  })
