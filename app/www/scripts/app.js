// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
// 'starter.controllers' is found in controllers.js

angular.module('starter', ['ionic', 'starter.services', 'starter.controllers', 'starter.constants', 'interceptors'])

  .run(function ($ionicPlatform) {
    $ionicPlatform.ready(function () {
      // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
      // for form inputs)
      if (window.cordova && window.cordova.plugins.Keyboard) {
        cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
        cordova.plugins.Keyboard.disableScroll(true);

      }
      if (window.StatusBar) {
        // org.apache.cordova.statusbar required
        StatusBar.styleDefault();
      }
    });
  })

  /*.config(function ($httpProvider) {
    $httpProvider.defaults.withCredentials = true;
  })*/


  .config(function ($stateProvider, $urlRouterProvider) {
    $stateProvider

      .state('menu', {
        url: '/menu',
        abstract: true,
        templateUrl: 'views/menu.html',
        controller: 'menuCtrl as menu'
      })

      .state('home', {
        parent: 'menu',
        url: '/home',
        views: {
          'menuContent': {
            templateUrl: 'views/home.html',
            controller: 'homeCtrl as home'
          }
        }
      })

      .state('carer', {
        parent: 'menu',
        url: '/carer',
        views: {
          'menuContent': {
            templateUrl: 'views/carer.html',
            controller: 'carerCtrl as carer'
          }
        }
      })

      .state('services', {
        parent: 'menu',
        url: '/services',
        views: {
          'menuContent': {
            templateUrl: 'views/services.html',
            controller: 'servicesCtrl as services'
          }
        }
      })

      .state('contacts', {
        parent: 'menu',
        url: '/contacts',
        cache: false,
        views: {
          'menuContent': {
            templateUrl: 'views/contacts.html',
            controller: 'contactsCtrl as contacts'
          }
        }
      })

      .state('restricted', {
        parent: 'menu',
        url: '/restricted',
        cache: false,
        views: {
          'menuContent': {
            templateUrl: 'views/restricted.html',
            controller: 'restrictedCtrl as restricted'
          }
        }
      })

      .state('community', {
        parent: 'menu',
        url: '/community',
        views: {
          'menuContent': {
            templateUrl: 'views/community.html',
            controller: 'communityCtrl as community'
          }
        }
      })

    // if none of the above states are matched, use this as the fallback
    $urlRouterProvider.otherwise('/menu/home');

})

.run(function($rootScope, $state, $ionicHistory) {
  $rootScope.$back = function() {
    $ionicHistory.goBack();
  };
})
