<?php

namespace App\DataFixtures;

use App\Entity\House;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;



class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $serializer = new Serializer([new ObjectNormalizer()], [new CsvEncoder()]);        
        $data = $serializer->decode(file_get_contents('src/DataFixtures/seed.csv'), 'csv');
        forEach($data as $item){
            $house = new House();
            
            $house->setFullAddress($item["full_address"]);
            $house->setPostalCode($item["postal_code"]);
            $house->setStreet($item["street"]);
            $house->setStreetNumber($item["number"]);
            $house->setCity($item["city"]);
            $house->setBeds((int)$item["beds"]);
            $house->setBaths((int)$item["baths"]);
            $house->setSize((int)$item["size"]);
            $house->setPrice((int)$item["price"]);
            $house->setBroker($item["broker"]);
            $house->setLink($item["link"]);
            $house->setImage($item["image"]);
            $house->setCoordinates($item["coordinates"]);


            $manager->persist($house);
        }

        $manager->flush();
    }
}

