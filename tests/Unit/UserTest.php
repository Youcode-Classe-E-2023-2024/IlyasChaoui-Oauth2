<?php
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testRegister()
    {
        $existingUser = User::where('email', 'test@example.com')->first();

        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'role_id' => '2',
        ];

        $response = $this->json('POST', '/api/auth/register', $userData);

        if ($response->status() === 201) {
            $this->assertTrue(true, 'User registered successfully');
        } else {
            $this->fail('User registration failed');
        }
    }
}
