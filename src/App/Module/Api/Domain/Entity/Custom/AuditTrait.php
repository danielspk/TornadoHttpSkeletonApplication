<?php
namespace App\Module\Api\Domain\Entity\Custom;

trait AuditTrait
{
    // -------------------------------------------------------------------------
    // Fields:
    // -------------------------------------------------------------------------
    
    /** @Column(type="datetime") */
    private $created;
    
    /** @Column(type="datetime") */
    private $updated;

    // -------------------------------------------------------------------------
    // Lifecycle callback:
    // -------------------------------------------------------------------------
    
    /**
     * @PrePersist
     */
    public function onPrePersist()
    {
        $this->created = new \DateTime('now');
        $this->updated = new \DateTime('now');
    }
    
    /**
     * @PreUpdate
     */
    public function onPreUpdate()
    {
        $this->updated = new \DateTime('now');
    }
    
    // -------------------------------------------------------------------------
    // Getters/Setters:
    // -------------------------------------------------------------------------
    
    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Object
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Object
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }
}
