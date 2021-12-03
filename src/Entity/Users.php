<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class Users implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     *  @Assert\NotBlank
     * @Assert\Length(
     *        min = 4,
     *        max = 30,
     *       minMessage = "Your email must be at least {{ limit }} characters long",
     *       maxMessage = "Your email cannot be longer than {{ limit }} characters"
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     * @Assert\NotBlank
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;
    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\NotEqualTo("00000000")
     */
    private $nomuser;

    /**
     * @ORM\Column(type="integer", length=8)
     * @Assert\NotEqualTo("00000000")
     * @Assert\NotBlank
     */
    private $cinuser;
    /**
     * @ORM\Column(type="integer", length=2)
     *  * @Assert\GreaterThanOrEqual(
     *     value = 18
     * )
     * @Assert\NotBlank
     */
    private $ageuser;



    /**
     * @ORM\Column(type="integer", length=8)
     * @Assert\NotBlank
     */
    private $numtel;


    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\NotBlank
     */
    private $sexe;
    /**
     * @ORM\Column(type="string", length=3)
     * @Assert\NotBlank
     */
    private $abonnement;

    public function getId(): ?int
    {
        return $this->id;
    }
    protected $captchaCode;


    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
    public function getNomUser(): ?string
    {
        return $this->nomuser;
    }

    public function setNomUser(string $nomuser): self
    {
        $this->nomuser = $nomuser;

        return $this;
    }

    public function getCinUser(): ?int
    {
        return $this->cinuser;
    }

    public function setCinUser(int $cinuser): self
    {
        $this->cinuser = $cinuser;

        return $this;
    }


    public function getAgeUser(): ?int
    {
        return $this->ageuser;
    }

    public function setAgeUser(int $ageuser): self
    {
        $this->ageuser = $ageuser;

        return $this;
    }

    public function getNumTel(): ?int
    {
        return $this->numtel;
    }

    public function setNumTel(int $numtel): self
    {
        $this->numtel = $numtel;

        return $this;
    }



    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getAbonnement()
    {
        return $this->abonnement;
    }


    public function setAbonnement($abonnement): self
    {
        $this->abonnement = $abonnement;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCaptchaCode()
    {
        return $this->captchaCode;
    }

    /**
     * @param mixed $captchaCode
     */
    public function setCaptchaCode($captchaCode): void
    {
        $this->captchaCode = $captchaCode;
    }


}
