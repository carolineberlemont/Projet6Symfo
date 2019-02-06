<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Entity\AdSearch;
use App\Form\AnnonceType;
use App\Form\AdSearchType;
use App\Repository\AdRepository;
use App\Service\PaginationService;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class AdController extends Controller
{
    /**
     * @Route("/ads/{page<\d>?1}", name="ads_index")
     */
    public function index(Request $request, AdRepository $repo, $page, PaginationService $pagination)
    { 
        $search = new AdSearch();
        $form = $this->createForm(AdSearchType::class, $search);
        $form->handleRequest($request);

        //     if($form->isSubmitted() && $form->isValid()) {
        //         $search_ads = $this->getDoctrine()
        //                             ->getManager()
        //                             ->getRepository($search)
        //                             ->search($search);
                
        //         if($search_ads!= '') {
        //             $pagination ->setEntityClass(AdSearch::class)
        //                 ->setPage($page)
        //                 ->setLimit(12);

        //             return $this->render('ad/index.html.twig', [
        //                 'ads' => $pagination->getData(),
        //                 'pages' => $pagination->getPages(),
        //                 'page' => $page,      
        //                 'form' => $form->createView()
        //             ]);
        //         }

        //         else {
        //             $this->addFlash(
        //                 'warning',
        //                 "Aucune annonce ne correspondt à votre recherche"
        //             );

        //             $pagination ->setEntityClass(Ad::class)
        //                 ->setPage($page)
        //                 ->setLimit(12);

        //             return $this->redirectToRoute('ads_index');
        //         }
        //     }

        //     else {
                $pagination ->setEntityClass(Ad::class)
                        ->setPage($page)
                        ->setLimit(12);

                return $this->render('ad/index.html.twig', [
                    'ads' => $pagination->getData(),
                    'pages' => $pagination->getPages(),
                    'page' => $page,      
                    'form' => $form->createView()           
                ]);
            // }             
    }


    /**
    * Permet de créer une annonce
    *
    * @Route("/ads/new", name="ads_create")
    * @IsGranted("ROLE_USER")
    *
    * @return Response
    */
    public function create(Request $request, ObjectManager $manager)
    {
        $ad = new Ad();

        $form = $this->createForm(AnnonceType::class, $ad);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $ad->setAuthor($this->getUser());
            
            $manager->persist($ad);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'annonce <strong>{$ad->getTitle()}</strong> a bien été enregistrée !"
            );

            return $this->redirectToRoute('ads_show', [
                'slug' => $ad->getSlug()
            ]);
        }

        return $this->render('ad/new.html.twig', ['form'=>$form->createView()]);
    }

    /**
     * Permet d'afficher le formulaire d'édition pour modifier une annonce
     * 
     * @Route("/ads/{slug}/edit", name="ads_edit")
     * @Security("is_granted('ROLE_USER')and user === ad.getAuthor()", message="Cette annonce ne vous appartient pas, vous ne pouvez pas la modifier")
     * 
     * @return Response
     */
    public function edit(Ad $ad, Request $request, ObjectManager $manager)    {        

        $form = $this->createForm(AnnonceType::class, $ad);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($ad);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'annonce <strong>{$ad->getTitle()}</strong> a bien été modifiée !"
            );

            return $this->redirectToRoute('ads_show', [
                'slug' => $ad->getSlug()
            ]);
            }
        return $this->render('ad/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet d'afficher une seule annonce
     * 
     * @Route("/ads/{slug}", name="ads_show")
     * @IsGranted("ROLE_USER", message="Vous devez vous connecter pour accéder aux annonces")
     * 
     * @return Response
     */
    public function show(Ad $ad)    {
        return $this->render('ad/show.html.twig', [
            'ad' => $ad
        ]);
    }

    /**
     * Permet de supprimer une annonce
     * 
     * @Route("/ads/{slug}/delete", name="ads_delete")
     * @Security("is_granted('ROLE_USER') and user == ad.getAuthor()", message="Vous n'avez pas le droit de supprimer cette annonce car elle n'est pas à vous")
     * 
     * @param Ad $ad
     * @param ObjectManager $manager
     * @return Response
     * 
     */
    public function delete(Ad $ad, ObjectManager $manager)
    {
        $manager->remove($ad);
        $manager->flush();

        $this->addFlash(
            'success',
            "l'annonce <strong>{$ad->getTitle()}</strong> a bien été supprimée !"
        );
        
        return $this->redirectToRoute("account_index"); 
    }

}
