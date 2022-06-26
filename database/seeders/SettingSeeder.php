<?php

    namespace Database\Seeders;
    use App\Models\Setting;

    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\File;

    class SettingSeeder extends Seeder{

        public function run(){
            Setting::create([
                'key' => 'SITE_TITLE',
                'value' => 'Akash Associates',
                'type' => 'general',
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => 1
            ]);

            Setting::create([
                'key' => 'SITE_TITLE_SF',
                'value' => 'AA',
                'type' => 'general',
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => 1
            ]);

            Setting::create([
                'key' => 'CONTACT_NUMBER',
                'value' => '+91-9879578913',
                'type' => 'general',
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => 1
            ]);

            Setting::create([
                'key' => 'MAIN_CONTACT_NUMBER',
                'value' => '+91-9879578913',
                'type' => 'general',
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => 1
            ]);

            Setting::create([
                'key' => 'CONTACT_EMAIL',
                'value' => 'info@akashassociates.com',
                'type' => 'general',
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => 1
            ]);

            Setting::create([
                'key' => 'MAIN_CONTACT_EMAIL',
                'value' => 'info@akashassociates.com',
                'type' => 'general',
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => 1
            ]);

            Setting::create([
                'key' => 'CONTACT_ADDRESS',
                'value' => '<strong>Registered Address:-</strong> Plot No:22, Gulmohar Co.Op,So Ltd, Shimpoli Road,   Borivali(West), Mumbai-400092',
                'type' => 'general',
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => 1
            ]);

            Setting::create([
                'key' => 'MAIN_CONTACT_ADDRESS',
                'value' => '<strong>Branch/Courier Address:-</strong>  D-1402 Sun South Park, South Bopal,  Ahmedabad-38008',
                'type' => 'general',
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => 1
            ]);

            Setting::create([
                'key' => 'MAIL_DRIVER',
                'value' => 'smtp',
                'type' => 'smtp',
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => 1
            ]);

            Setting::create([
                'key' => 'MAIL_HOST',
                'value' => 'mail.akashassociates.com',
                'type' => 'smtp',
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => 1
            ]);

            Setting::create([
                'key' => 'MAIL_PORT',
                'value' => '465',
                'type' => 'smtp',
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => 1
            ]);

            Setting::create([
                'key' => 'MAIL_USERNAME',
                'value' => 'info@akashassociates.com',
                'type' => 'smtp',
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => 1
            ]);

            Setting::create([
                'key' => 'MAIL_PASSWORD',
                'value' => 'Akash@007',
                'type' => 'smtp',
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => 1
            ]);

            Setting::create([
                'key' => 'MAIL_ENCRYPTION',
                'value' => 'ssl',
                'type' => 'smtp',
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => 1
            ]);

            Setting::create([
                'key' => 'MAIL_FROM_ADDRESS',
                'value' => 'info@akashassociates.com',
                'type' => 'smtp',
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => 1
            ]);

            Setting::create([
                'key' => 'MAIL_FROM_NAME',
                'value' => 'Akash Associates',
                'type' => 'smtp',
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => 1
            ]);

            $logo = [
                'FEVICON' => 'fevicon.png',
                'LOGO' => 'logo.png',
                'SMALL_LOGO' => 'small_logo.png'
            ];
    
            foreach($logo as $key => $value){
                Setting::create([
                    'key' => $key,
                    'value' => $value,
                    'type' => 'logo',
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => 1,
                    'updated_at' => date('Y-m-d H:i:s'),
                    'updated_by' => 1
                ]);
            }
    
            $folder_to_upload = public_path().'/uploads/logo/';
    
            if (!\File::exists($folder_to_upload)) {
                \File::makeDirectory($folder_to_upload, 0777, true, true);
            }
    
            if(file_exists(public_path('admin/dummy/fevicon.png')) && !file_exists(public_path('/uploads/logo/fevicon.png')) ){
                File::copy(public_path('admin/dummy/fevicon.png'), public_path('/uploads/logo/fevicon.png'));
            }
    
            if(file_exists(public_path('admin/dummy/logo.png')) && !file_exists(public_path('/uploads/logo/logo.png')) ){
                File::copy(public_path('admin/dummy/logo.png'), public_path('/uploads/logo/logo.png'));
            }
    
            if(file_exists(public_path('admin/dummy/small_logo.png')) && !file_exists(public_path('/uploads/logo/small_logo.png')) ){
                File::copy(public_path('admin/dummy/small_logo.png'), public_path('/uploads/logo/small_logo.png'));
            }
        }
    }
