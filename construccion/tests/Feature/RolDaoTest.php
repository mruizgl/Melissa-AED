<?php

namespace Tests\Feature;

use App\DAO\RolDAO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

use function PHPUnit\Framework\assertTrue;

class RolDaoTest extends TestCase
{
    public $databaseCreated = false;
    public function setUp(): void
    {
        parent::setUp();
        if (! $this->databaseCreated) {
            $pdo = DB::getPdo();
            require 'CreateDatabase.php';
            $this->databaseCreated = true;
        }
    }
    public function test_1_findAll(): void
    {
        $pdo = DB::getPdo();
        $rolesDao = new RolDAO($pdo);
        $roles = $rolesDao->findAll();
        assertTrue(count($roles) == 2);
    }
}
