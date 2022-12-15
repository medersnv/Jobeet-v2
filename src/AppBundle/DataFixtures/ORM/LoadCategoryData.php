<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use AppBundle\Entity\Category;

class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $design = new Category();
        $design->setName('Design3');

        $programming = new Category();
        $programming->setName('Programming3');

//        $manager = new Category();
//        $manager->setName('Manager');
//
//        $administrator = new Category();
//        $administrator->setName('Administrator');
//
//        $web = new Category();
//        $web->setName('Web Designer');

        $em->persist($design);
        $em->persist($programming);
//        $em->persist($manager);
//        $em->persist($administrator);
//        $em->persist($web);

        $em->flush();

        $this->addReference('category-design', $design);
        $this->addReference('category-programming', $programming);
//        $this->addReference('category-manager', $manager);
//        $this->addReference('category-administrator', $administrator);
//        $this->addReference('category-web-designer', $web);
    }

    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}