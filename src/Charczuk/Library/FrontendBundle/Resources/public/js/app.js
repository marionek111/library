'use strict';

// Declare app level module which depends on filters, and services
var app = angular.module('myApp', []);
app.config(function($interpolateProvider){
    $interpolateProvider.startSymbol('[[').endSymbol(']]');
});

//var arrBook = [{
//    id: 1,
//    name: "Dynamo",
//    author: "Dynamo",
//    yearRelease: 2012,
//    publisher: "WSIP",
//    description: "Nauka Magii i sztuczek magicznych",
//    isRemoved: false,
//    isEdited: false
//}, {
//    id: 2,
//    name: "Java EE",
//    author: "Jendrock Evans",
//    yearRelease: 2005,
//    publisher: "Helion",
//    description: "Podstawy programowania obiektowego w języku JAVA EE",
//    isRemoved: false,
//    isEdited: false
//}, {
//    id: 3,
//    name: "Cyfrowa Twierdza",
//    author: "Dan Brown",
//    yearRelease: 1997,
//    publisher: "Pióro",
//    description: "Opowiesć o superkomputerze który potrafi złamać karzdy szyfr który natrafił na ściane nie do przebicia",
//    isRemoved: false,
//    isEdited: false
//}];

app.controller('LibraryController', ['$http',function($http) {
    var library = this;
    library.books = [];
    this.booksBackup = {};

    $http.get('/api/books').success(function(data, status){
        library.books = data;
    });

    this.addBook = function(book){
        book.id = 0;
        this.books.push(book);
    }

    this.removeBook = function(book) {
        if(confirm("Are you shure to remove book?")) {
            book.isRemoved = true;
        }
    }

    this.editBookStart = function(book) {
        this.booksBackup[book.id] = JSON.stringify(book);
        book.isEdited = true;
    }

    this.editBookSubmit = function(book) {
        this.booksBackup[book.id] = null;
        book.isEdited = false;
    }

    this.editBookCancel = function(book) {
        var bookTmp = JSON.parse(this.booksBackup[book.id]);
        this.booksBackup[book.id] = null;
        book.name = bookTmp.name;
        book.author = bookTmp.author;
        book.yearRelease = bookTmp.yearRelease;
        book.publisher = bookTmp.publisher;
        book.description = bookTmp.description;
        book.isEdited = false;
    }
}]);

app.controller('BookController', function() {
    this.book = {};

    this.addBook = function(library) {
        library.books.addBook(this.book);
        this.book = {};
    }
})

app.controller('BookEditController', function(book) {
    this.bookBackup = book;
    this.book = book;

    this.editBook = function() {
        this.book.isEdited = false;
    }

    this.cancel = function() {
        this.book = this.bookBackup;
        this.book.isEdited = false;
    }
});

//app.controller('BookEditController', function() {
//    function ClickToEditCtrl($scope) {
//        $scope.title = "Welcome to this demo!";
//        $scope.editorEnabled = false;
//
//        $scope.enableEditor = function() {
//            $scope.editorEnabled = true;
//            $scope.editableTitle = $scope.title;
//        };
//
//        $scope.disableEditor = function() {
//            $scope.editorEnabled = false;
//        };
//
//        $scope.save = function() {
//            $scope.title = $scope.editableTitle;
//            $scope.disableEditor();
//        };
//    }
//
//});
