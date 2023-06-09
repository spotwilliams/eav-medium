<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\CustomAttribute;
use App\Models\Person;
use App\Models\Value;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        CustomAttribute::create([
            'name' => 'Full name',
            'type' => 'string',
            'column_name' => 'string_value',
        ]);

        CustomAttribute::create([
            'name' => 'Birthdate',
            'type' => 'date',
            'column_name' => 'date_value',
        ]);

        CustomAttribute::create([
            'name' => 'Age',
            'type' => 'integer',
            'column_name' => 'integer_value',
        ]);

        CustomAttribute::create([
            'name' => 'Savings',
            'type' => 'money',
            'column_name' => 'money_value',
        ]);


        Person::factory(5000)->create();

        $attributes = CustomAttribute::all();
        /** @var Person $person */
        foreach (Person::query()->cursor() as $person) {
            $values = $attributes->map(function (CustomAttribute $attribute) {
                $input = match ($attribute->name) {
                    'Full name' => fake()->name(),
                    'Birthdate' => fake()->date(),
                    'Age' => rand(1, 80),
                    'Savings' => rand(1000, 2000),
                };
                $value = new Value([$attribute->column_name => $input]);

                $value->custom_attribute_id = $attribute->id;

                return $value;
            });
            $person->values()->saveMany($values);
        }
    }
}
