<?php

namespace Framework\Database\Pdo;

use PDOStatement as PDOState;
use Framework\Database\StatementInterface;

class PdoStatement implements StatementInterface
{
    /**
     * @var PDOState $statement
     */
    private $statement;

    public function __construct(PDOState $statement)
    {
        $this->statement = $statement;
    }


    /**
     * @param $parameter
     * @param $value
     * @param $data_type
     * @return void
     */
    public function bindValue($parameter, $value, $data_type)
    {
        $this->statement->bindValue($parameter, $value, $data_type);
    }

    /**
     * @param null $input_parameters
     * @return void
     */
    public function execute($input_parameters = null)
    {
        $this->statement->execute($input_parameters);
    }

    /**
     * @return array|boolean|null
     */
    public function fetch()
    {
        if ($this->statement) {
            return $this->statement->fetch();
        }
        return null;
    }

    /**
     * @return array|null
     */
    public function fetchAll()
    {
        if ($this->statement) {
            return $this->statement->fetchAll();
        }
        return null;
    }
}
