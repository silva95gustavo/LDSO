angular.module('starter.controllers.home', ['ngSanitize'])

  .controller('homeCtrl', function ($scope, HOST, IMAGES, requests) {
    var ctrl = this;

    ctrl.text = {};

    requests.getHomeImage()
      .success(function (response){
        $('.parallax').css('background', 'url('+ HOST.domain + IMAGES.url + 'home.png' + ')', 'no-repeat', 'top', 'center');
        $('.parallax').css('background-size', '100%');
      })

    requests.getHomeText()
      .success(function (response) {
        ctrl.text = response.body[0].value;
        localforage.setItem('homeText', response.body[0].value);
      })
      .error(function (response) {
        localforage.getItem('homeText').then(function(value){
          ctrl.text = value;
        })
      });
  })
