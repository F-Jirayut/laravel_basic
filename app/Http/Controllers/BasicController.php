<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // ใช้ model ในการ query
use App\Models\Department; // ใช้ model ในการ query
use App\Models\DepartmentUser; // ใช้ model ในการ query
use App\Models\WorkSession; // ใช้ model ในการ query
use Illuminate\Support\Facades\DB; // ใช้ query ปกติ
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

class BasicController extends Controller
{
    public function select(){
        // sql ปกติ หรือ raw sql
        // report, sql ที่มีความซับซ้อน
        $raw_sql =  DB::select('select * from departments limit 10');

        // qb query builder
        // ทั่วไป, ลดการเขียน sql
        // https://laravel.com/docs/10.x/queries
        $qb_sql = DB::table('departments')->get();

        // model query
        // ง่าย, สะดวกสะบาย (ถ้าใช้เป็น), ลดการเขียน sql, ลูกเล่นเยอะ
        // doc https://laravel.com/docs/10.x/eloquent
        $model_sql = Department::get();

        $departments = Department::query()->limit(10)->get();

        // DB::enableQueryLog();
        dd(
            $raw_sql,
            $qb_sql,
            $model_sql,
            $departments
        );
    }

    public function insert(){
        $hashedPassword = Hash::make('123456');

        // sql ปกติ หรือ raw sql
        // Generate hashed password
        // Prepare the INSERT statement
        $sql = "
            INSERT INTO users (username, password, fname, lname, created_at, updated_at)
            VALUES
                ('user1', '$hashedPassword', 'John', 'Doe', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
                ('user2', '$hashedPassword', 'Jane', 'Smith', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
                ('user3', '$hashedPassword', 'Michael', 'Johnson', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
                ('user4', '$hashedPassword', 'Emily', 'Brown', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
                ('user5', '$hashedPassword', 'William', 'Davis', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
        ";

        // Execute the raw SQL query
        $raw_sql = DB::statement($sql);

        // qb query builder
        $qb_sql = DB::table('users')->insert([
            [
                'username' => 'user6',
                'password' => $hashedPassword,
                'fname' => 'John',
                'lname' => 'Doe',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'user7',
                'password' => $hashedPassword,
                'fname' => 'John',
                'lname' => 'Doe',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // model query 1
        $model_sql_1 = User::insert([
            [
                'username' => 'user8',
                'password' => $hashedPassword,
                'fname' => 'John',
                'lname' => 'Doe',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'user9',
                'password' => $hashedPassword,
                'fname' => 'John',
                'lname' => 'Doe',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // model query 2
        $user = new User();
        $user->username = 'test123';
        $user->password = $hashedPassword;
        $user->fname = 'f_123';
        $user->lname = 'l_123';
        $user->save();

        // DB::enableQueryLog();
        dd(
            $raw_sql,
            $qb_sql,
            $model_sql_1,
            $user
        );
    }

    public function update(){
        // sql ปกติ หรือ raw sql
        $raw_sql = DB::statement("UPDATE users SET username = 'test_update_raw' where id = 1");

        // qb query builder
        $qb_sql = DB::table('users')->where('id', 2)->update(['username' => 'test_update_qb']);

        // model query 1
        $model_sql_1 = User::where('id', 3)->update(['username' => 'test_update_model_1']);

        // model query 2
        $user = User::find(4);
        $user->username = 'test_update_model_2';
        $user->save();

        dd(
            $raw_sql,
            $qb_sql,
            $model_sql_1,
            $user
        );

    }

    public function delete(){
    // Delete query using raw SQL
    $raw_sql = DB::statement("DELETE FROM users WHERE id = 1");

    // Delete query using Query Builder
    $qb_sql = DB::table('users')
        ->where('id', 2)
        ->delete();

    // Delete query using Model
    $model_sql_1 = User::where('id', 3)->delete();

    // Delete query using Model
    $user = User::find(4);
    $user->delete();

    dd(
        $raw_sql,
        $qb_sql,
        $model_sql_1,
        $user
    );
    }

    public function mockData()
    {
        DB::beginTransaction();
        // รันได้แค่ครั้งเดียวนะ
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

        $faker = Faker::create();

        for ($i = 0; $i < 100; $i++) {
            Department::create([
                'name' => $faker->unique()->word,
                'description' => $faker->sentence,
                'active' => $faker->boolean,
            ]);
        }

        $faker = Faker::create();
        $userIds = User::pluck('id')->toArray();

        for ($i = 0; $i < 100; $i++) {
            $startDateTime = $faker->dateTimeBetween('-1 year', 'now');
            $endDateTime = $faker->dateTimeBetween($startDateTime, 'now');

            WorkSession::create([
                'user_id' => $faker->randomElement($userIds),
                'start_time' => $startDateTime,
                'end_time' => $endDateTime,
            ]);
        }

        $faker = Faker::create();
        $userIds = User::pluck('id')->toArray();
        $departmentIds = Department::pluck('id')->toArray();

        for ($i = 0; $i < 100; $i++) {
            DepartmentUser::create([
                'user_id' => $faker->randomElement($userIds),
                'department_id' => $faker->randomElement($departmentIds),
            ]);
        }
    DB::commit();
    return "Mock data success.";
    }
}
