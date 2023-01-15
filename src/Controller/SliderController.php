<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Util;
use App\Repository\UtilRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;


class SliderController extends AbstractController
{
    #[Route('/slider', name: 'app_slider')]
    public function index(UtilRepository $util,
    NormalizerInterface $normalizer): Response
    {
        $data = $util->findAll();
        return $this->render('slider/index.html.twig', [
            'data' => $data,
        ]);
    }
}
