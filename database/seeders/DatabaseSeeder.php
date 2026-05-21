<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\DoctorSchedule;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin Klinik',
            'email' => 'admin@antrisehat.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'phone' => '081200000001',
        ]);

        $patient = User::create([
            'name' => 'Pasien Demo',
            'email' => 'pasien@antrisehat.com',
            'password' => Hash::make('pasien123'),
            'role' => 'pasien',
            'phone' => '081200000002',
            'birth_date' => '2000-01-15',
            'gender' => 'Laki-laki',
        ]);

        $otherPatient = User::create([
            'name' => 'Siti Rahma',
            'email' => 'siti@example.com',
            'password' => Hash::make('pasien123'),
            'role' => 'pasien',
            'phone' => '081200000003',
            'birth_date' => '1998-05-20',
            'gender' => 'Perempuan',
        ]);

        $doctors = collect([
            ['name' => 'dr. Andi Pratama', 'specialization' => 'Dokter Umum', 'str_number' => 'STR-001', 'phone' => '081300000001', 'consultation_fee' => 75000],
            ['name' => 'dr. Budi Santoso, Sp.PD', 'specialization' => 'Penyakit Dalam', 'str_number' => 'STR-002', 'phone' => '081300000002', 'consultation_fee' => 150000],
            ['name' => 'dr. Citra Lestari, Sp.A', 'specialization' => 'Anak', 'str_number' => 'STR-003', 'phone' => '081300000003', 'consultation_fee' => 140000],
            ['name' => 'dr. Dewi Anggraini, Sp.OG', 'specialization' => 'Kandungan', 'str_number' => 'STR-004', 'phone' => '081300000004', 'consultation_fee' => 175000],
            ['name' => 'dr. Eko Wijaya, Sp.THT', 'specialization' => 'THT', 'str_number' => 'STR-005', 'phone' => '081300000005', 'consultation_fee' => 130000],
        ])->map(fn (array $doctor) => Doctor::create($doctor + ['is_active' => true]));

        $schedules = collect([
            [$doctors[0]->id, 'Senin', '08:00', '11:00', 10],
            [$doctors[0]->id, 'Rabu', '13:00', '16:00', 8],
            [$doctors[1]->id, 'Selasa', '09:00', '12:00', 6],
            [$doctors[1]->id, 'Kamis', '14:00', '17:00', 6],
            [$doctors[2]->id, 'Senin', '10:00', '13:00', 7],
            [$doctors[2]->id, 'Jumat', '08:00', '11:00', 7],
            [$doctors[3]->id, 'Rabu', '09:00', '12:00', 5],
            [$doctors[4]->id, 'Sabtu', '08:00', '10:00', 5],
        ])->map(fn (array $schedule) => DoctorSchedule::create([
            'doctor_id' => $schedule[0],
            'day' => $schedule[1],
            'start_time' => $schedule[2],
            'end_time' => $schedule[3],
            'quota' => $schedule[4],
        ]));

        Appointment::create([
            'patient_id' => $patient->id,
            'doctor_schedule_id' => $schedules[0]->id,
            'appointment_date' => now()->addDays(2)->toDateString(),
            'status' => 'pending',
            'complaint' => 'Demam dan pusing sejak kemarin.',
            'queue_number' => 1,
        ]);

        Appointment::create([
            'patient_id' => $patient->id,
            'doctor_schedule_id' => $schedules[2]->id,
            'appointment_date' => now()->addDays(3)->toDateString(),
            'status' => 'confirmed',
            'complaint' => 'Kontrol tekanan darah.',
            'queue_number' => 1,
        ]);

        Appointment::create([
            'patient_id' => $otherPatient->id,
            'doctor_schedule_id' => $schedules[4]->id,
            'appointment_date' => now()->addDays(4)->toDateString(),
            'status' => 'completed',
            'complaint' => 'Batuk pilek anak.',
            'queue_number' => 1,
        ]);
    }
}
