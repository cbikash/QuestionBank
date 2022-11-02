<?php


namespace Vxsoft\Course\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Vxsoft\Course\Entity\Course;
use Vxsoft\Course\Entity\ElectiveCourse;
use Vxsoft\Course\Form\CourseType;
use Vxsoft\Course\Form\ElectiveCourseType;

/**
 * Class ElectiveCourseController
 * @package Vxsoft\Course\Controller
 * @Route("/admin/course/elective")
 */
class ElectiveCourseController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @Route("/", name="vx_admin_elective_course")
     * @param Request $request
     */
    public function listAction(Request $request){
        $filters = $request->request->all() ?? [];
        $courses = $this->em->getRepository(ElectiveCourse::class)->getAllQuery($filters)->getQuery()->getResult();

        return $this->render('Course/ElectiveCourse/index.html.twig', compact('courses'));


    }

    /**
     * @Route("/create", name="vx_elective_course_create")
     * @Route("/{id}/update", name="vx_elective_course_update")
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request){
        $message= "Successfully Added Course";
        $course = new ElectiveCourse();
        $id = $request->get('id');
        if($id){
            $course = $this->em->getRepository(ElectiveCourse::class)->findOneBy(['id'=> $id]);
            $message = "Successfully Updated";
        }
        $form = $this->createForm(ElectiveCourseType::class,$course );
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            try {
                $course = $form->getData();
                $this->em->persist($course);
                $this->em->flush();
                $this->addFlash('success', $message);
                return $this->redirectToRoute('vx_admin_elective_course');
            }catch (\Throwable $throwable){
                $this->addFlash('error', $throwable->getMessage());
            }
        }
        $form = $form->createView();
        return $this->render('Course/ElectiveCourse/create.html.twig', compact('form'));
    }


}