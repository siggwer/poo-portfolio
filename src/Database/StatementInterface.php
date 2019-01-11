<?php

namespace Framework\Database;

/**
 * Interface IDatabase
 *
 * @package Database
 */
interface StatementInterface
{
    /**
     * @param $parameter
     * @param $value
     * @param $data_type
     * @return void
     */
    public function bindValue($parameter, $value, $data_type);

    /**
     * @param null $input_parameters
     * @return void
     */
    public function execute($input_parameters = null);

    /**
     * @return array|boolean|null
     */
    public function fetch();

    /**
     * @return array|null
     */
    public function fetchAll();
}
