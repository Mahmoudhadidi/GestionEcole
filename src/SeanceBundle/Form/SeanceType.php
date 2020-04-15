<?php

namespace SeanceBundle\Form;

use http\Client\Curl\User;
use SeanceBundle\Entity\Seance;
use SeanceBundle\Repository\SeanceRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use UserBundle\Repository\UserRepository;


class SeanceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('duree')
            ->add('heure')
            ->add('date')
            ->add('idEns', EntityType::class, array(
                'class' => \UserBundle\Entity\User::class,
                'query_builder' => function (UserRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.roles Like :role')
                        ->setParameter('role', '%"'.'ROLE_ENSEIGNANT'.'"%');
                },
                'choice_label' => function(\UserBundle\Entity\User $utilisateur) {
                    return $utilisateur->getPrenom() . ' ' . $utilisateur->getNom();
                }

            ))


            ->add('idClasse')->add('idMatiere')->add('idSalle');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SeanceBundle\Entity\Seance'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'seancebundle_seance';
    }


}
