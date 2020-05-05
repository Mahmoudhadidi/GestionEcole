<?php

namespace AbsenceEmployeBundle\Form;

use UserBundle\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AbsenceEmployeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('typeAbsence')
            ->add('idEmploye', EntityType::class, array(
                'class' => \UserBundle\Entity\User::class,
                'query_builder' => function (UserRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.roles Like :role')
                        ->setParameter('role', '%"'.'ROLE_ENSEIGNANT'.'"%');
                },
                'choice_label' => function(\UserBundle\Entity\User $utilisateur) {
                    return $utilisateur->getUsername();
                }

            ))

            ->add('date');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AbsenceEmployeBundle\Entity\AbsenceEmploye'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'absenceemployebundle_absenceemploye';
    }


}
