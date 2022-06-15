<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\FormCategorieType;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{
    
    #[Route('/ccategorie', name: 'app_categorie')]
    public function index(): Response
    {
        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
        ]);
    }
    

    /*
    #[Route('/categorie', 'categorie.index',methods:['GET','POST'])]
    public function CategorieResgistration(Request $request,EntityManagerInterface $manager):Response
    {
        $categorie =new Categorie();
        $form = $this->createForm(FormCategorieType::class,$categorie);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $categorie=$form->getData();
            $manager->persist($categorie);
            $manager->flush();

            return $this->redirectToRoute('categorie.index');
        }
        return $this->render('categorie/index.html.twig',[
            'form'=>$form->createView()
        ]);
    }
    */

    #[Route('/categorie', 'categorie.index',methods:['GET','POST'])]
    public function ProduitRegistration(Request $request,EntityManagerInterface $manager,ManagerRegistry $doctrine):Response{
        $entitymanager = $doctrine->getManager();
        $categorie =new Categorie();
       
        $form =$this->createForm(FormCategorieType::class,$categorie);
        $data['form'] =$form->createView();
        $data['categories'] =$entitymanager->getRepository(Categorie::class)->findAll();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $categorie =$form->getData();
            $manager->persist($categorie);
            $manager->flush();

            return $this->redirectToRoute('categorie.index');
        }
        /*
        return $this->render('produit/index.html.twig',[
            'form'=>$form->createView()
        ]);
        */
        return $this->render('categorie/index.html.twig',$data);
    }


   

    
}
