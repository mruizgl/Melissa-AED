<?php

namespace App\Http\Controllers;

use App\Http\Domain\Models\IUserService;

class UserController extends Controller
{
    //private IUserService $userService;

    public function __construct(private IUserService $userService ) {
        $this->userService = $userService;
    }

    public function index()
    {
        //$servicio = new UserService();
        $users= $this->userService->all();
        return response()->json($users);
    }
}
