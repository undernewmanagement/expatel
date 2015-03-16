<?php
namespace ApiGuy;

use Faker;

class ApiSteps extends \ApiGuy
{

    public function __construct(\Codeception\Scenario $scenario)
    {
        parent::__construct($scenario);
        $this->faker = $faker = Faker\Factory::create();
    }

    public function createContact($name=null,$number=null)
    {
        $name = is_null($name) ? $this->faker->name : $name;
        $number = is_null($number) ? $this->faker->phoneNumber : $number;

        $this->sendPOST('contacts', [
            'name' => $name,
            'number' => $number
        ]);
    }

    public function createMessage($contact_id,$content=null)
    {
        $content = is_null($content) ? $this->faker->sentence(20) : $content;

        $this->sendPOST("messages", [
            'contact_id' => $contact_id,
            'content' => $content
        ]);
    }

}