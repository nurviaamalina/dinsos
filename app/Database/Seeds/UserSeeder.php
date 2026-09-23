<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'username'   => 'superadmin',
                'email'      => 'superadmin@dinsos.go.id',
                'password'   => password_hash('password123', PASSWORD_DEFAULT),
                'role'       => 'superadmin',
                'active'     => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username'   => 'admin',
                'email'      => 'admin@dinsos.go.id',
                'password'   => password_hash('admin123', PASSWORD_DEFAULT),
                'role'       => 'admin',
                'active'     => 1,
                'created_at' => '2025-09-16 09:45:00',
                'updated_at' => '2025-09-16 09:45:00',
            ],
            
        ];

        foreach ($users as $user) {
            $existing = $this->db->table('users')
                ->where('username', $user['username'])
                ->get()
                ->getRowArray();

            if (! $existing) {
                $this->db->table('users')->insert($user);
            }
        }
    }
}