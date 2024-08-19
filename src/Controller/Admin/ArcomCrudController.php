<?php

namespace App\Controller\Admin;

use App\Entity\Arcom;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ArcomCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Arcom::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titre'),
            TextField::new('tags'),
            ImageField::new('picto')
                ->setBasePath('images/')
                ->setUploadDir('public/images/pegi')
                ->setRequired($pageName === Crud::PAGE_EDIT)
                ->setFormTypeOptions($pageName === Crud::PAGE_EDIT ? ['allow_delete' => false] : []),
        ];
    }
}
