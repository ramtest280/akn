<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Entity\Student;
use App\Form\StudentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StudentController extends AbstractController
{
    #[Route('/student', name: 'app_student')]
    public function index(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManagerInterface->persist($student);
            $entityManagerInterface->flush();

            return $this->redirectToRoute('app_home');
        }


        return $this->render('student/index.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/class/{name}/students', name: 'class_students')]
    public function showbyclass(Classe $classe): Response
    {
        return $this->render('student/showbyclass.html.twig',[
            'classe' => $classe,
            'students' => $classe->getStudents()
        ]);
    }
}
