<?php
namespace App\Controller;

use App\Entity\House;
use App\Repository\HouseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HouseController
 * @package App\Controller
 * @Route("/api", name="house_api")
 */
class HouseController extends AbstractController
{
    /**
     * @param HouseRepository $houseRepository
     * @return JsonResponse
     * @Route("/houses", name="houses", methods={"GET"})
     */
    public function getHouses(HouseRepository $houseRepository)
    {
        $data = $houseRepository->findAll();
        return $this->response($data);
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param HouseRepository $houseRepository
     * @return JsonResponse
     * @throws \Exception
     * @Route("/houses", name="houses_add", methods={"POST"})
     */
    public function addHouse(Request $request, EntityManagerInterface $entityManager, HouseRepository $houseRepository)
    {
        try {
            $request = $this->transformJsonBody($request);

            $house = new House();
            $house->setFullAddress($request->get("full_address"));
            $house->setPostalCode($request->get("postal_code"));
            $house->setStreet($request->get("street"));
            $house->setStreetNumber($request->get("street_number"));
            $house->setCity($request->get("city"));
            $house->setBeds($request->get("beds"));
            $house->setBaths($request->get("baths"));
            $house->setSize($request->get("size"));
            $house->setPrice($request->get("price"));
            $house->setBroker($request->get("broker"));
            $house->setLink($request->get("link"));
            $house->setImage($request->get("image"));
            $house->setCoordinates($request->get("coordinates"));

            $entityManager->persist($house);
            $entityManager->flush();

            $data = [
              'status' => 200,
              'message' => "House added successfully",
            ];
            return $this->response($data);
        } catch (\Exception $e) {
            $data = [
              'status' => 422,
              'message' => "Data no valid",
            ];
            return $this->response($data, 422);
        }
    }

    /**
     * @param HouseRepository $houseRepository
     * @param $id
     * @return JsonResponse
     * @Route("/houses/{id}", name="houses_get", methods={"GET"})
     */
    public function getHouse(HouseRepository $houseRepository, $id)
    {
        $house = $houseRepository->find($id);

        if (!$house) {
            $data = [
              'status' => 404,
              'message' => "House not found",
            ];
            echo $e;
            return $this->response($data, 404);
        }
        return $this->response($house);
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param HouseRepository $houseRepository
     * @param $id
     * @return JsonResponse
     * @Route("/houses/{id}", name="houses_put", methods={"PUT"})
     */
    public function updateHouse(Request $request, EntityManagerInterface $entityManager, HouseRepository $houseRepository, $id)
    {
        try {
            $house = $houseRepository->find($id);

            if (!$house) {
                $data = [
                  'status' => 404,
                  'message' => "House not found",
                ];
                return $this->response($data, 404);
            }

            $request = $this->transformJsonBody($request);
            $house->setFullAddress($request->get("full_address"));
            $house->setPostalCode($request->get("postal_code"));
            $house->setStreet($request->get("street"));
            $house->setStreetNumber($request->get("street_number"));
            $house->setCity($request->get("city"));
            $house->setBeds($request->get("beds"));
            $house->setBaths($request->get("baths"));
            $house->setSize($request->get("size"));
            $house->setPrice($request->get("price"));
            $house->setBroker($request->get("broker"));
            $house->setLink($request->get("link"));
            $house->setImage($request->get("image"));
            $house->setCoordinates($request->get("coordinates"));

            $entityManager->flush();

            $data = [
              'status' => 200,
              'message' => "House updated successfully",
            ];
            return $this->response($data);
        } catch (\Exception $e) {
            $data = [
              'status' => 422,
              'message' => "Data no valid",
            ];
            return $this->response($data, 422);
        }
    }

    /**
     * @param HouseRepository $houseRepository
     * @param $id
     * @return JsonResponse
     * @Route("/houses/{id}", name="houses_delete", methods={"DELETE"})
     */
    public function deleteHouse(EntityManagerInterface $entityManager, HouseRepository $houseRepository, $id)
    {
        $house = $houseRepository->find($id);

        if (!$house) {
            $data = [
              'status' => 404,
              'message' => "House not found",
            ];
            return $this->response($data, 404);
        }

        $entityManager->remove($house);
        $entityManager->flush();
        $data = [
          'status' => 200,
          'message' => "House deleted successfully",
        ];
        return $this->response($data);
    }

    /**
     * Returns a JSON response
     *
     * @param array $data
     * @param $status
     * @param array $headers
     * @return JsonResponse
     */
    public function response($data, $status = 200, $headers = [])
    {
        return new JsonResponse($data, $status, $headers);
    }

    protected function transformJsonBody(\Symfony\Component\HttpFoundation\Request $request)
    {
        $data = json_decode($request->getContent(), true);

        if ($data === null) {
            return $request;
        }

        $request->request->replace($data);

        return $request;
    }
}
