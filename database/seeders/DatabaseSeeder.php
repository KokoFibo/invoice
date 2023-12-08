<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\Customer::factory(20)->create();
        // \App\Models\Package::factory(5)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Anton',
            'email' => 'kokonacci@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Anton888'), // 123456789
            'remember_token' => Str::random(10),
        ]);


        // DB::table('packages')->insert(
        //     [
        //         'package' => 'Corporate Package 30-40',
        //         'price' => '9000000',
        //         'description' => 'Editorial monthly plan, 30 Instagram Feed, 8 Series Instagram Story (5 pg/ series), Digital campaign (optional), Copywriting, 30x Instagram Feed posting, 8x Instagram Story posting, Facebook & Instagram integration, Advertising placement from FB Ads Manager (not incl budget), Monthly content report, Monthly Ads report'
        //     ]
        // );
        // DB::table('packages')->insert(
        //     [
        //         'package' => 'UMKM 12 with Photography',
        //         'price' => '3500000',
        //         'description' => 'Editorial monthly plan, 12 Instagram Feed, 4 Series Instagram Story (3 pg/ series), Copywriting, 12x Instagram Feed posting, 4x Instagram Story posting, Max 3 Ads proposals with FB Ads Manager (Not incld budget or payment method) , Monthly content report, Monthly content report'
        //     ]
        // );

        // DB::table('contracts')->insert(
        //     [
        //         'customer_id' => '3',
        //         'contract_number' => 'Contract-003',
        //         'contract_begin' => '2023-03-01',
        //         'contract_end' => '2023-08-01',
        //     ]
        // );



    }
}
