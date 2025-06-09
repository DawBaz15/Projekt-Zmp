<?php

namespace Tests\Builders;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AccountBuilder {
    protected array $overrides = [];

    public function withEmail(string $email): self {
        $this->overrides['Email'] = $email;
        return $this;
    }
    public function withPassword(string $password): self {
        $this->overrides['Password'] = Hash::make($password);
        return $this;
    }
    public function withGoogle2fa(string $google2fa): self {
        $this->overrides['Google2fa'] = $google2fa;
        return $this;
    }
    public function withToken(string $token): self {
        $this->overrides['_token'] = $token;
        return $this;
    }
    public function createUser(): User {
        return User::factory()->state($this->overrides)->create();
    }

    public function makeUser(): User {
        return User::factory()->state($this->overrides)->make();
    }
    public function createAdmin(): Admin {
        return Admin::factory()->state($this->overrides)->create();
    }

    public function makeAdmin(): Admin {
        return Admin::factory()->state($this->overrides)->make();
    }
}
