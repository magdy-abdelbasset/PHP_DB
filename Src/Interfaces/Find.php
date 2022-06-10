<?php
namespace Src\Interfaces;
interface Find {
  public function where(array $columns,?array $values);
  public function whereIn(array $columns);
  public function orWhere();
  public function whereNotIn(array $values);
}