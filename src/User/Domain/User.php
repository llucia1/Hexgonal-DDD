<?php
namespace Src\User\Domain;

use Src\Shared\Domain\ValueObjets\EmailVo as Email;

final class User
{
    private ?Adress $address = null;
    private ?Company $company = null;
    public function __construct( private string $id, private string $name, private string $username, private string $email, 
                                 array $address, private string $phone, private string $website, ?array $company )
    {
        $this->id = new Id($id);
        $this->name = new Stringvo($name);
        $this->username = new Stringvo($username);
        $this->email = Email::create($email)->email();
        $this->address = Adress::fromArray($address) ;
        $this->phone = new Stringvo($phone);
        $this->website = new Stringvo($website);
        $this->company = Company::fromArray($company);
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function username(): string
    {
        return $this->username;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function phone(): string
    {
        return $this->phone;
    }

    public function website(): string
    {
        return $this->website;
    }
    
    public function company(): ?Company
    {
        return $this->company;
    }

    public function address(): ?Adress
    {
        return $this->address;
    } 

    public static function fromArray(array $datos): ?static
    {
        if(!empty($datos))
        {
            return new static($datos['id'], $datos['name'], $datos['username'], $datos['email'], [], $datos['phone'], $datos['website'], []);
        }
        return null;
    } 

    public function toArray(): array
    {
        
        return [
            'id' => $this->id(),
            'name' => $this->name(),
            'username' => $this->username(),
            'email' => $this->email(),
            'address' => ($this->address !== null)? $this->address->toArray() : null,
            'phone' => $this->phone(),
            'website' => $this->website(),
            'company' => ($this->company !== null)? $this->company->toArray() : null,
        ];
    }
}

