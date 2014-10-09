'use strict';

/* Directives */


var app = angular.module('myApp.directives', []);

// TODO: usunąć jak nie porrzebne
app.directive('myDirective', function() {
    return {
        restrict: 'E/A',
        templateUrl: "my-directive.html",
        controller: function(){

        },
        controllerAs: "myDirect"
    }
});
