<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

trait TimestampsTrait
{
    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    protected $createdAt;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    protected $updatedAt;

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function updatedTimestamps()
    {
        $this->setUpdatedAt(new \DateTimeImmutable('now'));

        if ($this->getCreatedAt() == null) {
            $this->setCreatedAt(new \DateTimeImmutable('now'));
        }
    }
}
