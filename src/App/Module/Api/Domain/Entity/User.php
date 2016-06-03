<?php
namespace App\Module\Api\Domain\Entity;

use App\Module\Api\Domain\Entity\Custom\AuditTrait;

/**
 * @Entity(repositoryClass="App\Module\Api\Domain\Entity\UserRepository")
 * @Table(name="users", uniqueConstraints={
       @UniqueConstraint(name="user_unique", columns={"email"})
    })
 * @HasLifecycleCallbacks
 *
 */
class User
{
    // -------------------------------------------------------------------------
    // Traits:
    // -------------------------------------------------------------------------
    use AuditTrait;
    
    // -------------------------------------------------------------------------
    // Fields:
    // -------------------------------------------------------------------------
    
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /** @Column(type="string", length=64) */
    private $email;
    
    /** @Column(type="string", length=60) */
    private $password;
    
    // -------------------------------------------------------------------------
    // Methods generated automatically:
    // -------------------------------------------------------------------------

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT, ["cost" => 12]);

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
}
