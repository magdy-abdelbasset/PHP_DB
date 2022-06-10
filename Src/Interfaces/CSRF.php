<?php
namespace Src\Interfaces;
interface CSRF {
  public function insert(array $columns,?array $values);
  public function select(array $columns);
  public function delete();
  public function update(array $values);
}
