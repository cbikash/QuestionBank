<?php


namespace Vxsoft\Setup\Acedamic\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Vxsoft\Main\Service\MainService;
use Vxsoft\Setup\Acedamic\Entity\ExamType;
use Vxsoft\Setup\Acedamic\Entity\Faculty;
use Vxsoft\Setup\Acedamic\Entity\Level;
use Vxsoft\Setup\Acedamic\Entity\University;
use Vxsoft\Setup\Acedamic\Form\ExamTypeType;
use Vxsoft\Setup\Acedamic\Form\FacultyType;
use Vxsoft\Setup\Acedamic\Form\LevelType;
use Vxsoft\Setup\Acedamic\Form\UnverisityType;

/**
 * Class FacultyController
 * @package Vxsoft\Setup\Acedamic\Controller
 * @Route("/admin/setup/academic")
 */
class ExamTypeController extends AbstractController
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
     * @Route("/exam-type", name="vx_setup_exam_type")
     */
    public function indexAction(Request $request){
        $examTypes = $this->em->getRepository(ExamType::class)->findBy(['deleted'=> 0]);
        return $this->render('Setup\Academic\ExamType\index.html.twig', compact('examTypes'));
    }

    /**
     * @param Request $request
     * @Route("/exam-type/create", name="vx_exam_type_add")
     * @Route("/exam-type/{id}/update", name="vx_setup_exam_type_update")
     */
    public function createUpdateAction(Request $request){
        /**
         * @var ExamType $examType
         */

        $id = $request->get('id');
        $now = new \DateTime();
        $user = $this->getUser();
        if($id){
            $examType = $this->em->getRepository(ExamType::class)->findOneBy(['id'=> $id]);
        }else{
            $examType = new ExamType();
            $examType->setCreatedAt($now);
            $examType->setCreatedBy($user);
        }
        $form = $this->createForm(ExamTypeType::class, $examType);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $university = $form->getData();
            $university->setUpdatedAt($now);
            $this->em->persist($university);
            $this->em->flush();
            return $this->redirectToRoute('vx_setup_exam_type');

        }
        $form = $form->createView();
        return $this->render('Setup\Academic\ExamType\create.html.twig', compact('form'));
    }

    /**
     * @param Request $request
     * @Route("/exam-type/{id}/delete", name="vx_delete_exam_type")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteFaculty(Request $request){
        $id = $request->get('id');
        $faculty = $this->em->getRepository(University::class)->findOneBy(['id'=>$id]);
        $message = $this->mainService->softDelete($faculty);
        return $this->redirectToRoute('vx_setup_level');

    }


}