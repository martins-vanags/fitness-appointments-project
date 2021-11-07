<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::find(2);
        $user->appointments()->attach(Appointment::create([
            'name' => 'Rīta joga, Rīgas centrā',
            'latitude' => '56.946285',
            'longitude' => '24.105078',
            'student_count' => 10,
            'start_time' => '2021-11-10 13:00:00',
            'end_time' => '2021-11-10 14:00:00',
            'certificate_needed' => 0,
            'price' => 0,
            'description' => 'Stunda svaigā gaisā ar treneri Jāni, ņemam līdz jogas matraci un labu garstāvokli'
        ]));
    }
}
