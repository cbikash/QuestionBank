<?php


namespace Vxsoft\Setup\Acedamic\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Vxsoft\Main\Service\MainService;
use Vxsoft\Setup\Acedamic\Entity\ProgramSystem;
use Vxsoft\Setup\Acedamic\Form\ProgramSystemType;

/**
 * Class AcademicSessionController
 * @package Vxsoft\Setup\Acedamic\Controller
 * @Route("/admin/setup/academic")
 */
class ProgramSystemController extends AbstractController
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
     * @Route("/program-system", name="vx_setup_program_system")
     * @return Response
     */
    public function indexAction(Request $request){
        $programSystems = $this->em->getRepository(ProgramSystem::class)->findBy(['deleted'=> 0]);
        return $this->render('Setup\Academic\ProgramSystem\index.html.twig', compact('programSystems'));
    }

    /**
     * @param Request $request
     * @Route("/program-system/create", name="vx_program_system_add")
     * @Route("/program-system/{id}/update", name="vx_setup_program_system_update")
     */
    public function createUpdateAction(Request $request){
        /**
         * @var ProgramSystem $programSystem
         */

        $id = $request->get('id');
        $now = new \DateTime();
        $user = $this->getUser();
        if($id){
            $programSystem = $this->em->getRepository(ProgramSystem::class)->findOneBy(['id'=> $id]);
        }else{
            $programSystem = new ProgramSystem();

            $programSystem->setCreatedAt($now);
            $programSystem->setCreatedBy($user);
        }
        $form = $this->createForm(ProgramSystemType::class, $programSystem);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $programSystem = $form->getData();
            $programSystem->setUpdatedAt($now);
            $this->em->persist($programSystem);
            $this->em->flush();
            return $this->redirectToRoute('vx_setup_program_system');
        }
        $form = $form->createView();
        return $this->render('Setup\Academic\ProgramSystem\create.html.twig', compact('form'));
    }

    /**
     * @param Request $request
     * @Route("/program-system/{id}/delete", name="vx_delete_program_system")
     * @return RedirectResponse
     */
    public function deleteFaculty(Request $request){
        $id = $request->get('id');
        $academicSession = $this->em->getRepository(ProgramSystem::class)->findOneBy(['id'=>$id]);
        $message = $this->mainService->softDelete($academicSession);
        return $this->redirectToRoute('vx_setup_academic_session');

    }



}