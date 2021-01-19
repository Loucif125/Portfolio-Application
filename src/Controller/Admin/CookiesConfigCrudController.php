<?php

namespace App\Controller\Admin;

use App\Entity\CookiesConfig;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CookiesConfigCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CookiesConfig::class;
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
