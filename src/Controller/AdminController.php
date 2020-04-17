<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/editRole/{id}", name="editRole")
     */
    public function editRole(Utilisateur $utilisateur = null){
        if($utilisateur == null){
            return $this->redirectToRoute('pays');
        }

        if( $utilisateur->hasRole('ROLE_ADMIN') ){
            $utilisateur->setRoles( ['ROLE_USER'] );
        }
        else{
            $utilisateur->setRoles( ['ROLE_USER', 'ROLE_ADMIN'] );
        }
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($utilisateur);
        $em->flush();

        $this->addFlash("success", "Role modifié");
        return $this->redirectToRoute('pays');
    }

    /**
     * @Route("/utilisateurs", name="utilisateurs")
     */
    public function users(){
        $em = $this->getDoctrine()->getManager();
        $utilisateurs = $em->getRepository(Utilisateur::class)->findAll();

        return $this->render('admin/user.html.twig', [
            'users' => $utilisateurs
        ]);
    }
}
