<?php

namespace App\Controller\Admin;

use App\Entity\Subtitle;
use Vich\UploaderBundle\Form\Type\VichFileType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FileField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SubtitleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Subtitle::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titreFilm', 'Titre du film'),
            TextField::new('langue', 'Language'),
            TextField::new('abrev', 'Abbreviation'),
            Field::new('fileFile', 'Upload .vtt file')
                ->setFormType(VichFileType::class)
                ->setLabel('Subtitle File (.vtt)'),
        ];
    }
}
