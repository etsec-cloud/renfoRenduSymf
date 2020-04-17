<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * @Route("/{_locale}")
 */
class ProduitController extends AbstractController
{
    /**
     * @Route("/", name="produit_index", methods={"GET","POST"})
     * Page d'accueil
     */
    public function index(ProduitRepository $produitRepository, Request $request, TranslatorInterface $translator): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fichier = $form->get('photoUpload')->getData();
            if ($fichier) {//Creation de l'extension et envoi de la photo
                $nomFichier = uniqid() . '.' . $fichier->guessExtension();

                try {
                    $fichier->move(
                        $this->getParameter('upload_dir'),
                        $nomFichier
                    );
                } catch (FileException $e) {
                    $this->addFlash("danger", $translator->trans('fichier.erreur'));
                    return $this->redirectToRoute('home');
                }
                $produit->setPhoto($nomFichier);
                $this->addFlash("success", $translator->trans('flash.produit.cree'));
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('produit_index');
        }
        return $this->render('produit/index.html.twig', [// Ce qu'on va afficher dans l'accueil
            'produits' => $produitRepository->findAll(),
            'produit' => $produit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/produit/{id}", name="produit_show", methods={"GET"})
     * Page d'un produit
     */
    public function show(Produit $produit): Response
    {
        return $this->render('produit/produit.html.twig', [
            'produit' => $produit,
        ]);
    }

    /**
     * @Route("/produit/{id}/edit", name="produit_edit", methods={"GET","POST"})
     * Page de modification d'un produit
     */
    public function edit(Request $request, Produit $produit, TranslatorInterface $translator): Response
    {
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('produit_index');
        }

        return $this->render('produit/edit.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="produit_delete", methods={"DELETE"})
     * Page de suppression d'un produit
     */
    public function delete(Request $request, Produit $produit, TranslatorInterface $translator): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            if ($produit->getPhoto() != null) {// On delink et supprime l'image si elle est en local.
                unlink($this->getParameter('upload_dir') . $produit->getPhoto());
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($produit);
            $entityManager->flush();
            $this->addFlash('success', $translator->trans('flash.produit.supprimer'));
        }

        return $this->redirectToRoute('produit_index');
    }
}
