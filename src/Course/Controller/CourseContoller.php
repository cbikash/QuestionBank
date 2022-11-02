<?php


namespace Vxsoft\Course\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Vxsoft\Course\Entity\Course;
use Vxsoft\Course\Form\CourseType;

/**
 * Class CourseContoller
 * @package Vxsoft\Course\Controller
 * @Route("/admin/course")
 */
class CourseContoller extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;

    }

    /**
     * @Route("/", name="vx_admin_course")
     * @param Request $request
     */
    public function listAction(Request $request){
        $filters = $request->request->all() ?? [];
        $courses = $this->em->getRepository(Course::class)->getQuery($filters)->getQuery()->getResult();

        return $this->render('Course/index.html.twig', compact('courses'));


    }

    /**
     * @Route("/create", name="vx_course_create")
     * @Route("/{id}/update", name="vx_course_update")
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request){
        $message= "Successfully Added Course";
        $course = new Course();
        $id = $request->get('id');
        if($id){
            $course = $this->em->getRepository(Course::class)->findOneBy(['id'=> $id]);
            $message = "Successfully Updated";
        }
        $form = $this->createForm(CourseType::class,$course );
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            try {
                $course = $form->getData();
                $this->em->persist($course);
                $this->em->flush();
                $this->addFlash('success', $message);
                return $this->redirectToRoute('vx_admin_course');
            }catch (\Throwable $throwable){
                $this->addFlash('error', $throwable->getMessage());
            }
        }
        $form = $form->createView();
        return $this->render('Course/create.html.twig', compact('form'));
    }

}