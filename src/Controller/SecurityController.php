<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
         if ($this->getUser()) {
//             return $this->redirectToRoute('target_path');
             return $this->redirectToRoute('dashboard');
         }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);


    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(Request $request)
    {
        return $this->redirectToRoute('app_login');
    }

    /**
     *
     * @Route("/inscription", name="register")
     */
    public function inscriptionAction(Request $request, UserPasswordEncoderInterface $userPasswordEncoder )
    {
//        $mailer = $this->get("swiftmailer.mailer.default");
        $user = new User();
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);

        $dial = "";
        $entityManager = $this->getDoctrine()->getManager();

        if($form->isSubmitted() && $form->isValid()){
           $usernameExite  = $entityManager->getRepository(User::class)->findOneBy([
                "username"=>$user->getUsername()
        ]);

           $emailExite  = $entityManager->getRepository(User::class)->findOneBy([
                "email"=>$user->getEmail()
        ]);
           if (!empty($usernameExite)){
               $request->getSession()->getFlashBag()->add('error', 'Cet username à déjé été utiliser')   ;
               return $this->render("user/register.html.twig", array('form'=>$form->createView(), 'defaultdialcode'=> User::defaultDialcode,));
           }
           if (!empty($emailExite)){
               $request->getSession()->getFlashBag()->add('error', 'Cet email à déjé été utiliser')   ;
               return $this->render("user/register.html.twig", array('form'=>$form->createView(), 'defaultdialcode'=> User::defaultDialcode,));
           }
            $user->setPassword($userPasswordEncoder->encodePassword($user,$form->get('plainPassword')->getData()));
            $user->setTel($form->get('tel')->getData());
            $user->setSexe($form->get('sexe')->getData());
            $user->setDateAjout(new \DateTime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // On envoie un mail a l'individu sur lequel il doit cliquer pour activer son compte
           /* $message = (new \Swift_Message("Confirmez votre inscription"))
                ->setFrom("antarus@antarus.net")->setTo($user->getEmail())
                ->setBody($this->renderView("app/user/registration_confirm.html.twig",array("id"=>$user->getId())),"text/html");
            $mailer->send($message);
            $this->get('session')->getFlashBag()->add("message","Vous avez été inscrit avec succès,
                                Veuillez activer votre compte en cliquant sur le lien qui a ete envoyé dans votre boite mail");
        */    return $this->redirectToRoute('app_login');
        }

        return $this->render("user/register.html.twig", array('form'=>$form->createView(), 'defaultdialcode'=> User::defaultDialcode,));

    }

}
