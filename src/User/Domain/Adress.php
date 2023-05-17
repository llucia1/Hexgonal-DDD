<?php
namespace Src\User\Domain;


final class Adress
{
    private ?Geo $geo = null;
    public function __construct( private string $street, private string $suite, private string $city, 
                                 private string $zipcode, array $geo
                                )
    {
        $this->street = new Stringvo($street);
        $this->suite = new Stringvo($suite);
        $this->city = new Stringvo($city);
        $this->zipcode = new Stringvo($zipcode);
        $this->geo = Geo::fromArray($geo);
    }
    
    public static function fromArray(array $datos): ?self
    {
        if(!empty($datos))
        {
            return new self($datos['street'], $datos['suite'], $datos['city'], $datos['zipcode'], $datos['geo']);
        }
        return null;
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
    
    public function geo(): ?Geo
    {
        return $this->geo;
    } 

    public function toArray(): array
    {
        return [
                    'street' => $this->street(),
                    'suite' => $this->suite(),
                    'city' => $this->city(),
                    'zipcode' => $this->zipcode(),
                    'geo' => ($this->geo !== null)? $this->geo->toArray() : null,
        ];
    }

    public function get(): self
    {
        return $this;
    }
}