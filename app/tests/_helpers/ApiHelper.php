<?php
namespace Codeception\Module;

// here you can define custom functions for ApiGuy 

class ApiHelper extends \Codeception\Module
{
    public function truncate($table)
    {
        $dbh = $this->getModule('Db')->dbh;
        $dbh->exec("TRUNCATE $table CASCADE");
    }
}
