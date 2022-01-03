<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Program;
use App\Entity\Show;
use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Faker;
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // use the factory to create a Faker\Generator instance
        $faker = Faker\Factory::create();
        echo $faker->name();
        echo $faker->email();
        echo $faker->text();


        // create 20 categories! Bam!
        for ($i = 1; $i <= 5; $i++) {
            $category = new Category();
            $category->setName('category '.$i);
            $category->setDescription($faker->text());
            $manager->persist($category);
        }
        // create 20 programs Bam!
        for ($i = 1; $i <= 20; $i++) {
            $program = new Program();
            $program->setName('program '.$i);
            $program->setDescription($faker->text());
            $program->setHostedBy($faker->name());
            $program->getCategories($category(rand(1,5)));
            $manager->persist($program);
        }
        // create 20 users! Bam!
        for ($i =1; $i <= 60; $i++) {
            $user = new Users();
            $user->setName($faker->name());
            $user->setSurname($faker->name());
            $user->setEmail($faker->email());
            $user->setPassword($faker->password());
            $user->getPrograms($program(rand(1,20)));
            $manager->persist($user);
        }
        // create 20 Showss Bam!
        for ($i = 1; $i <= 100; $i++) {
            $show = new Show();
            $show->setName('show '.$i);
            $show->setDescription($faker->text());
            $show->setHostedBy($faker->name());
            $show->setGuest($faker->name());
            $show->setDateStart($faker->dateTime());
            $show->setDateEnd($faker->dateTime());
            $show->setDateCreated($faker->dateTime());
            $show->getProgramId($program(rand(1,20)));
            $manager->persist($show);
        }

        $manager->flush();
    }
}
