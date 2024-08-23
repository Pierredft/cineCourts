<?php
namespace App\Form;

use App\Entity\UserCourtMetrage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserCourtMetrageFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
            ])
            ->add('email', EmailType::class, [
                'label' => 'Votre email',
            ])
            ->add('nomFichierVideo', FileType::class, [
                'label' => 'Télécharger la vidéo',
                'mapped' => false,
                'required' => true,
            ])
            ->add('sauvegarder', SubmitType::class, [
                'label' => 'Soumettre'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserCourtMetrage::class,
        ]);
    }
}
