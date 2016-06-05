<?php

namespace app\repositories;

use Phalcon\DI;

class Repository
{
    protected $modelClass;

    /**
     * @var Pdo
     */
    protected $db;

    public function __construct()
    {
        $this->db = DI::getDefault()->get('db');
    }

    /**
     * Looks up the first model by a set of conditions.
     *
     * The conditions are combined with AND.
     *
     * For example, the following conditions
     *
     * [
     *     'email' => 'something@gmail.com',
     *     'is_active' => 1
     * ]
     *
     * are like a query with:
     *
     * WHERE email = 'something@gmail.com' AND is_active = 1
     *
     * @param array $conditions
     * @returns Phalcon\Mvc\Model | null
     */
    public function findFirstBy(array $conditions)
    {
        $params = $this->conditionsToQueryParams($conditions);
        return call_user_func($this->modelClass . '::findFirst', $params);
    }

    public function findBy(array $conditions)
    {
        $params = $this->conditionsToQueryParams($conditions);
        return call_user_func($this->modelClass . '::find', $params);
    }

    /**
     * Transforms a set of conditions into query parameters.
     *
     * For example, the following
     *
     * [
     *     'email' => 'something@gmail.com',
     *     'is_active' => 1
     * ]
     *
     * is transformed into:
     *
     * [
     *     'email = :value0: AND is_active = :value1:',
     *     'bind' => [
     *         'value0' => 'something@gmail.com',
     *         'value1' => 1
     *     ]
     * ]
     *
     * @returns array
     */
    private function conditionsToQueryParams(array $conditions)
    {
        $clauses = [];
        $bindings = [];
        $idx = 0;

        foreach ($conditions as $field => $value) {
            $binding = 'value' . $idx;
            $clauses[] = $field . ' = :' . $binding . ':';
            $bindings[$binding] = $value;

            $idx++;
        }

        $params = [ implode(' AND ', $clauses), 'bind' => $bindings ];

        return $params;
    }
}
