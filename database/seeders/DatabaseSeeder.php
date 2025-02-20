<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Teacher;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call([
            //GroupSeeder::class,
            //StudentSeeder::class,
            //TeacherSeeder::class,
        // ]);

        $groups = Group::all();
        $teachers = Teacher::all();

        foreach ($teachers as $teacher) {
            $teacher->groups()->attach($groups->random(rand(3, 6)));
        }
    }
}
