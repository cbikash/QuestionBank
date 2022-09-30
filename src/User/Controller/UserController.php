<?php


namespace Vxsoft\User\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class UserController
 * @package App\User\Controller
 * @Route("/")
 */
class UserController extends AbstractController
{

    /**
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     * @Route("/login", name="vx_login")
     */
    public function loginAction(AuthenticationUtils $authenticationUtils){
        if($this->getUser()){
            return $this->redirectToRoute('vx_dashboard');
        }
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('User/security/login.html.twig', [
                         'last_username' => $lastUsername,
                         'error'         => $error,
        ]);
    }

    /**
     * @Route("/logout", name="vx_security_logout")
     */
    public function logout()
    {

    }
}