angular.module('starter.constants', [])
/*
.constant('API', {
  domain: 'http://localhost:8100/api',
  login: 'http://localhost:8100/api/login',
  images: 'http://localhost:8100/api/images/'
})*/

.constant('API', (function() {
  var domain = 'http://cuidadores.tk/';
  return {
    login: domain + 'user/login/',
    logout: domain + 'user/logout/',
    images: 'http://localhost:8100/api/images/',
    carer: domain + 'pt-pt/node/35/',
    community: domain + 'comunidade/',
    contacts: domain + 'pt-pt/node/33/',
    domain: domain,
    restricted: domain + 'pt-pt/area-restrita/',
    services: domain + 'pt-pt/node/34/'
  }
})())
