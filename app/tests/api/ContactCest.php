<?php
use \ApiGuy;

/**
 * @guy ApiGuy\ApiSteps
 */
class ContactCest
{
    public function _before(ApiGuy $I)
    {
        $I->haveHttpHeader('X-Requested-With','XMLHttpRequest');
    }

    public function _after(ApiGuy $I)
    {
        $I->seeResponseIsJson();
    }

    // tests
    public function createContact(ApiGuy $I)
    {
        $I->wantTo('create a contact via the API');

        $I->createContact('bob');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContains('bob');
    }

    public function deleteAnAppUser(ApiGuy $I)
    {
        $I->wantTo('Delete a contact via the API');
        $I->createContact();
        $id = $I->grabDataFromJsonResponse('id');
        $I->sendDELETE("contacts/$id");
        $I->seeResponseCodeIs(204);
    }

    public function updateContact(ApiGuy $I)
    {
        $I->wantTo('Update a contact via the API');
        $I->createContact();
        $id = $I->grabDataFromJsonResponse('id');

        $I->sendPOST("contacts/$id", [
            'name' => 'Mary Smith 2000'
        ]);

        $I->seeResponseCodeIs(204);
        $I->seeInDatabase('contacts', ['id' => $id, 'name' => 'Mary Smith 2000']);
    }

    public function showContact(ApiGuy $I)
    {
        $I->wantTo('Show a contact via the API');
        $I->createContact('bob');
        $id = $I->grabDataFromJsonResponse('id');
        $I->sendGET("contacts/$id");
        $I->seeResponseCodeIs(200);
        $I->seeResponseContains('bob');
    }

    public function listAppUsers(ApiGuy $I)
    {
        $I->wantTo('list contacts via the API');

        $I->createContact('testusername1');
        $I->createContact('testusername2');

        $I->sendGET("contacts");
        $I->seeResponseCodeIs(200);

        $I->seeResponseContains('testusername1');
        $I->seeResponseContains('testusername2');
    }

}