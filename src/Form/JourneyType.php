<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Journey;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JourneyType extends AbstractType
{
    /**
     * @var User
     */
    private $user;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->user = $options['currentUser'];
        $builder
            ->add('car', EntityType::class,[
                'class' => Car::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->where('c.driver = :driver')
                        ->setParameter('driver', $this->user);
                },
                'choice_label' => 'id',
            ])
            ->add('steps', CollectionType::class, [
               'entry_type' => JourneyStepType::class,
                'entry_options' => [
                    'label' => false
                ],
                'allow_add' => true,
                'by_reference' => false,
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Journey::class,
            'currentUser' => null,
        ]);
    }
}
