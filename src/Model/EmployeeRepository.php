<?php

namespace Bardo\Ujvilagbackend\Model;

use Bardo\Ujvilagbackend\Service\Database;
use Bardo\Ujvilagbackend\Model\Product;
use DateTime;

class EmployeeRepository
{

    private Database $_db;

    function __construct(Database $db)
    {
        $this->_db = $db;
    }

    public function getEmployees(): array
    {
        $return = [];
        $sql = "select id, name from employees";

        $results = $this->_db->query($sql);

        foreach ($results as $e) {
            $employee = new Employee($e['id'], $e['name']);
            $return[] = $employee;
        }
        return $return;
    }
}
