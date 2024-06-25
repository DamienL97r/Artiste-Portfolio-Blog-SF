<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichFileType;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('email'),
            TextField::new('firstname'),
            TextField::new('lastname'),
            TextField::new('phoneNumber'),
            TextareaField::new('about'),
            TextField::new('imageFile')
                ->setFormType(VichFileType::class)
                ->hideOnIndex(),
            ImageField::new('profilePicture')
                ->setBasePath('/uploads/images/profilePicture')
                ->onlyOnIndex(),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->disable(Action::DELETE, Action::NEW);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud   
            ->setPageTitle('index', 'Paramètres')
            ->setPageTitle('edit', 'Editer les paramètres');
    }
}
