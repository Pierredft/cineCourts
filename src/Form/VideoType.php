<?php

namespace App\Form;

use App\Entity\Films;
use App\Entity\Video;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class VideoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('file', FileType::class, [
                'label' => 'Vidéo (MP4)',
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'accept' => 'video/mp4',
                    'maxSize' => '125000M',
                ],
            ])
            ->add('name')
            ->add('films', EntityType::class, [
                'class' => Films::class,
                'choice_label' => 'name',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Video::class,
        ]);
    }
}