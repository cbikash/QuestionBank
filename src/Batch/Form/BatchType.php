<?php


namespace Vxsoft\Batch\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vxsoft\Batch\Entity\Batch;
use Vxsoft\Setup\Acedamic\Entity\AcademicSession;
use Vxsoft\Setup\Acedamic\Entity\AcademicYear;
use Vxsoft\Setup\Acedamic\Repository\AcademicSessionRepository;
use Vxsoft\Setup\Acedamic\Repository\AcademicYearRepository;

class BatchType extends AbstractType
{
   public function buildForm(FormBuilderInterface $builder, array $options)
   {
      $builder->add('title')
          ->add('code')
          ->add('academicYear', EntityType::class,[
              'placeholder' => '-- Select Academic Year --',
              'class'=> AcademicYear::class,
              'required' => true,
              'query_builder' => function(AcademicYearRepository $repository)
              {
                  return $repository->createQueryBuilder('a')
                      ->where('a.deleted = 0');
              }
          ])

          ->add('academicSession',EntityType::class,[
              'placeholder' => '-- Select Academic Session --',
              'class' => AcademicSession::class,
              'required'=> true,
              'query_builder'=> function(AcademicSessionRepository $repo){
              return $repo->createQueryBuilder('a')
                  ->where('a.deleted =0');
              }
          ]);
   }

    public function configureOptions(OptionsResolver $resolver)
    {
        return $resolver->setDefaults([
            'data_class' => Batch::class
        ]);
    }

    public function getBlockPrefix()
    {
        return 'batch_type';

    }

}