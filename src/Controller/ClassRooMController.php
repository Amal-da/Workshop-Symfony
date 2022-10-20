<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ClassRoomRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\ClassRoom;
use App\Form\ClassRoomType;
use Symfony\Component\HttpFoundation\Request;

class ClassRooMController extends AbstractController
{
    #[Route('/class/roo/m', name: 'app_class_roo_m')]
    public function index(): Response
    {
        return $this->render('class_roo_m/index.html.twig', [
            'controller_name' => 'ClassRooMController',
        ]);
    }
    #[Route('/classroom', name: 'list_classroom')]
    public function listclub (ClassRoomRepository $repository)
    {   $classroom=$repository->findAll();
        return $this->render("class_roo_m/classroom.html.twig",array("tabclassroom"=>$classroom));
    }

    #[Route('/addstudent', name: 'add_student')]
    public function addStudent(ManagerRegistry  $doctrine)
    {
        $classroom= new ClassRoom();
      //  $classroom->setid("123");
        $classroom->setName("amal");
        $classroom->setNbrstudent("146");
        $em= $doctrine->getManager();
        $em->persist($classroom);
        $em->flush();
        return new Response("add classroom");
  }
  #[Route('/addclassroomForm', name: 'addclassroomForm')]
  public function addForm(Request  $request,ManagerRegistry $doctrine)
  {
      $classroom= new  ClassRoom();
      $form= $this->createForm(ClassroomType::class,$classroom);
      $form->handleRequest($request) ;
      if($form->isSubmitted()){
           $em= $doctrine->getManager();
           $em->persist($classroom);
           $em->flush();
           return  $this->redirectToRoute("addclassroomForm");
       }
      return $this->renderForm("class_roo_m/add.html.twig",array("FormClassRoom"=>$form));
  }
  #[Route('/updateclassroom/{id}', name: 'update_classroom')]
  public function updateStudentForm($id,ClassRoomRepository  $repository,Request  $request,ManagerRegistry $doctrine)
  {
      $classroom= $repository->find($id);
      $form= $this->createForm(ClassroomType::class,$classroom);
      $form->handleRequest($request) ;
      if($form->isSubmitted()){
          $em= $doctrine->getManager();
          $em->flush();
          return  $this->redirectToRoute("addclassroomForm");
      }
      return $this->renderForm("class_roo_m/update.html.twig",array("Formclassroom"=>$form));
  }

  #[Route('/removclassroom/{id}', name: 'remove_classroom')]
  public function remove(ManagerRegistry $doctrine,$id,ClassRoomRepository $repository)
  {
      $classroom= $repository->find($id);
      $em= $doctrine->getManager();
      $em->remove($classroom);
      $em->flush();
      return $this->redirectToRoute("addclassroomForm");
  }
}
