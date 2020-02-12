<?php

namespace App;

use App\Database\Util;
use App\Database\Driver;

class Database
{
    protected $driver;

    public function __construct(Driver $driver = null)
    {
        $this->driver = $driver;
    }

    public function setDriver(Driver $driver)
    {
        $this->driver = $driver;
        return $this;
    }

    public function connect($host, $user, $pass, $database, $port = null)
    {
        return $this->driver->connect($host, $user, $pass, $database, $port);
    }

    public function disconnect()
    {
        return $this->driver->disconnect();
    }

    public function query($query, array $bindings = array())
    {
        return $this->driver->query($query, $bindings);
    }

    public function getAffectedRows()
    {
        return $this->driver->getAffectedRows();
    }
    
    public function insert($table, array $data)
    {
        $preparedQuery = Util::prepareInsertQuery($table, array_keys($data), $data);
        return $this->query($preparedQuery['query'], $preparedQuery['bindings']);
    }

    public function insertBatch($table, array $data, array $options = array())
    {
        $appliedOptions = array_merge(array('dataChunkSize' => 100), $options);
        $countRows = count($data);
        for ($i = 0; $i < $countRows; $i += $appliedOptions['dataChunkSize'])
        {
            $dataChunk = array_slice($data, $i, $appliedOptions['dataChunkSize']);
            $preparedQuery = Util::prepareInsertBatchQuery($table, array_keys($data[0]), $dataChunk);
            $this->query($preparedQuery['query'], $preparedQuery['bindings']);
        }
    }
}
