<?php

namespace App\Controller;

use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/contact', name: 'contact_')]
class ContactController extends AbstractController
{
    private Serializer $serializer;

    public function __construct() {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $this->serializer = new Serializer($normalizers, $encoders);
    }

    #[
        Route('/new', name: 'new', methods: ['POST'])
    ]
    public function index(Request $request, EntityManagerInterface $em, ValidatorInterface $validator): JsonResponse
    {
        $message = $this->serializer->deserialize($request->getContent(), Contact::class, 'json');
        $validations = $validator->validate($message);
        $errors = [];
        foreach ($validations as $error) {
            $errors['errors'][$error->getPropertyPath()][] = $error->getMessage();
        }

        if ($errors) {
            return new JsonResponse(
                data: $errors,
                status: Response::HTTP_UNPROCESSABLE_ENTITY,
                headers: ['Content-Type' => 'application/json']
            );
        }

        $em->persist($message);
        $em->flush();

        return new JsonResponse(
            data: $this->serializer->serialize($message, 'json'),
            status: Response::HTTP_CREATED,
            headers: ['Content-Type' => 'application/json']
        );
    }

}
