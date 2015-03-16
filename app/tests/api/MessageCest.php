<?php
use \ApiGuy;

/**
 * @guy ApiGuy\ApiSteps
 */
class MessageCest
{

    public function _before(ApiGuy $I)
    {
        $I->haveHttpHeader('X-Requested-With','XMLHttpRequest');

        if(!property_exists($this,'contact_id'))
        {
            $I->createContact();
            $this->contact_id = $I->grabDataFromJsonResponse('id');
        }

    }

    public function _after(ApiGuy $I)
    {
        $I->seeResponseIsJson();
    }


    public function testCreate(ApiGuy $I)
    {
        $I->wantTo('create a new message via the API');

        $I->createMessage($this->contact_id);

        $I->seeResponseCodeIs(200);
        $I->seeResponseContains('contact_id');
    }


    public function testList(ApiGuy $I)
    {
        $I->wantTo('list all messages via the API');

        for($j=1;$j<=5;$j++)
        {
            $I->createMessage($this->contact_id,"Test message $j");
        }

        $I->sendGET("messages?contact_id={$this->contact_id}");

        $I->seeResponseCodeIs(200);
        $I->seeResponseContains('Test message 1');
        $I->seeResponseContains('Test message 2');
        $I->seeResponseContains('Test message 3');
        $I->seeResponseContains('Test message 4');
        $I->seeResponseContains('Test message 5');
    }

}