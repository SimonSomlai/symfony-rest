<?php
 namespace App\Entity;

 use Doctrine\ORM\Mapping as ORM;
 use Symfony\Component\Validator\Constraints as Assert;

 /**
  * @ORM\Entity
  * @ORM\Table(name="house")
  * @ORM\HasLifecycleCallbacks()
  */
 class House implements \JsonSerializable
 {
     /**
      * @ORM\Column(type="integer")
      * @ORM\Id
      * @ORM\GeneratedValue(strategy="AUTO")
      */
     private $id;
     /**
      * @ORM\Column(type="string", length=100)
     */
     private $full_address;
     /**
      * @ORM\Column(type="string", length=100)
     */
     private $postal_code;
     /**
      * @ORM\Column(type="string", length=100)
     */
     private $street;
     /**
      * @ORM\Column(type="string", length=100)
     */
     private $street_number;
     /**
      * @ORM\Column(type="string", length=100)
     */
     private $city;
     /**
      * @ORM\Column(type="integer")
     */
     private $beds;
     /**
      * @ORM\Column(type="integer")
     */
     private $baths;
     /**
      * @ORM\Column(type="integer")
     */
     private $size;
     /**
      * @ORM\Column(type="integer")
     */
     private $price;
     /**
      * @ORM\Column(type="string", length=100)
     */
     private $broker;
     /**
      * @ORM\Column(type="string", length=100)
     */
     private $link;
     /**
      * @ORM\Column(type="string", length=100)
     */
     private $image;
     /**
      * @ORM\Column(type="string", length=100)
     */
     private $coordinates;

     /**
      * @return mixed
      */
     public function getId()
     {
         return $this->id ;
     }
     /**
      * @param mixed $id
      */
     public function setId($id)
     {
         $this->id = $id;
     }
     
     /**
      * @return mixed
      */
     public function getFullAddress()
     {
         return $this->full_address ;
     }
     /**
      * @param mixed $full_address
      */
     public function setFullAddress($full_address)
     {
         $this->full_address = $full_address;
     }
     
     /**
      * @return mixed
      */
     public function getPostalCode()
     {
         return $this->postal_code ;
     }
     /**
      * @param mixed $postal_code
      */
     public function setPostalCode($postal_code)
     {
         $this->postal_code = $postal_code;
     }
     
     /**
      * @return mixed
      */
     public function getStreet()
     {
         return $this->street ;
     }
     /**
      * @param mixed $street
      */
     public function setStreet($street)
     {
         $this->street = $street;
     }
     
     /**
      * @return mixed
      */
     public function getStreetNumber()
     {
         return $this->street_number ;
     }
     /**
      * @param mixed $street_number
      */
     public function setStreetNumber($street_number)
     {
         $this->street_number = $street_number;
     }
     
     /**
      * @return mixed
      */
     public function getCity()
     {
         return $this->city ;
     }
     /**
      * @param mixed $city
      */
     public function setCity($city)
     {
         $this->city = $city;
     }
     
     /**
      * @return mixed
      */
     public function getBeds()
     {
         return $this->beds ;
     }
     /**
      * @param mixed $beds
      */
     public function setBeds($beds)
     {
         $this->beds = $beds;
     }
     
     /**
      * @return mixed
      */
     public function getBaths()
     {
         return $this->baths ;
     }
     /**
      * @param mixed $baths
      */
     public function setBaths($baths)
     {
         $this->baths = $baths;
     }
     
     /**
      * @return mixed
      */
     public function getSize()
     {
         return $this->size ;
     }
     /**
      * @param mixed $size
      */
     public function setSize($size)
     {
         $this->size = $size;
     }
     
     /**
      * @return mixed
      */
     public function getPrice()
     {
         return $this->price ;
     }
     /**
      * @param mixed $price
      */
     public function setPrice($price)
     {
         $this->price = $price;
     }
     
     /**
      * @return mixed
      */
     public function getBroker()
     {
         return $this->broker ;
     }
     /**
      * @param mixed $broker
      */
     public function setBroker($broker)
     {
         $this->broker = $broker;
     }
     
     /**
      * @return mixed
      */
     public function getLink()
     {
         return $this->link ;
     }
     /**
      * @param mixed $link
      */
     public function setLink($link)
     {
         $this->link = $link;
     }
     
     /**
      * @return mixed
      */
     public function getImage()
     {
         return $this->image ;
     }
     /**
      * @param mixed $image
      */
     public function setImage($image)
     {
         $this->image = $image;
     }
     
     /**
      * @return mixed
      */
     public function getCoordinates()
     {
         return $this->coordinates ;
     }
     /**
      * @param mixed $coordinates
      */
     public function setCoordinates($coordinates)
     {
         $this->coordinates = $coordinates;
     }

     /**
      * @throws \Exception
      * @ORM\PrePersist()
      */

     public function beforeSave()
     {
         $this->create_date = new \DateTime('now', new \DateTimeZone('Europe/Brussels'));
     }



     /**
      * Specify data which should be serialized to JSON
      * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
      * @return mixed data which can be serialized by <b>json_encode</b>,
      * which is a value of any type other than a resource.
      * @since 5.4.0
      */
     public function jsonSerialize()
     {
         return [
          "id" => $this->getId(),
          "full_address" => $this->getFullAddress(),
          "postal_code" => $this->getPostalCode(),
          "street" => $this->getStreet(),
          "street_number" => $this->getStreetNumber(),
          "city" => $this->getCity(),
          "beds" => $this->getBeds(),
          "baths" => $this->getBaths(),
          "size" => $this->getSize(),
          "price" => $this->getPrice(),
          "broker" => $this->getBroker(),
          "link" => $this->getLink(),
          "image" => $this->getImage(),
          "coordinates" => $this->getCoordinates()
        ];
     }
 }
