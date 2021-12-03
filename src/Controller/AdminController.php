<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\EditUserType;
use App\Form\RegistrationFormType;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Repository\UsersRepository;
use App\Security\UsersAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use http\Client\Curl\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    /**
     * Liste des utilisateurs du site
     *
     *  @Route("/ListeUtilisateurs",name="ListeUtilisateurs")
     */
    public function UsersList(UsersRepository $users){
        return $this->render('admin/Affiche.html.twig', [
            'users'=>$users->findAll()
        ]);
    }

    /**
     * Modifier un utilisateur
     * @IsGranted("ROLE_USER",message="No access! Get out!")
     *
     *  @Route("/utilisateur/Update{id}",name="update_user")
     */
    public function Update(Users $user,Request $request){
        $form=$this->createForm(EditUserType::class,$user);
        $form->add('Valider',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this->addFlash('message','Utilisateur est modifié avec succèes');
            return $this->redirectToRoute("ListeUtilisateurs");
        }
        return $this->render('admin/Update.html.twig',
            [
                'userForm'=>$form->createView()
            ]);

    }

    /**
     * Supprimer un utilisateur
     *  @Route("/utilisateur/Delet{id}",name="delet_user")
     */
     public function Delete($id,UsersRepository $repository){
        $user=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        return $this->redirectToRoute('ListeUtilisateurs');
    }

    /**
     * Ajouter un utilisateur
     *  @Route("/add_user",name="add_user")
     */
    public function Add(Request $request, UserPasswordEncoderInterface $userPasswordEncoder, GuardAuthenticatorHandler $guardHandler, UsersAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        $user = new Users();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->add('Ajouter',SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $userPasswordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash(
                'info',
                'Added succesfuly!'
            );


            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
            return $this->redirectToRoute('ListeUtilisateurs');
        }
        return $this->render('admin\Add.html.twig',
            [
                'userForm'=>$form->createView()
            ]);
    }
    /**
     *@Route("/rechercherU",name="rechercheU")
     */
    public function SerachByEmail(UsersRepository $repository,Request $request)
    {
        $PropertySearch = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class,$PropertySearch);
        $form->handleRequest($request);
        $user= [];
        $user= $this->getDoctrine()->getRepository(Users::class)->findAll();
        if($form->isSubmitted() && $form->isValid()) {
            $email = $PropertySearch->getEmail();
            if ($email!="")
                $user= $this->getDoctrine()->getRepository(Users::class)->findBy(['email' => $email] );
            else
                $user= $this->getDoctrine()->getRepository(Users::class)->findAll();
        }
        return  $this->render('admin/search1.html.twig',[ 'formU' =>$form->createView(), 'users' => $user]);
    }

    /**
     * @param UsersRepository $repository
     * @return Response
     * @Route ("/ListQB",name="ListQB")
     */
    public function OrderByAgeQB(UsersRepository $repository){
        $user=$repository->OrderByAgeQB();
        return $this->render('admin/Affiche.html.twig',
        ['users'=>$user]);


}
}
