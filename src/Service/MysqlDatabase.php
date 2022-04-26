<?php

namespace Bardo\Ujvilagbackend\Service;

use Bardo\Ujvilagbackend\Service\Database;

use mysqli;

class MysqlDatabase implements Database
{

    private mysqli $_conn;

    function __construct($host, $username, $password, $database)
    {
        $this->_conn = new mysqli($host, $username, $password, $database);

        if ($this->_conn->connect_error) {
            error_log("Connection failed: " . $this->_conn->connect_error);
        }
    }

    function __destruct()
    {
        $this->_conn->close();
    }

    public function existsTable(string $table): bool
    {
        if ($result = $this->_conn->query("SHOW TABLES LIKE '" . $table . "'")) {
            if ($result->num_rows == 1) {
                return True;
            } else {
            }
        }
        return False;
    }

    public function execute(string $sql): bool
    {
        return $this->_conn->query($sql);
    }

    public function query(string $sql): array
    {
        $result = $this->_conn->query($sql);
        $return = [];
        if (!$result) {
            error_log("nem sikerült a lekérdezés:" . $sql);
        }
        while ($row = $result->fetch_assoc()) {
            $return[] = $row;
        }
        return $return;
    }
}
