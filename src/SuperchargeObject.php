<?php

namespace Supercharge\Client;

class SuperchargeObject
{
    public function __construct()
    {
    }

    /**
     * @return string The name of the class, with namespacing and underscores
     *    stripped.
     */
    public static function className()
    {
        $class = get_called_class();
        // Useful for namespaces: Foo\Charge
        if ($postfixNamespaces = strrchr($class, '\\')) {
            $class = substr($postfixNamespaces, 1);
        }
        // Useful for underscored 'namespaces': Foo_Charge
        if ($postfixFakeNamespaces = strrchr($class, '')) {
            $class = $postfixFakeNamespaces;
        }

        return strtolower($class);
    }

    public static function classUrl()
    {
        $base = static::className();

        return "${base}s";
    }

    public static function retrieve($code)
    {
        return self::_retrieve($code);
    }

    public static function all()
    {
        return self::_all();
    }

    protected static function _retrieve($id)
    {
        $client = new Client(Supercharge::getUsername(), Supercharge::getPassword(), Supercharge::getApiBase());
        $resp = $client->request('get', self::classUrl().'/'.$id);
        $obj = new static();

        return $obj->loadFromArray($resp);
    }

    protected static function _all()
    {
        $client = new Client(Supercharge::getUsername(), Supercharge::getPassword(), Supercharge::getApiBase());
        $resp = $client->request('get', self::classUrl());
        $ret = [];
        foreach ($resp as $item) {
            $obj = new static();
            $ret[] = $obj->loadFromArray($item);
        }

        return $ret;
    }

    protected static function _create($params)
    {
        $client = new Client(Supercharge::getUsername(), Supercharge::getPassword(), Supercharge::getApiBase());
        $resp = $client->request('post', self::classUrl(), $params);
        if (isset($resp['id'])) {
            $obj = new static();

            return $obj->loadFromArray($params)->setId($resp['id']);
        }
        throw new \Exception('No id was given but http code was correct');
    }

    protected static function _update($id, $params)
    {
        $client = new Client(Supercharge::getUsername(), Supercharge::getPassword(), Supercharge::getApiBase());
        $resp = $client->request('put', self::classUrl().'/'.$id, $params);
    }

    public function toArray()
    {
        $fields = get_object_vars($this);

        $result = array();
        foreach ($fields as $key => $value) {
            $propertyName = $this->underscoredTocamelCase($key);
            $getter = sprintf('get%s', ucfirst($propertyName));
            $result[$key] = $this->$getter($value);
        }

        return $result;
    }

    protected function loadFromArray($data, $allowed_keys = null)
    {
        if (is_null($allowed_keys)) {
            $allowed_keys = array_keys((array)$data);
        }

        foreach ($data as $key => $value) {
            if (!in_array($key, $allowed_keys)) {
                continue;
            }

            $propertyName = $this->underscoredTocamelCase($key);
            $setter = sprintf('set%s', ucfirst($propertyName));
            $this->$setter($value);
        }

        return $this;
    }

    protected function camelCaseToUnderscored($name)
    {
        return strtolower(preg_replace('/([A-Z])/', '_$1', lcfirst($name)));
    }

    protected function underscoredTocamelCase($string, $capitalizeFirstCharacter = false)
    {
        $str = str_replace(' ', '', ucwords(preg_replace('/\_/', ' ', $string)));

        if (!$capitalizeFirstCharacter) {
            $str[0] = strtolower($str[0]);
        }

        return $str;
    }

    /**
     * Magic getter
     *
     * @param  mixed $name
     * @return mixed
     */
    public function __get($propertyName)
    {
        $propertyName = $this->camelCaseToUnderscored($propertyName);

        if (!property_exists($this, $propertyName)) {
            throw new \Exception(
                sprintf(
                    'Entity %s does not have a property named %s',
                    get_class($this),
                    $propertyName
                )
            );
        }

        $propertyName = $this->underscoredTocamelCase($propertyName);
        $getter = sprintf('get%s', ucfirst($propertyName));

        return $this->$getter();
    }

    /**
     * Magic getter
     *
     * @param  mixed $name
     * @return mixed
     */
    public function __set($propertyName, $propertyValue)
    {
        $propertyName = $this->camelCaseToUnderscored($propertyName);

        if (!property_exists($this, $propertyName)) {
            throw new \Exception(
                sprintf(
                    'Entity %s does not have a property named %s',
                    get_class($this),
                    $propertyName
                )
            );
        }

        $propertyName = $this->underscoredTocamelCase($propertyName);
        $setter = sprintf('set%s', ucfirst($propertyName));

        return $this->$setter($propertyValue);
    }

    /**
     * Magic getters/setters
     *
     * @param  mixed $name
     * @param  mixed $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        if (property_exists($this, $name)) {
            // if (empty($arguments)) {
            return $this->$name;
            // } else {
            //     $this->$name = $arguments[0];
            //     return $this;
            // }
        }

        if (!preg_match('/^(get|set)(.+)$/', $name, $matchesArray)) {
            throw new \Exception(
                sprintf(
                    'Method "%s" does not exist on entity "%s"',
                    $name,
                    get_class($this)
                )
            );
        }

        // CamelCase to underscored
        $propertyName = $this->camelCaseToUnderscored($matchesArray[2]);

        if (!property_exists($this, $propertyName)) {
            throw new \Exception(
                sprintf(
                    'Entity %s does not have a property named %s',
                    get_class($this),
                    $propertyName
                )
            );
        }

        switch ($matchesArray[1]) {
            case 'set':
                $this->$propertyName = $arguments[0];

                return $this;

            case 'get':
                return $this->$propertyName;
        }
    }
}