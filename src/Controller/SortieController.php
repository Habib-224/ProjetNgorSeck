<?php

namespace App\Controller;

use App\Entity\Sortie;
use App\Form\FormSortieType;
use App\Repository\SortieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SortieController extends AbstractController
{
    #[Route('/sortie', name: 'app_sortie')]
    public function index(): Response
    {
        return $this->render('sortie/index.html.twig', [
            'controller_name' => 'SortieController',
        ]);
    }


    #[Route('/sortie', 'sortie.index',methods:['GET','POST'])]
    public function ProduitRegistration(Request $request,EntityManagerInterface $manager,ManagerRegistry $doctrine):Response{
        $entitymanager = $doctrine->getManager();
        $sortie =new Sortie();
       
        $form =$this->createForm(FormSortieType::class,$sortie);
        $data['form'] =$form->createView();
        $data['sorties'] =$entitymanager->getRepository(Sortie::class)->findAll();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $sortie =$form->getData();
            $manager->persist($sortie);
            $manager->flush();

            return $this->redirectToRoute('sortie.index');
        }
        /*
        return $this->render('produit/index.html.twig',[
            'form'=>$form->createView()
        ]);
        */
        return $this->render('sortie/index.html.twig',$data);
    }


    #[Route('/sortie', name: 'app_sortie')]
    public function show(SortieRepository $produitRepository,ManagerRegistry $doctrine):Response
    {
        $entitymanager = $doctrine->getManager();
        $sortie = new Sortie();
        $data['sorties'] =$entitymanager->getRepository(Sortie::class)->findAll();
        return $this->render('sortie/index.html.twig',$data);
    }

}
