<?php
/**
 * Tag type.
 */
namespace AppBundle\Form;

use AppBundle\Entity\Tag;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class TagType.
 *
 * @package AppBundle\Form
 */
class TagType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {//nazwa klasy jako argument,zeby wymusic typ, rzutowanie, debugowanie tez wywali blad jak podamy ta klase
        $builder->add( // utworzenie pol formularza, wszystko zaczynam od builder add, a nie samo add od strzalki
            'name', //nazwa taka jak w encji
            TextType::class, //nazwa klasy:class, ten typ bedzie w kompilacji
            [
                'label' => 'label.name', //tablica parametrow
                'required' => true,
                'attr' => [
                    'max_length' => 128, //podtablica, wszystko co nie pasuje do wzorca ,
                ],//128 to nie walidacja, tak jak true wyzej
            ]
        );//nie definuje tu przycisku submit, jest elementem interfejsu a nie formularza
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) //OPCJE KONFIGURACYJNE, nazwa klasy jako argument
    {
        $resolver->setDefaults(
            [
                'data_class' => Tag::class,//powiazanie formularza z konkretna encja, pozwala na komunikacje w obie str
                'validation_groups' => 'tag-default',// jaki typ walidacji
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'tag_type';
    }
}