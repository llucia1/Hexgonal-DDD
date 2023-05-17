<?php
namespace Src\User\Domain;


final class Company
{
    public function __construct( private string $bs, private string $catchPhrase, private string $name )
    {
        $this->bs = new Stringvo($bs);
        $this->catchPhrase = new Stringvo($catchPhrase);
        $this->name = new Stringvo($name);
    }
    
    public static function fromArray(?array $datos): ?self
    {
        if(!empty($datos))
        {
            return new self($datos['bs'], $datos['catchPhrase'], $datos['name']);
        }
        return null;
    } 
    
    public function bs(): string
    {
        return $this->bs;
    }
    
    public function catchPhrase(): string
    {
        return $this->catchPhrase;
    }     
    
    public function name(): string
    {
        return $this->name;
    }

    public function toArray(): array
    {
        return [
                    'bs' => $this->bs(),
                    'catchPhrase' => $this->catchPhrase(),
                    'name' => $this->name(),
        ];
    }

    public function get(): self
    {
        return $this;
    }
}