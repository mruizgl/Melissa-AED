<?php

use App\Http\Controllers\AuthApiController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthApiController::class, 'register']);
Route::post('/login', [AuthApiController::class, 'login']);
Route::get('/email/verify/{usuariorecibido}/{hash}', function (Request $request, User $usuariorecibido, $hash) {
    if ($usuariorecibido) {
        if (!hash_equals((string) $hash, sha1($usuariorecibido->getEmailForVerification()))) {
            return response()->json(['message' => 'El enlace de verificación no es válido'], 403);
        }
        if ($usuariorecibido->hasVerifiedEmail()) {
            return response()->json(['message' => 'El email ya está verificado']);
        }
        $usuariorecibido->markEmailAsVerified();
        return response()->json(['message' => 'Email verificado correctamente']);
    } else {
        return response()->json(['message' => 'El usuario no existe'], 404);
    }
})->middleware(['signed'])->name('api.verificarcorreo');
