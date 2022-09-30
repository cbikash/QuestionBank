<?php


namespace Vxsoft\Setup\Acedamic\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Vxsoft\Main\Service\MainService;
use Vxsoft\Setup\Acedamic\Entity\Faculty;
use Vxsoft\Setup\Acedamic\Entity\Level;
use Vxsoft\Setup\Acedamic\Form\FacultyType;
use Vxsoft\Setup\Acedamic\Form\LevelType;

/**
 * Class FacultyController
 * @package Vxsoft\Setup\Acedamic\Controller
 * @Route("/admin/setup/academic")
 */
class LevelController extends AbstractController
{

    private $em;
    private $mainService;


    public function __construct(EntityManagerInterface $entityManager, MainService $mainService)
    {
        $this->em = $entityManager;
        $this->mainService = $mainService;
    }

    /**
     * @param Request $request
     * @Route("/level", name="vx_setup_level")
     */
    public function indexAction(Request $request){
        $levels = $this->em->getRepository(Level::class)->findBy(['deleted'=> 0]);
        return $this->render('Setup\Academic\Level\index.html.twig', compact('levels'));
    }

    /**
     * @param Request $request
     * @Route("/level/create", name="vx_level_add")
     * @Route("/level/{id}/update", name="vx_setup_level_update")
     */
    public function createUpdateAction(Request $request){
        /**
         * @var Level $level
         */

        $id = $request->get('id');
        $now = new \DateTime();
        $user = $this->getUser();
        if($id){
            $level = $this->em->getRepository(Level::class)->findOneBy(['id'=> $id]);
        }else{
            $level = new Level();
            $level->setCreatedAt($now);
            $level->setCreatedBy($user);
        }
        $form = $this->createForm(LevelType::class, $level);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $level = $form->getData();
            $level->setUpdatedAt($now);
            $this->em->persist($level);
            $this->em->flush();
            return $this->redirectToRoute('vx_setup_level');

        }
        $form = $form->createView();
        return $this->render('Setup\Academic\Level\create.html.twig', compact('form'));
    }

    /**
     * @param Request $request
     * @Route("/level/{id}/delete", name="vx_delete_level")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteFaculty(Request $request){
        $id = $request->get('id');
        $faculty = $this->em->getRepository(Faculty::class)->findOneBy(['id'=>$id]);
        $message = $this->mainService->softDelete($faculty);

        return $this->redirectToRoute('vx_setup_level');

    }


}