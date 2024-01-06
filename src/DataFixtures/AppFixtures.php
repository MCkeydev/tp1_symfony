<?php

namespace App\DataFixtures;

use App\Factory\ArtisteFactory;
use App\Factory\ChansonFactory;
use App\Factory\TypeFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $ALLOWED_TYPES = ['Auteur', 'Compositeur', 'Interprète', 'Arrangeur', 'Musicien'];

        for ($i = 0; $i < 5; $i++) {
            TypeFactory::createOne(["name" => $ALLOWED_TYPES[$i]]);
        }

        ArtisteFactory::createMany(50, function() {
            return [
                'type' => TypeFactory::random(),
            ];
        });

        ChansonFactory::createMany(50, function() {
            return [
                'artistes' => ArtisteFactory::randomSet(3),
            ];
        });

        $manager->flush();
    }
}
