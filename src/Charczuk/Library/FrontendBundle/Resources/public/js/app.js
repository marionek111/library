'use strict';

// Declare app level module which depends on filters, and services
var app = angular.module('myApp', ['myApp.controllers','myApp.directives']);
app.config(function($interpolateProvider){
    $interpolateProvider.startSymbol('[[').endSymbol(']]'); //repear conflict with Symfony2 twing
});
