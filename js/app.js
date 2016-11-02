var myapp = angular.module('busara', ['ui.router','busara.controllers']);

myapp.config(function($stateProvider, $urlRouterProvider) {


    var mainState = {
      name: 'app',
      url: '/app',
      templateUrl: "templates/main.html",
      controller: 'AppCtrl'
    }

    $stateProvider.state(mainState);


  // if none of the above states are matched, use this as the fallback
  $urlRouterProvider.otherwise('/app');
});
