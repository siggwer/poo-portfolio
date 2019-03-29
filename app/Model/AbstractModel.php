<?php

namespace App\Model;

use DateTime;

abstract class AbstractModel
{
    /**
     * AbstractModel constructor.
     *
     * @param array $data
     */
    public function __construct($data = [])
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    /**
     * @param array $data
     */
    protected function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set'.ucfirst($key);

            if (is_callable([$this, $method])) {
                $this->$method($value);
            }
        }
    }

    //SETTERS

    //GETTERS

    /**
     * @param $value
     *
     * @return bool|DateTime
     */
    protected function setDateTime($value)
    {
        if (is_string($value)) {
            return DateTime::createFromFormat('Y-m-d H:i:s', $value);
        }
        return $value;
    }
}
