<?php

use sao\Route\Route;

Route::get("/", "BookController", "index");

Route::get("/login", "AuthController", "index");

Route::get("/signup", "SignupController", "index");

?>