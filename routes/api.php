<?php

use sao\Route\Route;

Route::post("/book/create", "BookController", "create");
Route::put("/book/update", "BookController", "update");
Route::delete("/book/delete/{id}", "BookController", "delete");

Route::post("/validate/user", "ValidateController", "user");
Route::post("/validate/book", "ValidateController", "book");

?>