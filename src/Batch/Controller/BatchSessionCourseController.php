<?php


namespace Vxsoft\Batch\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Vxsoft\Batch\Entity\BatchSession;
use Vxsoft\Batch\Entity\BatchSessionCourse;
use Vxsoft\Batch\Form\BatchSessionCourseType;

/**
 * Class BatchSessionCourseController
 * @package Vxsoft\Batch\Controller
 * @Route("/batch-session-course")
 */
class BatchSessionCourseController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @Route("/{batchsession}/add", name="vx_create_batchSession_course")
     * @param Request $request
     */
    public function addBatchSessionCourse(Request $request){
        $batchSessionId = $request->get('batchsession');

        /**
         * @var BatchSession $batchSession
         */
        if($batchSessionId){
            $batchSession = $this->em->getRepository(BatchSession::class)->findOneBy(['id'=> $batchSessionId]);
        }
        $batch  = $batchSession->getBatch();

        $batchSessionCourse = new BatchSessionCourse();
        $form = $this->createForm(BatchSessionCourseType::class, $batchSessionCourse);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            try {
                $data = $form->getData();
                $courses = $data->getCourse();
                foreach ($courses as $course) {
                    $newBatchSessionCourse = new BatchSessionCourse();
                    $newBatchSessionCourse->setBatchSession($batchSession);
                    $newBatchSessionCourse->setCourse($course);
                    $batchSession->addBatchSessionCourse($newBatchSessionCourse);
                    $this->em->persist($newBatchSessionCourse);
                }
                $this->em->persist($batchSession);
                $this->em->flush();
            }catch (\Throwable $exception){
                dd($exception->getMessage());
            }
        }

        $form = $form->createView();

        return $this->render('Batch/batchSessionCourse.html.twig', compact('form', 'batch'));

    }


}