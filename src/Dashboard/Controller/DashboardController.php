<?php


namespace Vxsoft\Dashboard\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DashboardController
 * @package App\Dashboard\Controller
 * @Route("/admin")
 */
class DashboardController extends AbstractController
{
    public function __construct()
    {
    }

    /**
     * @param Request $request
     * @Route("/", name="vx_dashboard")
     * @return Response
     */
    public function indexAction(Request $request){

        return $this->render('Dashboard/index.html.twig');
    }

}