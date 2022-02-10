<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Categorie;
use Faker\Factory;
use Faker\Generator;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

/**
 * Les fixtures nous permettent de générer des données permettant de tester notre projet et ses fonctionnalités
 * Les fixtures ne sont utilisées qu'en développement c'est pourquoi on installe la dépendance en dev uniquement
 * composer require orm-fixtures --dev
 * 
 * Pour générer de fausses données, on utilise également la dépendance faker.
 * Cette dépendance va nous faciliter la création des titres et des paragraphes
 * composer require fakerphp/faker --dev 
 *
 */
class AppFixtures extends Fixture
{

    /**
     * Stocke le générateur de faker qui permet d'appeler les méthodes telles que words, paragraphs, ...
     *
     * @var Generator
     */
    private Generator $faker;

    /**
     * On charge faker dans le constructeur pour pouvoir l'utiliser dans toutes nos méthodes de cette class
     */
    public function __construct()
    {
        $this->faker = Factory::create();
        
    }

    /**
     * load est la méthode appellée avec la commande php bin/console doctrine:fixtures:load ou d:f:l (en raccourci)
     * elle gère l'enregistrement des données en BDD d'où l'utilisation du manager.
     *
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        // Boucle permettant de créer 5 catégories et de les ajouter à la queue (file d'attente pour l'enregistrement en BDD)
        for ($i=0; $i < 5; $i++) { 
            // persist ajoute l'objet en file d'attente
            $manager->persist($this->createCategorie());
        }
        
        // Boucle permettant de créer 10 articles et de les ajouter à la queue (file d'attente pour l'enregistrement en BDD)
        for ($j=0; $j < 10; $j++) { 
            $manager->persist($this->createArticle());
        }
        // On utilise la méthode flush pour syn chroniser la mémoire tampon (générée par le persist) avec la BDD
        $manager->flush();
    }

    /**
     * Génère une catégorie avec de fausses données
     *
     * @return Categorie
     */
    private function createCategorie(): Categorie
    {
        // On créé un nouvel objet Categorie
        $categorie = new Categorie;
        // On lui attribut un nom
        $categorie->setName($this->faker->words(3, true));
        // On retourne la catégorie
        return $categorie;
    }

    private function createArticle(): Article
    {
        // On créé un nouvel objet Article
        $article = new Article;
        // On lui ajoute les fausses données
        // On utilise le design pattern fluent qui permet d'appeller les méthodes les unes à la suite des autres
        // Ce design pattern est utilisable car dans l'entité article les setter retournent l'objet ($this);
        $article->setTitle($this->faker->words(5, true))
                ->setContent($this->faker->paragraphs(5, true))
                ->setCreatedAt(new \DateTime());
        // On retourne l'article
        return $article;
    }
}
