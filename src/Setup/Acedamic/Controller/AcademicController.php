<?php


namespace Vxsoft\Setup\Acedamic\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Vxsoft\Main\Service\MainService;
use Vxsoft\Setup\Acedamic\Entity\Affiliation;
use Vxsoft\Setup\Acedamic\Form\AffiliationType;

/**
 * Class AcademicController
 * @package Vxsoft\Setup\Acedamic\Controller
 * @Route("/admin/setup/academic")
 */
class AcademicController extends AbstractController
{

    private $em;


    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @param Request $request
     * @Route("/", name="vx_setup_academic")
     */
    public function indexAction(Request $request){

        return $this->render('Setup\Academic\academic.html.twig');
    }

    /**
     * @Route("/affiliation", name="vx_affiliation_index")
     * @param Request $request
     */
    public function affiliatedAction(Request $request){
        $affiliations = $this->em->getRepository(Affiliation::class)->findBy(['deleted' => 0]);
        return $this->render('Setup\Academic\Affiliation\index.html.twig', compact('affiliations'));
    }

    /**
     * @param Request $request
     * @Route("/affiliation/create", name="vx_setup_affilition_create")
     * @Route("/affiliation/{id}/update", name="vx_setup_affilition_update")
     */
    public function createAction(Request $request){
        /**
         * @var Affiliation $affiliation
         */

        $id = $request->get('id');
        $now = new \DateTime();
        $user = $this->getUser();
       if($id){
           $affiliation = $this->em->getRepository(Affiliation::class)->findOneBy(['id'=> $id]);
       }else{
           $affiliation = new Affiliation();
           $affiliation->setCreatedAt($now);
           $affiliation->setCreatedBy($user);
       }
        $form = $this->createForm(AffiliationType::class, $affiliation);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $affiliation = $form->getData();
            $affiliation->setUpdatedAt($now);
            $this->em->persist($affiliation);
            $this->em->flush();
            return $this->redirect('/setup/academic/affiliation');

        }
//
        $form = $form->createView();
        return $this->render('Setup\Academic\Affiliation\create.html.twig', compact('form'));
    }

    /**
     * @param Request $request
     * @Route("/affiliation/{id}/delete", name="vx_delete_affiliation")
     */
    public function deleteAffiliation(Request $request,MainService $service){
        $id= $request->get('id');
        $affiliation = $this->em->getRepository(Affiliation::class)->findOneBy(['id'=>$id]);
        $message =  $service->softDelete($affiliation);
        return $this->redirectToRoute('vx_affiliation_index');
    }
}