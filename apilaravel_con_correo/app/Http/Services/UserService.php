<?php

namespace App\Http\Services;

use App\Http\Domain\Models\IUserRepository;
use App\Http\Domain\Models\IUserService;

class UserService implements IUserService
{


    public function __construct(private IUserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }
    
    public function all() {
        return $this->userRepository->all();
    }

    public function create(array  $data) {
        return $this->userRepository->create($data);
    }

    public function update(array $data, $id) {
        return $this->userRepository->update($data, $id);
    }

    public function delete($id) {
        return $this->userRepository->delete($id);
    }

    public function find($id) {
        return $this->userRepository->find($id);
    }
}