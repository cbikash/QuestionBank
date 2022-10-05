<?php


namespace Vxsoft\Setup\Acedamic\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Vxsoft\Main\Service\MainService;
use Vxsoft\Setup\Acedamic\Entity\AcademicSession;
use Vxsoft\Setup\Acedamic\Entity\AcademicYear;
use Vxsoft\Setup\Acedamic\Form\AcademicSessionType;
use Vxsoft\Setup\Acedamic\Form\AcademicYearType;

/**
 * Class AcademicSessionController
 * @package Vxsoft\Setup\Acedamic\Controller
 * @Route("/admin/setup")
 */
class AcademicSessionController extends AbstractController
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
     * @Route("/academic-session", name="vx_setup_academic_session")
     */
    public function indexAction(Request $request){
        $academicSessions = $this->em->getRepository(AcademicSession::class)->findBy(['deleted'=> 0]);
        return $this->render('Setup\Academic\AcademicSession\index.html.twig', compact('academicSessions'));
    }

    /**
     * @param Request $request
     * @Route("/academic-session/create", name="vx_academic_session_add")
     * @Route("/academic-session/{id}/update", name="vx_setup_academic_session_update")
     */
    public function createUpdateAction(Request $request){
        /**
         * @var AcademicSession $academicSession
         */

        $id = $request->get('id');
        $now = new \DateTime();
        $user = $this->getUser();
        if($id){
            $academicSession = $this->em->getRepository(AcademicSession::class)->findOneBy(['id'=> $id]);
        }else{
            $academicSession = new AcademicSession();

            $academicSession->setCreatedAt($now);
            $academicSession->setCreatedBy($user);
        }
        $form = $this->createForm(AcademicSessionType::class, $academicSession);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $academicYear = $form->getData();
            $academicYear->setUpdatedAt($now);
            $this->em->persist($academicYear);
            $this->em->flush();
            return $this->redirectToRoute('vx_setup_academic_session');
        }
        $form = $form->createView();
        return $this->render('Setup\Academic\AcademicSession\create.html.twig', compact('form'));
    }

    /**
     * @param Request $request
     * @Route("/academic-session/{id}/delete", name="vx_delete_academic_session")
     * @return RedirectResponse
     */
    public function deleteFaculty(Request $request){
        $id = $request->get('id');
        $academicSession = $this->em->getRepository(AcademicSession::class)->findOneBy(['id'=>$id]);
        $message = $this->mainService->softDelete($academicSession);
        return $this->redirectToRoute('vx_setup_academic_session');

    }



}