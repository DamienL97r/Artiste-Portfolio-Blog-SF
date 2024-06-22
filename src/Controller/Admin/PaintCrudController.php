<?php

namespace App\Controller\Admin;

use App\Entity\Paint;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Factory\EntityFactory;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PaintCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Paint::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            AssociationField::new('category'),
            NumberField::new('width'),
            NumberField::new('height'),
            NumberField::new('price'),
            BooleanField::new('onSale'),
            BooleanField::new('portfolio'),
            SlugField::new('slug')
                ->hideOnIndex()
                ->setTargetFieldName('name'),
            ImageField::new('file')
                ->setBasePath('/uploads/images/paints')
                ->setUploadDir('public/uploads/images/paints')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            DateField::new('createdAt')->hideOnForm(),
            TextareaField::new('description'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDefaultSort(['createdAt' => 'DESC']);
    }
}
