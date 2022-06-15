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
    private function addSelectData()
    {
        $this->addTable();
        $this->sqlGrammar->from(true);
        $this->addColumns();
        $this->sqlGrammar->select(true);
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
}
