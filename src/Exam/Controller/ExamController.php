<?php


namespace Vxsoft\Exam\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Vxsoft\Exam\Entity\Exam;
use Vxsoft\Exam\Form\ExamType;

/**
 * Class ExamController
 * @package Vxsoft\Exam\Controller
 * @Route("/admin/exam")
 */
class ExamController extends AbstractController
{
    private $em;


    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @Route("/", name="fn_admin_exam_list")
     * @param Request $request
     */
    public function listAction(Request $request){

        $exams = $this->em->getRepository(Exam::class)->findBy(['deleted'=> 0]);
        return $this->render('Exam/list.html.twig', compact('exams'));
    }

    /**
     * @Route("/create", name="fn_admin_exam_create")
     * @param Request $request
     */
    public function createAction(Request $request){

        $exam =  new Exam();

        $form = $this->createForm(ExamType::class, $exam);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

        }

        $form = $form->createView();
        return $this->render('Exam/create.html.twig', compact('form'));
    }

}