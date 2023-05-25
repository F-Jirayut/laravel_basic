<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function generateMockUsers()
    {
        $faker = Faker::create();

        $password = Hash::make(123456);

        for ($i = 0; $i < 100; $i++) {
            User::create([
                'username' => $faker->unique()->userName,
                'password' => $password,
                'fname' => $faker->firstName,
                'lname' => $faker->lastName,
            ]);
        }

        return "Mock data generated successfully for users table.";
    }
}
