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
        /*dump($options);die;
        $userAlbums = $this->entityManager->getRepository(Album::class)->findBy(['name' => $options['data']->id]);
        $albums = [];
        foreach ($userAlbums as $album) {
            $albums = $album->getName();
        }*/

        $builder->add('name')
            ->add('duration')
            ->add('filePath');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Song::class,
        ]);
    }
}
