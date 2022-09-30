<?php


namespace Vxsoft\Setup\Acedamic\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Vxsoft\Main\Service\MainService;
use Vxsoft\Setup\Acedamic\Entity\Faculty;
use Vxsoft\Setup\Acedamic\Entity\Level;
use Vxsoft\Setup\Acedamic\Entity\University;
use Vxsoft\Setup\Acedamic\Form\FacultyType;
use Vxsoft\Setup\Acedamic\Form\LevelType;
use Vxsoft\Setup\Acedamic\Form\UnverisityType;

/**
 * Class FacultyController
 * @package Vxsoft\Setup\Acedamic\Controller
 * @Route("/admin/setup/academic")
 */
class UniversityController extends AbstractController
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
     * @Route("/university", name="vx_setup_university")
     */
    public function indexAction(Request $request){
        $universities = $this->em->getRepository(University::class)->findBy(['deleted'=> 0]);
        return $this->render('Setup\Academic\University\index.html.twig', compact('universities'));
    }

    /**
     * @param Request $request
     * @Route("/university/create", name="vx_university_add")
     * @Route("/university/{id}/update", name="vx_setup_university_update")
     */
    public function createUpdateAction(Request $request){
        /**
         * @var University $university
         */

        $id = $request->get('id');
        $now = new \DateTime();
        $user = $this->getUser();
        if($id){
            $university = $this->em->getRepository(University::class)->findOneBy(['id'=> $id]);
        }else{
            $university = new University();
            $university->setCreatedAt($now);
            $university->setCreatedBy($user);
        }
        $form = $this->createForm(UnverisityType::class, $university);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $university = $form->getData();
            $university->setUpdatedAt($now);
            $this->em->persist($university);
            $this->em->flush();
            return $this->redirectToRoute('vx_setup_university');

        }
        $form = $form->createView();
        return $this->render('Setup\Academic\University\create.html.twig', compact('form'));
    }

    /**
     * @param Request $request
     * @Route("/university/{id}/delete", name="vx_delete_university")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteFaculty(Request $request){
        $id = $request->get('id');
        $faculty = $this->em->getRepository(University::class)->findOneBy(['id'=>$id]);
        $message = $this->mainService->softDelete($faculty);
        return $this->redirectToRoute('vx_setup_level');

    }


}