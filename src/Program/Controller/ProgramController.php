<?php


namespace Vxsoft\Program\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Vxsoft\Program\Entity\Program;
use Vxsoft\Program\Form\ProgramType;

/**
 * Class ProgramController
 * @package Vxsoft\Program\Controller
 * @Route("/admin/program")
 */
class ProgramController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @Route("/", name="vx_program")
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request){
        $filters = $request->request->all();
    $programs = $this->em->getRepository(Program::class)->getAllQuery($filters)->getQuery()->getResult();

    return $this->render('Program\Program\index.html.twig', compact('programs'));
    }

    /**
     * @param Request $request
     * @Route("/create", name="vx_program_create")
     * @Route("/{program}/update", name="vx_program_update")
     * @return RedirectResponse|Response
     */
    public function createAction(Request $request){

        /**
         * @var Program $program
         */
       $program = new Program();
       $id = $request->get('program');
       $now = new \DateTime();
        $message= "Successfully created Program";
       if($id){
           $program = $this->em->getRepository(Program::class)->findOneBy(['id'=>$id]);
           $program->setUpdatedAt($now);
           $message= "Successfully Update Program";

       }else{
           $program->setCreatedAt($now);
       }

       $form = $this->createForm(ProgramType::class, $program);
       $form->handleRequest($request);

       if($form->isSubmitted() && $form->isValid()){
           $program = $form->getData();

           $this->em->persist($program);
           $this->em->flush();
           $this->addFlash('success', $message);
           return  $this->redirectToRoute('vx_program');

       }
      $form = $form->createView();
       return $this->render('Program/Program/create.html.twig', compact('form'));
    }

    /**
     * @param Request $request
     * @Route("/{id}/details", name="vx_program_details")
     * @return RedirectResponse|Response
     */
    public function programDetails(Request $request){
        $id = $request->get('id');
        $program = $this->em->getRepository(Program::class)->findOneBy(['id'=> $id]);

        if(!$program){
            $this->addFlash('error', 'Program Not found');
            return $this->redirectToRoute('vx_program');
        }

        return $this->render('Program/Program/details.html.twig', compact('program'));
    }
}

