<?php

class ContactsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker\Factory::create();

        for($i=1;$i<=20;$i++)
        {
            $c = Contact::create([
                'name' => $faker->name,
                'number' => $faker->phoneNumber
            ]);

            for($j=1;$j<=50;$j++)
            {
                Message::create([
                   'contact_id' => $c->id,
                   'content'    => $faker->sentence(rand(1,30)),
                   'is_read'    => true,
                   'is_inbound' => rand(0,1)
                ]);
            }
        }
    }

}