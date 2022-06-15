<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\FormProduitType;
use App\Entity\Categorie;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends AbstractController
{
    
    
    #[Route('/addproduit', name: 'app_produit')]
    public function index(): Response
    {
        return $this->render('produit/index.html.twig', [
            'controller_name' => 'ProduitController',
        ]);
    }
    

    #[Route('/produit', 'produit.index',methods:['GET','POST'])]
    public function ProduitRegistration(Request $request,EntityManagerInterface $manager,ManagerRegistry $doctrine):Response{
        $entitymanager = $doctrine->getManager();
        $produit =new Produit();
       
        $form =$this->createForm(FormProduitType::class,$produit);
        $data['form'] =$form->createView();
        $data['produits'] =$entitymanager->getRepository(Produit::class)->findAll();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $produit =$form->getData();
            $manager->persist($produit);
            $manager->flush();

            return $this->redirectToRoute('produit.index');
        }
        /*
        return $this->render('produit/index.html.twig',[
            'form'=>$form->createView()
        ]);
        */
        return $this->render('produit/index.html.twig',$data);
    }


    #[Route('/produit', name: 'app_produit')]
    public function show(ProduitRepository $produitRepository,ManagerRegistry $doctrine):Response
    {
        $entitymanager = $doctrine->getManager();
        $produit = new Produit();
        $data['produits'] =$entitymanager->getRepository(Produit::class)->findAll();
        return $this->render('produit/index.html.twig',$data);
    }

    


   
}
