<?php

namespace App\Controller\Admin;

use App\Entity\Films;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FileField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use PHPUnit\TextUI\XmlConfiguration\File;
use App\Form\FilmType;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
            TextField::new('name'),
            TextareaField::new('synopsis'),
            TimeField::new('duree')
                ->setFormat('H:i:s'),
            ImageField::new('affiche')
                ->setBasePath('images/')
                ->setUploadDir('public/images/affiches')
                ->setRequired($pageName === Crud::PAGE_EDIT)
                ->setFormTypeOptions($pageName === Crud::PAGE_EDIT ? ['allow_delete' => false] : []),
            ImageField::new('ban')
                ->setBasePath('images/')
                ->setUploadDir('public/images/banniere')
                ->setRequired($pageName === Crud::PAGE_EDIT)
                ->setFormTypeOptions($pageName === Crud::PAGE_EDIT ? ['allow_delete' => false] : []),
            
            AssociationField::new('genres'),
            AssociationField::new('acteurs'),
            AssociationField::new('realisateur'),
            AssociationField::new('arcom'),
        ];
    }
}
