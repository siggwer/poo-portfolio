<?php

namespace Framework\Database\Pdo;

use DateTime;
use PDO;
use Framework\Database\DatabaseInterface;
use Framework\Database\StatementInterface;

/**
 * Class PdoDatabase
 * Wrapper de
 *
 * @package Romss\Database
 */
class PdoDatabase extends PDO implements DatabaseInterface
{
    const TYPE_FIELD = [
        'integer' => parent::PARAM_INT,
        'boolean' => parent::PARAM_BOOL,
    ];

    /**
     * PdoDatabase constructor.
     *
     * @param string $dsn
     * @param string $username
     * @param string $passwd
     * @param array $options
     */
    public function __construct(string $dsn, string $username = '', string $passwd = '', array $options = [])
    {
        parent::__construct($dsn, $username, $passwd, $options);
        parent::setAttribute(parent::ATTR_DEFAULT_FETCH_MODE, parent::FETCH_ASSOC);
        parent::setAttribute(parent::ATTR_ERRMODE, parent::ERRMODE_EXCEPTION);
        parent::setAttribute(parent::ATTR_EMULATE_PREPARES, false);
    }

    /**
     * représente la requête à faire avec les données
     * dynamique nécessaire à la requête
     *
     * @param string $statement La requête à faire
     * @param array $params Les données dynamique
     * @return StatementInterface
     */
    public function request(string $statement, array $params = []): StatementInterface
    {
        $statement = new PdoStatement($this->prepare($statement));

        foreach ($params as $name => $param) {
            $paramType = gettype($param);
            $bindType = parent::PARAM_STR;

            if ($param instanceof DateTime) {
                $param = $param->format('Y-m-d H:i:s');
            } elseif (array_key_exists($paramType, self::TYPE_FIELD)) {
                $bindType = self::TYPE_FIELD[$paramType];
            } elseif ($param === null) {
                $bindType = parent::PARAM_NULL;
            }

            $statement->bindValue($name, $param, $bindType);
        }

        $statement->execute();
        return $statement;
    }

    /**
     * Retourne le dernier id inséré
     *
     * @return int
     */
    public function lastId(): int
    {
        return parent::lastInsertId();
    }
}
