<?php

namespace ControleOnline\Entity; 
use Exercises;
use ControleOnline\Listener\LogListener;

use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiFilter;
use ControleOnline\Controller\DownloadOrderNFAction;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * ExercisesOptions
 *
 */
#[ApiResource(
    routePrefix: '/ead', // Adiciona o prefixo para as rotas dessa entidade
    operations: [
        new Get(
            security: 'is_granted(\'ROLE_CLIENT\')'
        ),

        new Post(
            
            deserialize: false,
            security: 'is_granted(\'ROLE_CLIENT\')',
            validationContext: ['groups' => ['Default', 'order_upload_nf']],
            openapiContext: ['consumes' => ['multipart/form-data']]
        )
    ],
    formats: ['jsonld', 'json', 'html', 'jsonhal', 'csv' => ['text/csv']],
    normalizationContext: ['groups' => ['invoice_tax:read']],
    denormalizationContext: ['groups' => ['invoice_tax:write']]
)]
#[ORM\Table(name: 'ead_exercises_options')]
#[ORM\Index(name: 'exercise_id', columns: ['exercise_id'])]
#[ORM\Entity] 
class ExercisesOptions
{
    /**
     * @var int
     */
    #[ORM\Column(name: 'id', type: 'integer', nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    private $id;

    /**
     * @var string
     */
    #[ORM\Column(name: 'option', type: 'string', length: 255, nullable: false)]
    private $option;

    /**
     * @var bool
     */
    #[ORM\Column(name: 'correct', type: 'boolean', nullable: false)]
    private $correct;

    /**
     * @var Exercises
     */
    #[ORM\JoinColumn(name: 'exercise_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: Exercises::class)]
    private $exercise;


}
