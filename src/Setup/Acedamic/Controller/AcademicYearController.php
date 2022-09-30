<?php


namespace Vxsoft\Setup\Acedamic\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Vxsoft\Main\Service\MainService;
use Vxsoft\Setup\Acedamic\Entity\AcademicYear;
use Vxsoft\Setup\Acedamic\Entity\Faculty;
use Vxsoft\Setup\Acedamic\Form\AcademicYearType;
use Vxsoft\Setup\Acedamic\Form\FacultyType;

/**
 * Class FacultyController
 * @package Vxsoft\Setup\Acedamic\Controller
 * @Route("/admin/setup/academic")
 */
class AcademicYearController extends AbstractController
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
     * @Route("/academic-year", name="vx_setup_academic_year")
     */
    public function indexAction(Request $request){
        $academicYears = $this->em->getRepository(AcademicYear::class)->findBy(['deleted'=> 0]);
        return $this->render('Setup\Academic\AcademicYear\index.html.twig', compact('academicYears'));
    }

    /**
     * @param Request $request
     * @Route("/academic-year/create", name="vx_academic_year_add")
     * @Route("/academic-year/{id}/update", name="vx_setup_academic_year_update")
     */
    public function createUpdateAction(Request $request){
        /**
         * @var AcademicYear $academicYear
         */

        $id = $request->get('id');
        $now = new \DateTime();
        $user = $this->getUser();
        if($id){
            $academicYear = $this->em->getRepository(AcademicYear::class)->findOneBy(['id'=> $id]);
        }else{
            $academicYear = new AcademicYear();

            $academicYear->setCreatedAt($now);
            $academicYear->setCreatedBy($user);
        }
        $form = $this->createForm(AcademicYearType::class, $academicYear);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $academicYear = $form->getData();
            $academicYear->setUpdatedAt($now);
            $this->em->persist($academicYear);
            $this->em->flush();
            return $this->redirectToRoute('vx_setup_academic_year');

        }
        $form = $form->createView();
        return $this->render('Setup\Academic\AcademicYear\create.html.twig', compact('form'));
    }

    /**
     * @param Request $request
     * @Route("/academic-year/{id}/delete", name="vx_delete_academic_year")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteFaculty(Request $request){
        $id = $request->get('id');
        $academicYear = $this->em->getRepository(AcademicYear::class)->findOneBy(['id'=>$id]);
        $message = $this->mainService->softDelete($academicYear);

        return $this->redirectToRoute('vx_setup_faculty');

    }


}