<?php
namespace Src\Interfaces;
interface Display {
  public function get():array;
  public function all():array;
  public function first():array;
  public function find(int $value):array;
}
