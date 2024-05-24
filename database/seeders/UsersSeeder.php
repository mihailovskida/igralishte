<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'      => 'admin',
            'avatar'    => 'https://s3-alpha-sig.figma.com/img/b81b/c100/f688287cd44df9ea1024cce102237216?Expires=1711929600&Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&Signature=Ire5OdHgLHS4wjh-ySrsH0BWfvOmbwK2M4r7x1ODvXKoJWLVHCam-RGvG1bix652hAYbjm-QaRrN5ryA39ULJy6X1wmw5WyNmaAjXpjR9HqvpHTmHiuytPSfZHhsCEN01audrVRmTdwdodVfdWVhxqMjHftpkB3HJ4S5reMZgnrVjx3vGrCyAc5KWxFUkuccDXVhQ693q-OWcxtN056OETA4k9eS9ic58FI2z33scr5FKty5VJoje6rvPN-mJD4b72qJsSK~WJgNk52cJ4nGM~XYxXxBGLLqGxT8BxgPGFO574Dt7ufGNDk9n8Y-F5sVXL1m9kjNuDboBQdXJ-CXGQ__',
            'surname'   => 'admin',
            'email'     => 'admin@admin.com',
            'password'  => Hash::make('admin1234'),
            'phone'     => 123456,
            'is_admin'  => 1,
        ]);
    }
}
