<?php


namespace Vxsoft\Setup\Acedamic\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Vxsoft\Main\Service\MainService;
use Vxsoft\Setup\Acedamic\Entity\Faculty;
use Vxsoft\Setup\Acedamic\Form\FacultyType;

/**
 * Class FacultyController
 * @package Vxsoft\Setup\Acedamic\Controller
 * @Route("/admin/setup/academic")
 */
class FacultyController extends AbstractController
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
     * @Route("/faculty", name="vx_setup_faculty")
     */
    public function indexAction(Request $request){
        $faculties = $this->em->getRepository(Faculty::class)->findBy(['deleted'=> 0]);
        return $this->render('Setup\Academic\Faculty\index.html.twig', compact('faculties'));
    }

    /**
     * @param Request $request
     * @Route("/faculty/create", name="vx_faculty_add")
     * @Route("/faculty/{id}/update", name="vx_setup_faculty_update")
     */
    public function createUpdateAction(Request $request){
        /**
         * @var Faculty $faculty
         */

        $id = $request->get('id');
        $now = new \DateTime();
        $user = $this->getUser();
        if($id){
            $faculty = $this->em->getRepository(Faculty::class)->findOneBy(['id'=> $id]);
        }else{
            $faculty = new Faculty();
            $faculty->setCreatedAt($now);
            $faculty->setCreatedBy($user);
        }
        $form = $this->createForm(FacultyType::class, $faculty);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $faculty = $form->getData();
            $faculty->setUpdatedAt($now);
            $this->em->persist($faculty);
            $this->em->flush();
            return $this->redirectToRoute('vx_setup_faculty');

        }
        $form = $form->createView();
        return $this->render('Setup\Academic\Faculty\create.html.twig', compact('form'));
    }

    /**
     * @param Request $request
     * @Route("/faculty/{id}/delete", name="vx_delete_faculty")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteFaculty(Request $request){
        $id = $request->get('id');
        $faculty = $this->em->getRepository(Faculty::class)->findOneBy(['id'=>$id]);
        $message = $this->mainService->softDelete($faculty);

        return $this->redirectToRoute('vx_setup_faculty');

    }


}