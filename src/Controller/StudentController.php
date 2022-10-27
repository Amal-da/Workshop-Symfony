<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\StudentRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Student;
use App\Form\StudentType;
use Symfony\Component\HttpFoundation\Request; 
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
    /* #[Route('/Students', name: 'app_Students')]
     public function listStudent (StudentRepository $repository)
     {   $Students=$repository->findAll();
         return $this->render("Student/Students.html.twig",array("tabStudents"=>$Students));
     }*/

     #[Route('/addstudentForm', name: 'addstudentForm')]
  public function addForm(Request  $request,ManagerRegistry $doctrine)
  {
      $Students= new  Student();
      $form= $this->createForm(StudentType::class,$Students);//,$students athika lel ajout w update
      $form->handleRequest($request) ;
      if($form->isSubmitted()){
           $em= $doctrine->getManager();
           $em->persist($Students);
           $em->flush();
           return  $this->redirectToRoute("addstudentForm");
       }
      return $this->renderForm("student/adds.html.twig",array("FormStudent"=>$form));
  }

  #[Route('/removstudent/{ref}', name: 'remove_student')]
  public function remove(ManagerRegistry $doctrine,$ref,StudentRepository $repository)
  {
      $student= $repository->find($ref);
      $em= $doctrine->getManager();
      $em->remove($student);
      $em->flush();
      return $this->redirectToRoute("addstudentForm");
  }
  //bara lel repositery
    #[Route('/Students', name: 'app_Students')]
    public function listStudent (StudentRepository $repository)
    {   $Students=$repository->findAll();
        $Student=$repository->sortByRef();
        $topstudent=$repository->topStudent();
        return $this->render("Student/Students.html.twig",array("tabStudents"=>$Students,
        "sortstudent"=>$Student,
            "topstudent"=>$topstudent
        ));
    }
}
