'use strict';

/* Controllers */

var app = angular.module('myApp.controllers', []);

app.controller('LibraryController', ['$http','$scope',function($http, $scope) {
    var library = this;
    library.books = [];
    this.booksBackup = {};

    $http.get('/api/books').success(function(data, status){
        library.books = data;
    });

    this.addBook = function(book, form){
        $http.post('/api/addBook', {data: book}).success(function(data, status) {
            library.books.push(data);
            form.$setPristine()

//            $scope.addForm.$setPristine();
//            $scope.addForm.$setPristine();
//            $scope.addForm.$setPristine();

//            $('form[name=addForm] input, form[name=addForm] textarea').each(function(){
//                $(this).removeClass( "ng-dirty  ng-invalid ng-invalid-required" );
//                $(this).addClass("ng-pristine ng-valid");
//            });
        });
    }

    this.removeBook = function(book) {
        if(confirm("Are you shure to remove book?")) {
            $http.post('/api/removeBook/'+book.id).success(function(data, status) {
                book.isRemoved = true;
            });
        }
    }

    this.editBookStart = function(book) {
        this.booksBackup[book.id] = JSON.stringify(book);
        book.isEdited = true;
    }

    this.editBookSubmit = function(book) {
        $http.post('/api/editBook/'+book.id, {data: book}).success(function(data, status) {
            library.booksBackup[book.id] = null;
            book.isEdited = false;
        });
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

    this.addBook = function(library, form) {
        library.addBook(this.book, form);
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