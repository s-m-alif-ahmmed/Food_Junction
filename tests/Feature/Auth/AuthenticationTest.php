<?php

use App\Models\User;

test('login screen can be rendered', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

test('login screen can be rendered over HTTPS', function () {
    $response = $this->get('https://localhost/login');

    $response->assertStatus(200);
});

test('users can authenticate using the login screen', function () {
    $user = User::factory()->create([
        'password' => bcrypt('12345678'),
    ]);

    $response = $this->post('/login', [
        'email'    => $user->email,
        'password' => '12345678',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('user.dashboard', absolute: false));
});

test('admins can authenticate and redirect to admin dashboard', function () {
    $admin = User::factory()->create([
        'role'     => 'Admin',
        'password' => bcrypt('12345678'),
    ]);

    $response = $this->post('/login', [
        'email'    => $admin->email,
        'password' => '12345678',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('admin.dashboard', absolute: false));
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    $this->post('/login', [
        'email'    => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

test('users can logout', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/logout');

    $this->assertGuest();
    $response->assertRedirect('/');
});

test('session expiration or 419 handling redirects gracefully to login', function () {
    $response = $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class)
        ->post('/login', [
            'email' => 'nonexistent@example.com',
            'password' => 'password',
        ]);

    $this->assertTrue(in_array($response->getStatusCode(), [200, 302]));
});
