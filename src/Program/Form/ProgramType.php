<?php


namespace Vxsoft\Program\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vxsoft\Program\Entity\Program;
use Vxsoft\Setup\Acedamic\Entity\Affiliation;
use Vxsoft\Setup\Acedamic\Entity\Faculty;
use Vxsoft\Setup\Acedamic\Entity\Level;
use Vxsoft\Setup\Acedamic\Entity\ProgramSystem;
use Vxsoft\Setup\Acedamic\Entity\University;
use Vxsoft\Setup\Acedamic\Repository\AffiliationRepository;
use Vxsoft\Setup\Acedamic\Repository\FacultyRepository;
use Vxsoft\Setup\Acedamic\Repository\LevelRepository;
use Vxsoft\Setup\Acedamic\Repository\ProgramSystemRepository;
use Vxsoft\Setup\Acedamic\Repository\UniversityRepository;

class ProgramType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title',TextType::class,[
            'required'=> true
        ])
            ->add('code', TextType::class, [
                'required'=> true,
            ])
            ->add('abbreviation')
            ->add('affiliation',EntityType::class, [
                'class' => Affiliation::class,
                'placeholder'=> '-- Select Affiliation --',
                'required'=> true,
                'query_builder' => function (AffiliationRepository $repo){
                return $repo->createQueryBuilder('a')
                    ->where('a.deleted = 0');
                }
            ])
            ->add('faculty', EntityType::class, [
                'required'=> true,
                'class'=> Faculty::class,
                'placeholder'=> '-- Select Faculty --',
                'query_builder' => function (FacultyRepository $repo){
                return $repo->createQueryBuilder('f')
                    ->where('f.deleted = 0');
                }
            ])
            ->add('level', EntityType::class, [
                'required'=> true,
                'placeholder'=> '-- Select Level --',

                'class'=> Level::class,
                'query_builder' => function(LevelRepository $repo){
                return $repo->createQueryBuilder('l')
                    ->where('l.deleted = 0');
                }
            ])
            ->add('university', EntityType::class,[
                'required'=> true,
                'placeholder'=> '-- Select University --',

                'class'=> University::class,
                'query_builder'=> function(UniversityRepository $repo)
                {
                    return $repo->createQueryBuilder('u')
                        ->where('u.deleted = 0');
                }
            ])
            ->add('system', EntityType::class, [
                'required' => true,
                'placeholder'=> '-- Select Program System --',
                'class' => ProgramSystem::class,
                'query_builder'=> function(ProgramSystemRepository $repository){
                    return $repository->createQueryBuilder('p')
                        ->where('p.deleted =0');
                }
            ])
            ->add('maxDuration')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        return $resolver->setDefaults([
            'data_class' => Program::class
        ]);
    }

    public function getBlockPrefix()
    {
        return parent::getBlockPrefix(); // TODO: Change the autogenerated stub
    }
}