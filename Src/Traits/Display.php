<?php
namespace Src\Traits;
// use Src\Interfaces\Display as InterfacesDisplay;
trait Display {
    
    public function all(): array
    {
        return $this->run();
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