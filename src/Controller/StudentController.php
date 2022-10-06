<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\StudentRepository; 
class StudentController extends AbstractController
{
    #[Route('/student', name: 'app_student')]
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }
     //bd 
     #[Route('/Students', name: 'app_Students')]
     public function listStudent (StudentRepository $repository)
     {   $Students=$repository->findAll();
         return $this->render("Student/Students.html.twig",array("tabStudents"=>$Students));
     }
}
