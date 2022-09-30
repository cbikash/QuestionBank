<?php


namespace Vxsoft\Setup\Acedamic\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vxsoft\Setup\Acedamic\Entity\Affiliation;
use Vxsoft\Setup\Acedamic\Entity\Faculty;
use Vxsoft\Setup\Acedamic\Entity\Level;

class LevelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class,[])
            ->add('code',TextType::class,[])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        return $resolver->setDefaults([
            'data_class' => Level::class
        ]);
    }

    public function getBlockPrefix()
    {
        return 'level_type'; // TODO: Change the autogenerated stub
    }


}