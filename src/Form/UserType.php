<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       /* $builder
            ->add('email')
            ->add('password')
            ->add('plainPassword')
            ->add('dateAjout')
            ->add('apiToken')
            ->add('lastName')
            ->add('firstName')
            ->add('username')
            ->add('enabled')
            ->add('sexe')
            ->add('tel')
            ->add('adresse')
            ->add('locked')
        ;*/


        $builder
            ->add('lastName',Type\TextType::class, array("attr"=>array('placeholder'=>'Nom','class'=>"form-control"),'label' => ' '))
            ->add('firstName',Type\TextType::class, array("attr"=>array('placeholder'=>'Prénoms','class'=>"form-control"),'label' => ' '))
            ->add('username',Type\TextType::class, array("attr"=>array('placeholder'=>'Identifiant','class'=>"form-control"),'label' => ' '))
            ->add('plainPassword', Type\RepeatedType::class, array(
                'type' => Type\PasswordType::class,
                'invalid_message' => 'Mot de passe non identique',
                'options' => array('attr' => array('class' => 'password-field')),
                'required' => true,
                'first_options'  => array('label' => ' ','attr'=>array('placeholder'=>'Mot de passe','class'=>"form-control")),
                'second_options' => array('label' => ' ', 'attr'=>array('placeholder'=>'Saisir à nouveau','class'=>"form-control"))))
            ->add('email', Type\EmailType::class, array("attr"=>array('placeholder'=>'Email','class'=>"form-control"),'label' => ' '))
            ->add('tel',Type\TextType::class, [
                'label'=>' ',
                'invalid_message' => 'Veillez rentrez un numero de telephone valide',
                "attr"=>[
                    'class'=>"form-control"]
            ])
            ->add('sexe',ChoiceType::class, [
                'choices'  => [
                    'Homme' => User::Homme,
                    'Femme' => User::Femme,
                ],
                'label' => ' ',
                "attr"=>[
                    'class'=>"form-control"]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }

    public function getName()
    {
        return 'user';
    }
}
