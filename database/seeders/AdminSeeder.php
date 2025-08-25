<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $student = [
          'name'=>'Test',
          'email'=>'test@gmail.com',
          'password'=>'test1234'
        ];
        Admin::create($student);
    }
}
