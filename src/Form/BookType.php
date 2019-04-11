<?php

namespace App\Form;

use App\Entity\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('format')
            ->add('isbn10')
            ->add('isbn13')
            ->add('ntitle')
            ->add('description')
            ->add('rightholderPublisher')
            ->add('publisher')
            ->add('author')
            ->add('artist')
            ->add('language')
            ->add('legalDeposit')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
            'translation_domain' => 'forms'
        ]);
    }
}
