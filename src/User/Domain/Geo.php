<?php
namespace Src\User\Domain;


final class Geo
{
    public function __construct( private string $lat, private string $lng
                                )
    {
    }
    
    public static function fromArray(?array $datos): ?self
    {
        if(!empty($datos))
        {
            return new self($datos['lat'], $datos['lng']);
        }
        return null;
    } 
    
    public function lat(): string
    {
        return $this->lat;
    }
    
    public function lng(): string
    {
        return $this->lng;
    }
    
    public function geo(): self
    {
        return $this;
    } 

    public function toArray(): array
    {
        return [
                    'lat' => $this->lat(),
                    'lng' => $this->lng(),
        ];
    }
}