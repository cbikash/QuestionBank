<?php


namespace Vxsoft\Batch\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vxsoft\Batch\Entity\BatchSessionCourse;
use Vxsoft\Course\Entity\Course;
use Vxsoft\Course\Repository\CourseRepository;

class BatchSessionCourseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $builder->add('course', EntityType::class, [
          'class' => Course::class,
          'required' => true,
          'query_builder' => function(CourseRepository $repository){
          return $repository->createQueryBuilder('c')
              ->where('c.deleted = 0');
          },
          'attr' => [
              'class' => 'form-control select2'
          ],
          'multiple' => true,
      ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
       return $resolver->setDefaults(
           [
               'data_class' => BatchSessionCourse::class
           ]
       );
    }

    public function getBlockPrefix()
    {
       return 'batch_session_course';
    }


}