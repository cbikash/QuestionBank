<?php


namespace Vxsoft\Setup\Acedamic\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vxsoft\Setup\Acedamic\Entity\AcademicYear;
use Vxsoft\Setup\Acedamic\Entity\Affiliation;

class AcademicYearType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('academicYearName', TextType::class,[])
            ->add('abbreviation', TextType::class, [

            ])
            ->add('toDate', DateTimeType::class,[
//                'required' => true,
//                'html5' => false,
//                'widget' => 'single_text',
                'attr' => [
//                    'class'=> 'datePicker'
                ]
            ])

            ->add('fromDate', DateTimeType::class, [
                'required' => true,
//                'html5' => false,
//                'widget' => 'single_text',
                'attr' => [
//                    'class'=> 'datePicker',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        return $resolver->setDefaults([
            'data_class' => AcademicYear::class
        ]);
    }

    public function getBlockPrefix()
    {
        return 'academic_year_type'; // TODO: Change the autogenerated stub
    }


}