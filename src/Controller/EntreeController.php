<?php

namespace App\Controller;

use App\Entity\Entree;
use App\Form\FormEntreeType;
use App\Repository\EntreeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntreeController extends AbstractController
{
    #[Route('/entree', name: 'app_entree')]
    public function index(): Response
    {
        return $this->render('entree/index.html.twig', [
            'controller_name' => 'EntreeController',
        ]);
    }


    #[Route('/entree', 'entree.index',methods:['GET','POST'])]
    public function ProduitRegistration(Request $request,EntityManagerInterface $manager,ManagerRegistry $doctrine):Response{
        $entitymanager = $doctrine->getManager();
        $entree =new Entree();
       
        $form =$this->createForm(FormEntreeType::class,$entree);
        $data['form'] =$form->createView();
        $data['entrees'] =$entitymanager->getRepository(Entree::class)->findAll();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entree =$form->getData();
            $manager->persist($entree);
            $manager->flush();

            return $this->redirectToRoute('entree.index');
        }
        /*
        return $this->render('produit/index.html.twig',[
            'form'=>$form->createView()
        ]);
        */
        return $this->render('entree/index.html.twig',$data);
    }


    #[Route('/entree', name: 'app_entree')]
    public function show(EntreeRepository $produitRepository,ManagerRegistry $doctrine):Response
    {
        $entitymanager = $doctrine->getManager();
        $entree = new Entree();
        $data['entrees'] =$entitymanager->getRepository(Entree::class)->findAll();
        return $this->render('entree/index.html.twig',$data);
    }

}
