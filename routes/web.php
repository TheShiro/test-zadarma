<?php

use sao\Route\Route;

Route::get("/", "BookController", "index");
Route::get("/view/{id}", "BookController", "view");

Route::get("/login", "AuthController", "index");
Route::get("/logout", "AuthController", "logout");

Route::get("/signup", "AuthController", "signup");

?>