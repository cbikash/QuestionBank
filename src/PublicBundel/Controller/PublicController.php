<?php


namespace Vxsoft\PublicBundel\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PublicController
 * @package Vxsoft\PublicBundel\Controller
 * @Route("/")
 */
class PublicController extends AbstractController
{
    /**
     * @param Request $request
     * @Route("/", name="vx_public_index")
     * @return Response
     */
    public function indexAction(Request $request){


        return $this->render('PublicBundel/index.html.twig');

    }

}