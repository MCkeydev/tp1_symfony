<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Profile;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class BlogFixtures extends Fixture
{
    /**
     * Fonction permettant de peupler la base de données à l'exécution de la commande:
     * "symfony console d:f:l"
     *
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        // Création d'une instance de faker en français
        $faker = Factory::create('fr_FR');

        // Initialisation d'un tableau de users
        $user = [];

        // Boucle permettant la création de 50 users
        for ($i = 0; $i < 50; $i++) {
            // Initialisation d'une date
            $dateU = \DateTimeImmutable::createFromMutable($faker->dateTime());

            // Création d'un user avec des données factices
            $user = (new User())
                ->setName($faker->name())
                ->setPassword(sha1("motdepasse"))
                ->setCreatedAt($dateU);

            // Ajout du user dans l'index
            $manager->persist($user);

            // Initialisation d'une date
            $dateA = \DateTimeImmutable::createFromMutable($faker->dateTime());

            // Création d'une addresse factice
            $address = (new Address())->setStreet($faker->streetName())
                ->setPostalCode($faker->postcode())
                ->setCity($faker->city())
                ->setCountry($faker->country())
                ->setCreatedAt($dateA)
                ->setUser($user);

            $dateP = \DateTimeImmutable::createFromMutable($faker->dateTime());

            // Création d'un profil factice
            $profile = (new Profile())
                ->setPicture("https://picsum.photos/360/360?image=".$i)
                ->setCoverPicture("https://picsum.photos/360/360?image=".($i+100))
                ->setDescription($faker->paragraph())
                ->setCreatedAt($dateP)
                ->setUser($user);

            // Ajout du user factice dans notre tableau de users
            $users[] = $user;

            // Ajout des entités dans l'index
            $manager->persist($address);
            $manager->persist($profile);
        }

        // Initialisation d'un tableau de categories
        $categories = [];

        // Boucle permettant la création de 5 catégories
        for ($i = 0; $i < 5; $i++) {
            $dateC = \DateTimeImmutable::createFromMutable($faker->dateTime());
            // Création d'une catégorie factice
            $category = (new Category())
                ->setName($faker->sentence(2))
                ->setDescription($faker->paragraph())
                ->setImageUrl("https://picsum.photos/360/360?image=".($i+200))
                ->setCreatedAt($dateC);

            // Ajout de la catégorie dans l'array categories
            $categories[] = $category;
            // Ajout de la categorie dans l'index
            $manager->persist($category);
        }

        // Boucle permettant la création de 100 articles
        for ($i = 0; $i < 100; $i++) {
            $dateArt = \DateTimeImmutable::createFromMutable($faker->dateTime());
            // Création d'un article factice
            $article = (new Article())->setTitle($faker->sentence(3))
                ->setContent($faker->text(80))
                ->setImageUrl("https://picsum.photos/360/360?image=".($i+300))
                ->setCreatedAt($dateArt)
                ->setAuthor($users[rand(0, count($users) - 1)])
                ->addCategory($categories[rand(0, count($categories) - 1)]);

            // Ajout de l'article dans l'index
            $manager->persist($article);
        }

        // Persistence de toutes les entités dans l'index en BDD
        $manager->flush();
    }
}
