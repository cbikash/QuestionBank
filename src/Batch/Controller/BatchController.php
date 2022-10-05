<?php


namespace Vxsoft\Batch\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Vxsoft\Batch\Entity\Batch;
use Vxsoft\Batch\Entity\BatchSession;
use Vxsoft\Batch\Form\BatchType;
use Vxsoft\Program\Entity\Program;

/**
 * Class BatchController
 * @package Vxsoft\Batch\Controller
 * @Route("/admin/batch")
 */
class BatchController extends AbstractController
{
    private  $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;

    }

    /**
     * @param Request $request
     * @Route("/", name="vx_batch_list")
     * @return Response
     */
    public function listAction(Request $request){
        $filters = $request->request->all();
        $batches = $this->em->getRepository(Batch::class)->getAllQuery($filters)->getQuery()->getResult();
        return $this->render('Batch\list.html.twig', compact('batches'));
    }

    /**
     * @Route("/{batch}/details",name="vx_batch_details")
     * @param Request $request
     */
    public function detailsAction(Request $request){
        $id = $request->get('batch');
        $batch = $this->em->getRepository(Batch::class)->findOneBy(['id'=> $id]);

        return $this->render('Batch\details.html.twig', compact('batch'));
    }
    /**
     * @param Request $request
     * @Route("/{program}/create", name="vx_create_batch")
     * @return RedirectResponse|Response
     */
    public function createAction(Request $request){
        $programId = $request->get('program');
        $program = $this->em->getRepository(Program::class)->findOneBy(['id'=> $programId]);
        if(!($program instanceof Program)){
            $this->addFlash('error', 'Sorry Program Not Found');
            return $this->redirectToRoute('vx_program_details',['id'=> $programId]);
        }
        $batch = new Batch();
        $type = $program->getSystem();
        $date = new \DateTime();

        $form = $this->createForm(BatchType::class, $batch);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $batch = $form->getData();
            $session = $program->getTotalSessions();
            $batch->setProgram($program);
            for ($i = 1 ; $i <= $session; $i++ ){
                $newBatchSession = new BatchSession();
                $newBatchSession->setSession($i);
                $newBatchSession->setType($type);
                $newBatchSession->setBatch($batch);
                $batch->addBatchSession($newBatchSession);
                $this->em->persist($newBatchSession);
            }
            $this->addFlash('success','Successfully Added Batch');
            $this->em->persist($batch);
            $this->em->flush();
        }
        $form = $form->createView();
        return $this->render('Batch/create.html.twig',compact('form','program'));
    }

    /**
     * @param Request $request
     * @Route("/update/{batch}/{program}", name="vx_batch_update")
     */
    public function updateBatch(Request $request){
        $id = $request->get('batch');
        $programId = $request->get('program');
        $program = $this->em->getRepository(Program::class)->findOneBy(['id'=> $programId]);
        $batch= $this->em->getRepository(Batch::class)->findOneBy(['id'=> $id]);
        $now = new \DateTime();
        $form = $this->createForm(BatchType::class, $batch);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $batch = $form->getData();
            $batch->setUpdatedAt($now);
            $this->addFlash('success','Successfully Updated Batch');
            $this->em->persist($batch);
            $this->em->flush();
            $this->redirectToRoute('vx_program_details',['id' => $program->getId()]);
        }
        $form = $form->createView();
        return $this->render('Batch/create.html.twig',compact('form','program'));

    }
}