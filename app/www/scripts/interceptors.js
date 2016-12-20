angular.module('interceptors', [])

.factory('myHttpInterceptor', function($q, $injector, $rootScope) {
      return {
        request: function(req) {
          console.log(req);
          return req;
        }
      }
    })
    .config(function($httpProvider) {
      $httpProvider.interceptors.push('myHttpInterceptor');
    })
