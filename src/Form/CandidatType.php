<?php

namespace App\Form;

use App\Entity\Candidat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CandidatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('date_naissance')
            ->add('lieu_naissance')
            ->add('sexe')
            ->add('prefeture')
            ->add('diplome')
            ->add('lieu_centre_concour')
            ->add('etablissement_de_provenance')
            ->add('jury')
            ->add('filier_serie')
            ->add('matier_eliminer')
            ->add('amphi')
            ->add('numero_salle')
            ->add('semestre')
            ->add('datecreation')
            ->add('createBy')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Candidat::class,
        ]);
    }
}
