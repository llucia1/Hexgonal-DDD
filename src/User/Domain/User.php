<?php
namespace Src\User\Domain;

use Src\Shared\Domain\ValueObjets\EmailVo as Email;

final class User
{
    public function __construct( private string $id, private string $name, private string $username, private string $email, 
                                 private array $address, private string $phone, private string $website, private array $company
                                )
    {
        $this->id = new Id($id);
        $this->name = new Stringvo($name);
        $this->username = new Stringvo($username);
        $this->email = Email::create($email)->email();
        $this->address = $address;// Objeto Entity Agregado
        $this->phone = new Stringvo($phone);
        $this->website = new Stringvo($website);
        $this->company = $company;// Objeto Entity Agregado
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

    public function address(): array
    {
        return $this->address;
    }

    public function company(): array
    {
        return $this->company;
    }

    public static function create(array $datos): ?static
    {
        if(!empty($datos))
        {
            return new static($datos['id'], $datos['name'], $datos['username'], $datos['email'], $datos['address'], $datos['phone'], $datos['website'], $datos['company']);
        }
        return null;
    } 

    public function toArray(): array
    {
        
        return [
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'address' => $this->address,
            'phone' => $this->phone,
            'website' => $this->website,
            'company' => $this->company,
        ];
    }
}

