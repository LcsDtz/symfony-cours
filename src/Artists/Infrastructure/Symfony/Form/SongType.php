<?php

namespace App\Artists\Infrastructure\Symfony\Form;

use App\Artists\Domain\Entity\Album;
use App\Artists\Domain\Entity\Song;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SongType extends AbstractType
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $userAlbums = $this->entityManager->getRepository(Album::class)->findBy(['artist' => $options['label']]);

        $builder->add('name')
            ->add('duration')
            ->add('filePath')
            ->add('albums', ChoiceType::class, [
                'choices' => $userAlbums,
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false,
                'mapped' => false,
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Song::class,
        ]);
    }
}
