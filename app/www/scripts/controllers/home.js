angular.module('starter.controllers.home', ['ngSanitize'])

  .controller('homeCtrl', function ($scope) {
  })

uploadDoneHome = function () {
  //$('iframe').contents().find("header").html("");
  $('iframe').contents().find("header").remove();
  $('iframe').contents().find("div .col-md-8").remove();
}