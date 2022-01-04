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
        $faker = Faker\Factory::create('fr_FR');
        echo $faker->name();
        echo $faker->email();
        echo $faker->text();


        // Création de 3 fausses catégories
        for($i = 1 ; $i < 4 ; $i++)
        {
            $category = new Category();
            $category->setName('category '.$i);
            $category->setDescription($faker->text());

            $manager->persist($category); 


            // Création des programs     
            for($j = 1; $j <= mt_rand(4,6); $j++) {
    
                $program = new Program();
                $content = '<p>' . join('</p><p>', $faker->paragraphs(5)) . '</p>';
                
                $program->setName('program '.$i);
                $program->setDescription($content);
                $program->setHostedBy($faker->name());
                $program->addCategory($category);
                
                $manager->persist($program);
            }

            // create 60 users! Bam!
            for ($l =1; $l <= mt_rand(4,10); $l++) {
                $user = new Users();

                $user->setName($faker->name());
                $user->setSurname($faker->name());
                $user->setEmail($faker->email());
                $user->setPassword($faker->password());
                $user->addProgram($program);

                $manager->persist($user);
            }
            // Creation des show
            for($k = 1 ; $k <= mt_rand(4,10) ; $k++) {
                $show = new Show(); 

                $content = '<p>' . join('</p><p>', $faker->paragraphs(2)) . '</p>';
                
                $date = new \DateTimeImmutable($faker->date('Y-m-d H:i:s'));

                $show->setName('show '.$i);
                $show->setDescription($content);
                $show->setHostedBy($faker->name());
                $show->setGuest($faker->name());
                $show->setDateStart($date);
                $show->setDateEnd($date);
                $show->setDateCreated($date);
                $show->setProgramId($program);

                $manager->persist($show); 

            }
        }
        $manager->flush();
    }
}