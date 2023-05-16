<?php
namespace Src\User\Domain;


final class Adress
{
    public function __construct( private string $street, private string $suite, private string $city, 
                                 private string $zipcode, private array $geo
                                )
    {
    }
    
    public static function create(array $datos)
    {
        if(!empty($datos))
        {
            return new self($datos['street'], $datos['suite'], $datos['city'], $datos['zipcode'], $datos['geo']);
        }
    } 
    
    public function street(): string
    {
        return $this->street;
    }
    
    public function suite(): string
    {
        return $this->suite;
    }     
    
    public function city(): string
    {
        return $this->city;
    }     
    
    public function zipcode(): string
    {
        return $this->zipcode;
    } 
    
    public function geo(): array
    {
        return $this->geo;
    } 

    public function get(): self
    {
        return $this;
    }
}