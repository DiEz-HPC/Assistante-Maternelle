<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ContactCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contact::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular(
                fn(?Contact $contact) => $contact ? $contact->getFirstName() . ' ' . $contact->getLastName() : 'Message'
            )
            ->setEntityLabelInPlural('Messages')
            ->setPageTitle(Crud::PAGE_DETAIL, '%entity_label_singular%')
            ->setPageTitle(Crud::PAGE_INDEX, '%entity_label_plural%');
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->remove(Crud::PAGE_DETAIL, Action::EDIT)
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->remove(Crud::PAGE_INDEX, Action::EDIT);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new(propertyName: 'lastName', label: 'Nom'),
            TextField::new(propertyName: 'firstName', label: 'Prénom'),
            TextField::new(propertyName: 'email', label: 'Email'),
            TextField::new(propertyName: 'object', label: 'Objet'),
            TextField::new(propertyName: 'message', label: 'Message')->onlyOnDetail(),
        ];
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
