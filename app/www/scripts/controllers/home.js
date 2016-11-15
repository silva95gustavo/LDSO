angular.module('starter.controllers.home', ['ngSanitize'])

.controller('homeCtrl', function ($scope, requests) {
  var ctrl = this;

  requests.getHomeText().then(
    function(response){
      ctrl.present = {};
      ctrl.present.image = '../img/home.png';
      ctrl.present.text = response.data.body[0].value;
    }
  )
})
