<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
  public const PROGRAMS = [
    ['title' => "Breaking bad", 'synopsis' => "Un professeur de chimie de lycée chez qui on a diagnostiqué un cancer du poumon inopérable se tourne vers la fabrication et la vente de méthamphétamine pour assurer l'avenir de sa famille.", 'poster'=> null, 'category'=> 'Aventure', 'year'=> 2010, 'country'=>'USA'],
    ['title' => "Rick et Morty", 'synopsis' => "Une série animée suivant les exploits d'un super scientifique et de son petit-fils pas très futé.", 'poster'=> null, 'category'=> 'Animation', 'year'=> 2010, 'country'=>'USA'], 
    ['title' => "Le seigneur des anneaux: Les anneaux de pouvoir", 'synopsis' => "Série télévisée inspirée du Seigneur des Anneaux, se déroulant au cours de la période de 3 441 ans, connue sous le nom d'Age of Númenor, ou Second âge.", 'poster'=> null, 'category'=> 'Fantastique', 'year'=> 2010, 'country'=>'USA'],    
    ['title' => "Peaky Blinders", 'synopsis' => "L'épopée d'une famille de gangsters se déroulant en 1919 à Birmingham en Angleterre, d'un gang cousant des lames de rasoir sur les visières de leurs casquettes, et de leur féroce patron Tommy Shelby.", 'poster'=> null, 'category'=> 'Action', 'year'=> 2010, 'country'=>'USA'],
    ['title' => "Le Cabinet de curiosités de Guillermo del Toro", 'synopsis' => "Ces huit contes d'horreur proposés par Guillermo del Toro font surgir des cauchemars étranges dans une collection visuellement éblouissante qui donne la chair de poule.", 'poster'=> null, 'category'=> 'Horreur', 'year'=> 2010, 'country'=>'USA'],
];
  
 public function load(ObjectManager $manager)
    {
      foreach (self::PROGRAMS as $programName) {
            $program = new Program();
            $program->setTitle($programName['title']);
            $program->setSynopsis($programName['synopsis']);
            $program->setPoster($programName['poster']);
           // $program->setCategory($programName['category'], $program);
          
            $program->setCountry($programName['country']);
            $program->setYear($programName['year']);
            $this->addReference('program_' . $programName['title'], $program);
            $program->setCategory($this->getReference('category_'.$programName['category']));
            $manager->persist($program);
            $manager->persist($program);
          //  $this->addReference('category_'. $programName, $program);
      }
      $manager->flush();

    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          CategoryFixtures::class,
        ];
    }
}
