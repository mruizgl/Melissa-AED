<?php

namespace App\Http\Infrastructure;

use App\Http\Domain\Models\IUserRepository;
use App\Http\Domain\Models\User as EloquentUser;

class UserRepository implements IUserRepository
{
    public function all() {
        return EloquentUser::all();
    }

    public function create(array  $data) {
        return EloquentUser::create($data);
    }

    public function update(array $data, $id) {
        $user = EloquentUser::find($id);
        $user->update($data);
        return $user;
    }

    public function delete($id) {
        return EloquentUser::destroy($id);
    }

    public function find($id) {
        return EloquentUser::find($id);
    }
}