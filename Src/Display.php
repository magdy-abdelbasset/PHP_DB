<?php
namespace Src;

use Src\Interfaces\Display as InterfacesDisplay;

class Display implements InterfacesDisplay{
    public function all(): array
    {
        return [];   
    }
    public function get(): array
    {
        return [];
    }
    public function first(): array
    {
        return [];
        
    }
    public function find(int $value): array
    {
        return [];   
    }

}