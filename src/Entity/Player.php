<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=PlayerRepository::class)
 * @UniqueEntity(fields={"email"}, message="Уже существует игрок с такой почтой")
 */
class Player implements UserInterface
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=180, unique=true)
	 */
	private $email;

	/**
	 * @ORM\Column(type="json")
	 */
	private $roles = [];

	/**
	 * @var string The hashed password
	 * @ORM\Column(type="string")
	 */
	private $password;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $sex;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $first_name;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $last_name;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $patronymic_name;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $avatar;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $nick_name;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $slogan;

	/**
	 * @ORM\Column(type="boolean")
	 */
	private $isVerified = false;

	public function getId(): ?int
	{
		return $this->id;
	}

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
		return (string)$this->email;
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

	public function getSex(): ?string
	{
		return $this->sex;
	}

	public function setSex(string $sex): self
	{
		$this->sex = $sex;

		return $this;
	}

	public function getFirstName(): ?string
	{
		return $this->first_name;
	}

	public function setFirstName(?string $first_name): self
	{
		$this->first_name = $first_name;

		return $this;
	}

	public function getLastName(): ?string
	{
		return $this->last_name;
	}

	public function setLastName(?string $last_name): self
	{
		$this->last_name = $last_name;

		return $this;
	}

	public function getPatronymicName(): ?string
	{
		return $this->patronymic_name;
	}

	public function setPatronymicName(?string $patronymic_name): self
	{
		$this->patronymic_name = $patronymic_name;

		return $this;
	}

	public function getAvatar(): ?string
	{
		return $this->avatar;
	}

	public function setAvatar(?string $avatar): self
	{
		$this->avatar = $avatar;

		return $this;
	}

	public function getNickName(): ?string
	{
		return $this->nick_name;
	}

	public function setNickName(string $nick_name): self
	{
		$this->nick_name = $nick_name;

		return $this;
	}

	public function getSlogan(): ?string
	{
		return $this->slogan;
	}

	public function setSlogan(?string $slogan): self
	{
		$this->slogan = $slogan;

		return $this;
	}

	public function getFullName(): string
	{
		return $this->last_name . " " . $this->first_name . " " . $this->patronymic_name;
	}

	public function isVerified(): bool
	{
		return $this->isVerified;
	}

	public function setIsVerified(bool $isVerified): self
	{
		$this->isVerified = $isVerified;

		return $this;
	}
}
