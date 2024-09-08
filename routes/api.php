<?php

use App\Http\Controllers\UsuariosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('usuarios', [UsuariosController::class, "index"]);

Route::get('usuarios/{cpf}', [UsuariosController::class, "findUser"]);

Route::post('usuarios', [UsuariosController::class, "store"]);