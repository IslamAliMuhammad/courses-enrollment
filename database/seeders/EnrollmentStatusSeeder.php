<?php

namespace Database\Seeders;

use App\Models\EnrollmentStatus;
use Illuminate\Database\Seeder;

class EnrollmentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $statuses = ['awaiting', 'accepted', 'rejected'];

        foreach($statuses as $status) {
            EnrollmentStatus::create([
                'name' => $status,
            ]);
        }
    }
}
