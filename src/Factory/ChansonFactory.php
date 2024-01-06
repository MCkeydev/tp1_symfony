<?php

namespace App\Factory;

use App\Entity\Chanson;
use App\Repository\ChansonRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Chanson>
 *
 * @method        Chanson|Proxy create(array|callable $attributes = [])
 * @method static Chanson|Proxy createOne(array $attributes = [])
 * @method static Chanson|Proxy find(object|array|mixed $criteria)
 * @method static Chanson|Proxy findOrCreate(array $attributes)
 * @method static Chanson|Proxy first(string $sortedField = 'id')
 * @method static Chanson|Proxy last(string $sortedField = 'id')
 * @method static Chanson|Proxy random(array $attributes = [])
 * @method static Chanson|Proxy randomOrCreate(array $attributes = [])
 * @method static ChansonRepository|RepositoryProxy repository()
 * @method static Chanson[]|Proxy[] all()
 * @method static Chanson[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Chanson[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Chanson[]|Proxy[] findBy(array $attributes)
 * @method static Chanson[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Chanson[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class ChansonFactory extends ModelFactory
{
    private static array $langues = [
        'Français',
        'Anglais',
        'Espagnol',
        'Allemand',
        'Italien',
        'Portugais',
        'Russe',
        'Japonais',
        'Chinois',
        'Arabe',
        'Hindi',
        'Coréen',
        'Turc',
        'Néerlandais',
        'Suédois',
        'Polonais',
        'Finlandais',
        'Danois',
        'Norvégien',
        'Tchèque',
    ];

    private static array $genres = [
        'Rock',
        'Pop',
        'Hip Hop',
        'Jazz',
        'Blues',
        'Country',
        'Electronic',
        'R&B',
        'Reggae',
        'Classical',
        'Folk',
        'Metal',
        'Punk',
        'Indie',
        'Soul',
        'Funk',
        'Disco',
        'Techno',
        'House',
        'EDM',
    ];

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'dateSortie' => self::faker()->dateTime(),
            'genre' => self::faker()->randomElement(self::$genres),
            'langue' => self::faker()->randomElement(self::$langues),
            'photoCouverture' => "https://source.unsplash.com/random?sig=" . rand(),
            'titre' => self::faker()->text(25),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Chanson $chanson): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Chanson::class;
    }
}
