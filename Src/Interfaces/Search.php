<?php
namespace Src\Interfaces;
interface Search {
  public function where(string $column,?string $operator, $value);
  public function whereIn(string $column,array $columns);
  public function orWhere(string $column,?string $operator,string $value);
  public function whereNotIn(string $column,array $columns);
}