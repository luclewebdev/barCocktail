<?php

namespace App\DataFixtures;

use App\Entity\Cocktail;
use App\Repository\CocktailRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create();

        for($i=0;$i<10;$i++)
        {
             $cocktail = new Cocktail();
             $cocktail->setName($faker->name);
             $cocktail->setDescription($faker->name);

             $manager->persist($cocktail);

        }

        $manager->flush();
    }
}
