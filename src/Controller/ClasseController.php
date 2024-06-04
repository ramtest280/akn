<?php

namespace App\Controller;

use App\Entity\Classe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ClasseController extends AbstractController
{
    #[Route('/classe', name: 'liste_classe')]
    public function index(): Response
    {

        return $this->render('classe/index.html.twig', [
            'controller_name' => 'ClasseController',
        ]);
    }

    #[Route('/classe/{name}/students', name: 'class_students')]
    public function showbyclass(Classe $classe): Response
    {
        return $this->render('student/showbyclass.html.twig',[
            'classe' => $classe,
            'students' => $classe->getStudents()
        ]);
    }
}
