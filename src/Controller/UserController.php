<?php

namespace App\Controller;

use App\Entity\ExportateurEntreprise;
use App\Entity\Image;
use App\Entity\User;
use App\Form\ExportateurEntrepriseType;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository, Request $request): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     */
    public function new(Request $request,UserPasswordEncoderInterface $userPasswordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $user->setPassword($userPasswordEncoder->encodePassword($user,$form->get('plainPassword')->getData()));
            $user->setTel($form->get('tel')->getData());
            $user->setSexe($form->get('sexe')->getData());
            $user->setDateAjout(new \DateTime());
            $user->setDialcode(User::defaultDialcode);
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit/{admin}", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user, UserPasswordEncoderInterface $userPasswordEncoder): Response
    {


        $entityManager = $this->getDoctrine()->getManager();
        $userConnect  = $entityManager->getRepository(User::class)->find($this->getUser());

        $is_super_admin = ( $this->isGranted(User::ROLE_ADMIN, $this->getUser()->getRoles()))?true:false;
        $is_admin = (  ($userConnect->getProfil() == 'PORFIL_ADMINISTRATEUR'))?true:false;

        $exportateurEntreprise = new ExportateurEntreprise();
        $isExportateur = ($user->getProfil() == User::PORFIL_EXPORTATEUR)?true:false;
        $entreprise =  $entityManager->getRepository(ExportateurEntreprise::class)->findOneBy([
            "exportateur"=>$user
        ]);

        $exportateurEntreprise = (empty($entreprise))?$exportateurEntreprise:$entreprise ;
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);


        $all = $request->request->all();
        if (($isExportateur == true) ){

            if(  ($request->get('exportateur_entreprise') != null) ){

                $formEntreprise = $this->createForm(ExportateurEntrepriseType::class, $exportateurEntreprise);

                if (!Empty($all)) {

                    $all['exportateur_entreprise']['exportateur'] = $user;
                    $request->request->replace($all);
                }
                $formEntreprise->handleRequest($request);



                if ($formEntreprise->isSubmitted()) {
                    $exportateurEntreprise->setExportateur($user);
                    if ((empty($entreprise)))
                        $entityManager->persist($exportateurEntreprise);

                    $entityManager->flush();

                    return $this->render('user/edit.html.twig', [
                        'user' => $user,
                        'is_admin' => $is_admin,
                        'is_super_admin' => $is_super_admin,
                        'isExportateur' => $isExportateur,
                        'form' => $form->createView(),
                        'formEntreprise' => (isset($formEntreprise))?$formEntreprise->createView():'',
                    ]);
                }
            }else{

                $formEntreprise = $this->createForm(ExportateurEntrepriseType::class, $exportateurEntreprise);
                $formEntreprise->handleRequest($request);
            }

        }


        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($userPasswordEncoder->encodePassword($user,$form->get('plainPassword')->getData()));
            $this->getDoctrine()->getManager()->flush();

            /*   if ($admin == true)
                   return $this->redirectToRoute('user_index');
               else
                   return $this->redirectToRoute('dashboard');*/
        }



        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'is_admin' => $is_admin,
            'is_super_admin' => $is_super_admin,
            'isExportateur' => $isExportateur,
            'form' => $form->createView(),
            'formEntreprise' => (isset($formEntreprise))?$formEntreprise->createView():'',
        ]);
    }



    /**
     * @Route("/{id}/adminEdit/{admin}", name="user_admin_edit", methods={"GET","POST"})
     */
    public function adminEdit(Request $request,$admin, User $user, UserPasswordEncoderInterface $userPasswordEncoder): Response
    {



        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($userPasswordEncoder->encodePassword($user,$form->get('plainPassword')->getData()));
            $this->getDoctrine()->getManager()->flush();

            if ($admin == true)
                return $this->redirectToRoute('user_index');
            else
                return $this->redirectToRoute('dashboard');
        }

        return $this->render('user/admin_edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/chnageProfil/{profile}", name="user_chnageProfil", methods={"GET","POST"})
     */
    public function chnageProfil(TranslatorInterface $translator, User $user,Request $request,UserRepository $userRepository,$profile): Response
    {
        $user->setProfil($profile);
        $this->getDoctrine()->getManager()->flush();
        $fistname  = $user->getFirstName();
        $lastname  = $user->getLastName();
        $request->getSession()->getFlashBag()->add('notice',
            [
                'message'=>"Attribution du profil ".$translator->trans($profile,[], 'profil') ." à $fistname $lastname avec succèss",
                'type'=>'success',
                'heading'=>'Succès',
                'loaderBg'=>'#f96868',
                'showHideTransition'=>'slide',
                'position'=>'top-right',
                'icon'=>'success',
            ]);
        return $this->redirectToRoute('user_index');

    }

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }


    /**
     * @Route("/change_profile_pic", name="user_profile_pic_change")
     */
    public function submitImage(Request $request, FileUploader $updater){
        $entityManager = $this->getDoctrine()->getManager();
        $file = $request->files->get('picture');
        $acceptable= array("gif","png","jpg","jpeg");

        if(null !== $file && in_array($file->guessExtension(),$acceptable)){
            //  $file
            $em =$this->getDoctrine()->getManager();

            $fileName = $updater->upload($file,$this->getParameter("profile_pic_directory"));


            $image = new Image();
            $image->setName($fileName);
            $em->persist($image);
            $em->flush();
            $user = $entityManager->getRepository(User::class)->findOneBy([
                "username"=>$this->getUser()->getUsername()
            ]);

           $user->setImage($image);
            $em->flush();

            return $this->json(array("success"=>true,
                'name'=>$fileName));
        }

        return new Response(
            $this->json(array("success"=>false,'message'=>"Veuillez soumettre une image valide")),
            Response::HTTP_NOT_ACCEPTABLE,
            array('content-type' => 'application/json'));
    }


    /**
     * @Route("/change_mode_paiement/{id_user}/{is_mensualiteMode}", name="user_change_mode_paiement")
     */
    public function changeModepaiement(Request $request,$id_user, $is_mensualiteMode, UserRepository $userRepository){
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->getRepository(User::class)->find($id_user)->setModepaiement(($is_mensualiteMode == true)?User::MOD_PAIEMENT_MENSUEL:User::MOD_PAIEMENT_INSTANTANEE);
        $entityManager->flush();
      return $this->redirectToRoute('user_index');

    }
}
