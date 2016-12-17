angular.module('starter.controllers.community', [])

.controller('communityCtrl', function () {

    //Import of data from the forum
  })

uploadDoneCommunity = function () {
  console.log("done community");
  $('iframe').contents().find("#cuidadores_header").remove();
  $('iframe').contents().find("div .col-md-8").remove();
}
