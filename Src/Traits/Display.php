<?php

namespace Src\Traits;

use Exception;

// use Src\Interfaces\Display as InterfacesDisplay;
trait Display
{

    public function all(): array
    {
        $this->addSelectData();
        return $this->run();
    }

    public function get(): array
    {
        $this->addSelectData();
        return $this->run();
    }
    public function first(): array
    {
        $this->addSelectData();
        return $this->run()[0];
    }
    public function find($value, $noGet = false, bool $error_more_one = true)
    {
        $this->where($this->primaryKey, $value);
        if ($noGet) {
            $data = $this->run();
            if (count($data) > 1 && $error_more_one) {
                throw new Exception("NOT PRIMARY KEY >>>> the data result more then one row");
            }

            return $data[0];
        }
        return $this;
    }
    public function count($values = null, $Get = true)
    {
        return $this->calcDataQuery('COUNT(', $values, $Get);
    }
    public function avg($values = null, $Get = true)
    {
        return $this->calcDataQuery('AVG(', $values, $Get);
    }
    public function sum($values = null, $Get = true)
    {
        return $this->calcDataQuery('SUM(', $values, $Get);
    }
    public function min($values = null, $Get = true)
    {
        return $this->calcDataQuery('MIN(', $values, $Get);
    }
    public function max($values = null, $Get = true)
    {
        return $this->calcDataQuery('MAX(', $values, $Get);
    }
    private function calcDataQuery($before, $values, $Get)
    {
        // if ($this->columns) {
            // $this->sqlGrammar->appendStrArray($this->columns, $before, ')', $values);
        // } els
        if (!$this->selectColumns) {
            $this->selectColumns = [];
        }
           array_push($this->selectColumns,...$values); 
            $this->sqlGrammar->appendStrArray($this->selectColumns, $before, ')', $values);

        if ($Get) {
            $this->addSelectData('');
            return $this->run();
        }
        return $this;
    }
    private function addSelectData($between = '`')
    {
        $this->addTable();
        $this->sqlGrammar->from(true);
        $this->addColumns($between);
        $this->sqlGrammar->select(true);
    }
}
