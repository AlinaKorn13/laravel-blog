<?php

namespace App\Services;

use HubSpot\Client\Crm\Contacts\Model\Filter;
use HubSpot\Client\Crm\Contacts\Model\SimplePublicObjectInput;
use HubSpot\Discovery\Discovery;

class HubspotNewsletter implements Newsletter
{
    public function __construct(protected Discovery $client)
    {
        //
    }

    public function subscribe(string $email, string $list = null)
    {
        $contactInput = new SimplePublicObjectInput();
        $contactInput->setProperties([
            'email' => $email
        ]);

        return $this->client->crm()->contacts()->basicApi()->create($contactInput);
    }

    public function unsubscribe(string $email, string $list = null)
    {
        $contactsPage = $this->client->crm()->contacts()->searchApi()->doSearch($this->filterAndSearchEmail($email))->getResults();
        $contactId = $contactsPage[0]->getId();

        $this->client->crm()->contacts()->basicApi()->archive($contactId);
    }

    private function filterAndSearchEmail(string $email)
    {
        $filter = new Filter();
        $filter
            ->setOperator('EQ')
            ->setPropertyName('email')
            ->setValue($email);

        $filterGroup = new \HubSpot\Client\Crm\Contacts\Model\FilterGroup();
        $filterGroup->setFilters([$filter]);

        $searchRequest = new \HubSpot\Client\Crm\Contacts\Model\PublicObjectSearchRequest();
        return $searchRequest->setFilterGroups([$filterGroup]);
    }
}
