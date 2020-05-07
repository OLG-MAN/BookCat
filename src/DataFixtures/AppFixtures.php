<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Cocur\Slugify\Slugify;
use App\Entity\Book;
use App\Entity\Author;  


class AppFixtures extends Fixture
{
    private $faker;

    private $slug;

    public function __construct()
    {
        $this->faker = Factory::create();
        $this->slug = Slugify::create();
    }

    public function load(ObjectManager $manager)
    {
        $this->loadBooks($manager);
        $this->loadAuthors($manager);
    }

    public function loadBooks(ObjectManager $manager)
    {
        for ($i = 1; $i < 20; $i++) {
            $post = new Book();
            $post->setAuthorId($this->faker->unique->numberBetween(1, 20));
            $post->setTitle($this->faker->text(12));
            $post->setDescription($this->faker->text(20));
            $post->setSlug($this->slug->slugify($post->getTitle()));
            $post->setCreatedAt($this->faker->dateTime);

            $manager->persist($post);
        }
        $manager->flush();
    }

    public function loadAuthors(ObjectManager $manager)
    {
        for ($i = 1; $i < 20; $i++) {
            $post = new Author();
            $post->setFirstName($this->faker->unique()->text(12));
            $post->setSecondName($this->faker->unique()->text(12));
            $post->setSlug($this->slug->slugify($post->getSecondName()));

            $manager->persist($post);
        }
        $manager->flush();
    }
}
