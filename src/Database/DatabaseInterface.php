<?php

namespace Framework\Database;

/**
 * DatabaseInterface
 *
 * @package Database
 */
interface DatabaseInterface
{
    /**
     * représente la requête à faire avec les données
     * dynamique nécessaire à la requête
     *
     * @param string $statement La requête à faire
     * @param array $params Les données dynamique
     * @return StatementInterface
     */
    public function request(string $statement, array $params = []): StatementInterface;

    /**
     * Retourne le dernier id inséré
     *
     * @return int
     */
    public function lastId(): int;
}
