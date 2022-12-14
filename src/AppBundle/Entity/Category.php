<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Utils\Jobeet;

/**
 * Category
 *
 * @ORM\Entity()
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Category
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Job", mappedBy="category")
     */
    private $jobs;

    /**
     * @ORM\ManyToMany(targetEntity="Affiliate", mappedBy="categories")
     */
    private $affiliates;

    private $activeJobs;

    private $moreJobs;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $slug;

    public function __toString()
    {
        return $this->getName() ? $this->getName() : "";
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->jobs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->affiliates = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add job
     *
     * @param \AppBundle\Entity\Job $job
     *
     * @return Category
     */
    public function addJob(\AppBundle\Entity\Job $job)
    {
        $this->jobs[] = $job;

        return $this;
    }

    /**
     * Remove job
     *
     * @param \AppBundle\Entity\Job $job
     */
    public function removeJob(\AppBundle\Entity\Job $job)
    {
        $this->jobs->removeElement($job);
    }

    /**
     * Get jobs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getJobs()
    {
        return $this->jobs;
    }

    /**
     * Add affiliate
     *
     * @param \AppBundle\Entity\Affiliate $affiliate
     *
     * @return Category
     */
    public function addAffiliate(\AppBundle\Entity\Affiliate $affiliate)
    {
        $this->affiliates[] = $affiliate;

        return $this;
    }

    /**
     * Remove affiliate
     *
     * @param \AppBundle\Entity\Affiliate $affiliate
     */
    public function removeAffiliate(\AppBundle\Entity\Affiliate $affiliate)
    {
        $this->affiliates->removeElement($affiliate);
    }

    /**
     * Get affiliates
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAffiliates()
    {
        return $this->affiliates;
    }

    public function setActiveJobs($jobs)
    {
        $this->activeJobs = $jobs;
    }
    public function getActiveJobs()
    {
        return $this->activeJobs;
    }

    public function getSlug()
    {
        return Jobeet::slugify($this->getName());
    }

    public function setMoreJobs($jobs)
    {
        $this->moreJobs = $jobs >=  0 ? $jobs : 0;
    }

    public function getMoreJobs()
    {
        return $this->moreJobs;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Category
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function setSlugValue()
    {
        $this->slug = Jobeet::slugify($this->getName());
    }

}
