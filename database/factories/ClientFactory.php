<?php

namespace Database\Factories;

use Faker\Provider\pt_BR\PhoneNumber;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $cpf = rand(10000000,99999999999);

        $letters = $this->generateRandomString(3);
        $numbers = substr(uniqid('', true), -4);
        $numberPlate = $letters . $numbers;
        return [
            'name' => $this->faker->name(),
            'phone' => PhoneNumber::cellphoneNumber(false),
            'CPF' => $cpf,
            'license_plate' => $numberPlate,
        ];
    }

    private function generateRandomString($length = 10): string
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


}
