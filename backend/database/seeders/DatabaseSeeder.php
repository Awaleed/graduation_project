<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Diagnosis;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Radiolest;
use App\Models\XRayImage;
use App\Models\XRayRequest;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // delete all records from Radiolest, Doctor, Patient, Diagnosis, XRayRequest, XRayImage

        Schema::disableForeignKeyConstraints();
        XRayImage::withoutEvents(function () {
            XRayImage::truncate();
        });
        XRayRequest::withoutEvents(function () {
            XRayRequest::truncate();
        });
        Diagnosis::withoutEvents(function () {
            Diagnosis::truncate();
        });
        Patient::withoutEvents(function () {
            Patient::truncate();
        });

        Radiolest::withoutEvents(function () {
            Radiolest::truncate();
        });

        Doctor::withoutEvents(function () {
            Doctor::truncate();
        });

        Schema::enableForeignKeyConstraints();

        //
        $faker = \Faker\Factory::create();
        $all = Storage::allFiles('public/xray_images');
        $filrer = [];

        foreach ($all as $key => $value) {
            // check if the file is an image
            if (strpos($value, '.jpg') || strpos($value, '.jpeg') || strpos($value, '.png')) {
                $filrer[] = $value;
            }
        }

        $radiolest = Radiolest::create($this->makeUser());

        for ($i = 0; $i < 10; $i++) {
            $doctor =  Doctor::create($this->makeUser());
            for ($a = 0; $a < 5; $a++) {
                $patient = Patient::create([
                    'name' => $faker->name,
                    'phone' => $faker->phoneNumber,
                    'email' => $faker->email,
                    'birth_date' => $faker->date,
                    'gender' => $faker->randomElement(['male', 'female'])
                ]);
                for ($b = 0; $b < 10; $b++) {
                    $diagnons =  Diagnosis::create([
                        'patient_id' => $patient->id,
                        'doctor_id' => $doctor->id,
                        'body' => $faker->text,
                        'request_x_ray' => $faker->boolean,
                        'x_ray_request_body' => $faker->text,
                    ]);



                    $xra = XRayRequest::create([
                        'diagnosis_id' => $diagnons->id,
                        'radiolest_id' => $radiolest->id,
                        'body' => $faker->text,
                    ]);

                    for ($c = 0; $c < 3; $c++) {
                        $image = XRayImage::create([
                            'x_ray_request_id' => $xra->id,
                            'diagnosis_id' => $diagnons->id,
                            'result' => json_encode([
                                "Necrotic-Tumor" => $faker->randomFloat(2, 0, 1),
                                "Non-Tumor" => $faker->randomFloat(2, 0, 1),
                                "Viable" => $faker->randomFloat(2, 0, 1),
                                "prediction" => $faker->randomElement(["Necrotic-Tumor", "Non-Tumor", "Viable"]),
                            ]),
                        ]);
                        $imagePath = $faker->randomElement($filrer);
                        $image->addMediaFromUrl(url(Storage::url($imagePath)))->toMediaCollection();
                    }
                    // get random image from storage folder and attach it to the model
                }
            }
        }
    }


    private function makeUser()
    {

        $faker = \Faker\Factory::create();
        return [
            "name" => $faker->name,
            "email" => $faker->email,
            "password" => 'password',
            "room_number" => $faker->numberBetween(100, 900),
            "phone" => $faker->phoneNumber,
            "specialty" => $faker->word,
        ];
    }
}
