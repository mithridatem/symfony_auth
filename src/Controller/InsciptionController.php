<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UserType;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class InsciptionController extends AbstractController
{
    #[Route('/insciption', name: 'app_insciption')]
    public function index(Request $request, EntityManagerInterface $entityManager,
    UserPasswordHasherInterface $hash): Response
    {
        $user= new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            //dd($contact);
            $pass=$_POST['user']['password']['first'];
            $hashpass = $hash->hashPassword($user, $pass);
            $user->setPassword($hashpass);
            $user->setRoles(['ROLE_USER']);
            $entityManager->persist($user);
            $entityManager->flush();
            //refresh la page :
            return $this->redirectToRoute('app_insciption');
        }
        else{
            return $this->render('insciption/index.html.twig', ['form' => $form->createView()]);
        }
    }
}
