<?php

namespace App\Controller\Admin;

use App\Entity\Films;
use App\Form\FilmFileType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FilmsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Films::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            TextareaField::new('synopsis'),
            TimeField::new('duree'),
            ImageField::new('affiche')
                ->setBasePath('images/')
                ->setUploadDir('public/images/affiches')
                ->setRequired($pageName !== Crud::PAGE_EDIT)
                ->setFormTypeOptions($pageName === Crud::PAGE_EDIT ? ['allow_delete' => false] : []),
            TextField::new('video')
                ->setFormType(FilmFileType::class)
                ->setFormTypeOption('allow_delete', true),
            ImageField::new('trailer')
                ->setBasePath('video/')
                ->setUploadDir('public/video/trailer')
                ->setRequired($pageName !== Crud::PAGE_EDIT)
                ->setFormTypeOptions(['attr' => ['accept' => 'video/*', 'multiple' => true, 'data-max-file-size' => '750M']]),
        ];
    }
}
