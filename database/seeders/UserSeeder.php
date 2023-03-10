<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Hash;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('staff')->insert([
            'nama_petugas' => 'Staff',
            'email' => 'staff@gmail.com',
            'created_at' => \Carbon\Carbon::now()
        ]);
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            // 'status' => 'aktif',
            'created_at' => \Carbon\Carbon::now(),
            'email_verified_at' => \Carbon\Carbon::now()
        ]);
        DB::table('staff')->insert([
            'nama_petugas' => 'Admin',
            'email' => 'admin@gmail.com',
            'created_at' => \Carbon\Carbon::now()
        ]);
        DB::table('staff')->insert([
            'nama_petugas' => 'Staff',
            'email' => 'staff@gmail.com',
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('student')->insert([
            'nisn' => 12312312,
            'nis' => 1231231,
            'nama' =>'Student',
            'email' => 'student@gmail.com',
            'alamat' => 'Tanjung Alai',
            'no_telp' => '081234567892',
            'id_spp' => 1,
            'created_at' => \Carbon\Carbon::now()
        ]);
        DB::table('users')->insert([
            'name' => 'Student',
            'email' => 'student@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'student',
            'status' => 'aktif',
            'created_at' => \Carbon\Carbon::now(),
            'email_verified_at' => \Carbon\Carbon::now()
        ]);
        DB::table('users')->insert([
            'name' => 'Staff',
            'email' => 'staff@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'staff',
            'status' => 'aktif',
            'created_at' => \Carbon\Carbon::now(),
            'email_verified_at' => \Carbon\Carbon::now()
        ]);
        
    }

}
