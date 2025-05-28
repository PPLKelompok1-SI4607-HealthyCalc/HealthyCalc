<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Activity;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Suplemen;
use App\Models\Community;
use App\Models\TabooFood;
use App\Models\FoodPlanning;
use App\Models\SuplemenHistory;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'name' => 'Aksanardian',
            'email' => 'aksa310@gmail.com',
            'username' => 'Aksa',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'Avicena',
            'email' => 'sena310@gmail.com',
            'username' => 'Sena',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'Aksa',
            'email' => 'user1@gmail.com',
            'username' => 'Aksa310',
            'password' => bcrypt('123456789'),
        ]);
        UserProfile::create([
            'user_id' => 1,
        ]);
        UserProfile::create([
            'user_id' => 2,
        ]);
        UserProfile::create([
            'user_id' => 3,
        ]);

        Community::create([
            'user_id' => 1,
            'category' => 'Diet',
            'title' => 'Diet Sehat',
            'description' => 'Diet sehat adalah diet yang seimbang dan bergizi.',
            'like' => 14,
        ]);
        Community::create([
            'user_id' => 1,
            'category' => 'Olahraga',
            'title' => 'Olahraga Sehat',
            'description' => 'Olahraga sehat adalah olahraga yang baik untuk kesehatan.',
            'like' => 13,
        ]);
        Community::create([
            'user_id' => 2,
            'category' => 'Kesehatan',
            'title' => 'Kesehatan Mental',
            'description' => 'Kesehatan mental adalah kesehatan yang baik untuk jiwa.',
            'like' => 10,
        ]);
        Community::create([
            'user_id' => 2,
            'category' => 'Umum',
            'title' => 'Umum',
            'description' => 'Umum adalah hal yang umum.',
            'like' => 9,
        ]);
        Community::create([
            'user_id' => 1,
            'category' => 'Diet',
            'title' => 'Diet Sehat',
            'description' => 'Diet sehat adalah diet yang seimbang dan bergizi.',
            'like' => 14,
        ]);
        Community::create([
            'user_id' => 1,
            'category' => 'Olahraga',
            'title' => 'Olahraga Sehat',
            'description' => 'Olahraga sehat adalah olahraga yang baik untuk kesehatan.',
            'like' => 13,
        ]);
        Community::create([
            'user_id' => 2,
            'category' => 'Kesehatan',
            'title' => 'Kesehatan Mental',
            'description' => 'Kesehatan mental adalah kesehatan yang baik untuk jiwa.',
            'like' => 10,
        ]);
        Community::create([
            'user_id' => 2,
            'category' => 'Umum',
            'title' => 'Umum',
            'description' => 'Umum adalah hal yang umum.',
            'like' => 9,
        ]);

        FoodPlanning::create([
            'user_id' => 1,
            'food_category' => 'Sarapan',
            'day' => 'Senin',
            'title' => 'Sarapan Sehat',
            'description' => 'Sarapan sehat adalah sarapan yang baik untuk kesehatan.',
            'planned_time' => '08:00:00',
        ]);
        FoodPlanning::create([
            'user_id' => 1,
            'food_category' => 'Makan Siang',
            'day' => 'Selasa',
            'title' => 'Makan Siang Sehat',
            'description' => 'Makan siang sehat adalah makan siang yang baik untuk kesehatan.',
            'planned_time' => '12:00:00',
        ]);
        FoodPlanning::create([
            'user_id' => 2,
            'food_category' => 'Makan Malam',
            'day' => 'Rabu',
            'title' => 'Makan Malam Sehat',
            'description' => 'Makan malam sehat adalah makan malam yang baik untuk kesehatan.',
            'planned_time' => '18:00:00',
        ]);
        FoodPlanning::create([
            'user_id' => 2,
            'food_category' => 'Sarapan',
            'day' => 'Kamis',
            'title' => 'Sarapan Sehat',
            'description' => 'Sarapan sehat adalah sarapan yang baik untuk kesehatan.',
            'planned_time' => '08:00:00',
        ]);
        TabooFood::create([
            'user_id' => 1,
            'taboo' => 'alergi',
            'food_name' => 'Kacang',
        ]);
        TabooFood::create([
            'user_id' => 1,
            'taboo' => 'kolesterol',
            'food_name' => 'Gorengan',
        ]);
        TabooFood::create([
            'user_id' => 2,
            'taboo' => 'diabetes',
            'food_name' => 'Gula',
        ]);
        TabooFood::create([
            'user_id' => 2,
            'taboo' => 'garam',
            'food_name' => 'Garam',
        ]);
        Suplemen::create([
            'user_id' => 1,
            'suplemen_name' => 'Vitamin C',
            'dosage' => 500,
            'frequency' => '1x sehari',
        ]);
        Suplemen::create([
            'user_id' => 1,
            'suplemen_name' => 'Vitamin D',
            'dosage' => 1000,
            'frequency' => '2x sehari',
        ]);
        Suplemen::create([
            'user_id' => 2,
            'suplemen_name' => 'Vitamin E',
            'dosage' => 400,
            'frequency' => '3x sehari',
        ]);
        Suplemen::create([
            'user_id' => 2,
            'suplemen_name' => 'Vitamin A',
            'dosage' => 900,
            'frequency' => '1x sehari',
        ]);
        SuplemenHistory::create([
            'suplemen_id' => 1,
            'time' => Carbon::now()->subDays(2)->setTime(14, 30),
            'status' => 'sudah',
        ]);
        SuplemenHistory::create([
            'suplemen_id' => 2,
            'time' => Carbon::now()->subDays(3)->setTime(9, 0),
            'status' => 'sudah',
        ]);
        SuplemenHistory::create([
            'suplemen_id' => 3,
            'time' => Carbon::now()->subDay()->setTime(12, 30),
            'status' => 'sudah',
        ]);
        Activity::create([
            'user_id' => 1,
            'activity_name' => 'Jogging',
            'duration_minutes' => 30,
            'intensity_level' => 'Sedang',
            'calories_burned' => 200,
            'activity_date' => Carbon::now()->subDays(2),
        ]);
        Activity::create([
            'user_id' => 1,
            'activity_name' => 'Berenang',
            'duration_minutes' => 45,
            'intensity_level' => 'Tinggi',
            'calories_burned' => 400,
            'activity_date' => Carbon::now()->subDays(3),
        ]);
        Activity::create([
            'user_id' => 2,
            'activity_name' => 'Bersepeda',
            'duration_minutes' => 60,
            'intensity_level' => 'Sedang',
            'calories_burned' => 300,
            'activity_date' => Carbon::now()->subDay(),
        ]);
        Activity::create([
            'user_id' => 2,
            'activity_name' => 'Angkat Beban',
            'duration_minutes' => 30,
            'intensity_level' => 'Tinggi',
            'calories_burned' => 250,
            'activity_date' => Carbon::now()->subDays(4),
        ]);
        
        
    }
}
