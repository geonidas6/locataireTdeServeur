<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Vgmcertificat;
use App\Repository\VgmcertificatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends AbstractController
{


    /**
     * @Route("/", name="default")
     */
    public function index(): Response
    {
        return $this->redirect('/dashboard');
    }

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboard(): Response
    {

        return $this->render('dashboard/dashboard.html.twig');
    }


    /**
     * @Route("/topbar", name="topbar")
     */
    public function topbar(): Response
    {
        return $this->render('dashboard/topbar.html.twig');
    }

    /**
     * @Route("/asidebar", name="asidebar")
     */
    public function asidebar(): Response
    {
        $admin_role = (in_array(User::ROLE_ADMIN, $this->getUser()->getRoles())) ? true : false;
        return $this->render('dashboard/asidebar.html.twig', [
            'admin_role' => $admin_role
        ]);
    }

    /**
     * @Route("/footerbar", name="footerbar")
     */
    public function footerbar(): Response
    {
        return $this->render('dashboard/footerbar.html.twig');
    }

    /**
     * @Route("/moduleList", name="moduleList")
     */
    public function moduleList(): Response
    {
        return $this->render('dashboard/moduleList.html.twig');
    }

    /**
     * @Route("/rightAsideBar", name="rightAsideBar")
     */
    public function rightAsideBar(): Response
    {
        return $this->render('dashboard/rightAsideBar.html.twig');
    }

    /**
     * @Route("/chatPanel", name="chatPanel")
     */
    public function chatPanel(): Response
    {
        return $this->render('dashboard/chatPanel.html.twig');
    }
}
