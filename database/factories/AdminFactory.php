<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => "テスト管理",
            'email' => "admin@admin.com",
            'email_verified_at' => date("Y-m-d H:i:s"),
            'password' => bcrypt('admin@admin.com'),
        ];
    }
}
