<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Entity\User;
use App\Form\AnnonceType;
use App\Repository\AdRepository;
use App\Repository\UserRepository;
use App\Service\PaginationService;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminController extends AbstractController
{
    /**
     * Permet de se connecter que on est administrateur
     * @Route("/admin/login", name="admin_account_login")
     */
    public function login(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        $username = $utils->getLastUsername();

        return $this->render('admin/account/login.html.twig', [
            'hasError' => $error !== null,
            'username' => $username
        ]);
    }

    /**
     * Permet de se déconnecter quand on est administrateur
     * @Route("/admin/logout", name="admin_account_logout")
     * 
     * @return void
     */
    public function logout()
    {
       // ...
    }

        /**
     * Permet d'afficher le formulaire d'édition d'annonce 
     * @Route("/admin/ads/{id}/edit", name="admin_ads_edit")
     * 
     * @param Ad $ad
     * @return Response
     */
    public function edit(Ad $ad, Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(AnnonceType::class, $ad);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($ad);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'annonce {$ad->getTitle()} a bien été modifiée"
            );
        }


        return $this->render('admin/ad/edit.html.twig', [
            'ad' => $ad, 
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/ads/{page<\d>?1}", name="admin_ads_index", requirements={"page": "\d+"})
     */
    public function adsIndex(AdRepository $repo, $page, PaginationService $pagination)
    {
        $pagination ->setEntityClass(Ad::class)
                    ->setPage($page)
                    ->setLimit(10);

        return $this->render('admin/ad/index.html.twig', [
            'ads' => $pagination->getData(),
            'pages' => $pagination->getPages(),
            'page' => $page
        ]);
    }

    /**
     * Permet de supprimer une annonce 
     * @Route("/admin/ads/{id}/delete", name="admin_ads_delete")
     * 
     * @param Ad $ad
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Ad $ad, ObjectManager $manager)
    {
        $manager->remove($ad);
        $manager->flush();

        $this->addFlash(
            'success', 
            "L'annonce {$ad->getTitle()} a bien été supprimée"
        );

        return $this->redirectToRoute('admin_ads_index');
    }

     /**
     * Permet de se connecter au tableau de bord de l'administration 
     * @Route("/admin", name="admin_dashboard")
     */
    public function index(ObjectManager $manager)
    {
        $users = $manager->createQuery('SELECT COUNT(u) FROM App\Entity\User u')->getSingleScalarResult();
        $ads = $manager->createQuery('SELECT COUNT(a) FROM App\Entity\Ad a')->getSingleScalarResult();
       
        return $this->render('admin/dashboard/index.html.twig', [
            'stats' => [
                'users' => $users,
                'ads' => $ads
            ]
        ]);
    }

    /**
     * Permet d'accéder à la liste des utilisateurs
     * @Route("/admin/users/{page<\d>?1}", name="admin_users_index", requirements={"page": "\d+"})
     */
    public function indexUsers(UserRepository $repo, $page, PaginationService $pagination)
    {
        $pagination ->setEntityClass(User::class)
                    ->setPage($page)
                    ->setLimit(10);

        return $this->render('admin/user/index.html.twig', [
            'users' => $pagination->getData(),
            'pages' => $pagination->getPages(),
            'page' => $page
        ]);
    }

    /**
     * Permet de supprimer un utilisateur
     * @Route("/admin/users/{id}/delete", name="admin_users_delete")
     * 
     * @param User $user
     * @param ObjectManager $manager
     * @return Response
     */
    public function deleteUser(User $user, ObjectManager $manager)
    {
        $manager->remove($user);
        $manager->flush();

        $this->addFlash(
            'success', 
            "L'annonce {$user->getTitle()} a bien été supprimée"
        );

        return $this->redirectToRoute('admin_users_index');
    }
}
