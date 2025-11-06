<?php

namespace ControleOnline\Entity;

use Symfony\Component\Serializer\Attribute\Groups; 
use Category;


use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiFilter;
use ControleOnline\Controller\DownloadOrderNFAction;
use Doctrine\ORM\Mapping as ORM;

/**
 * Classes
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
            inputFormats: ['multipart' => ['multipart/form-data']]
        )
    ],
    formats: ['jsonld', 'json', 'html', 'jsonhal', 'csv' => ['text/csv']],
    normalizationContext: ['groups' => ['invoice_tax:read']],
    denormalizationContext: ['groups' => ['invoice_tax:write']]
)]
#[ORM\Table(name: 'ead_classes')]
#[ORM\Index(name: 'courses_id', columns: ['courses_id'])]
#[ORM\Index(name: 'subjects_id', columns: ['subjects_id'])]
#[ORM\Entity] 
class Classes
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
    #[ORM\Column(name: 'classes', type: 'string', length: 255, nullable: false)]
    private $classes;

    /**
     * @var Category
     */
    #[ORM\JoinColumn(name: 'courses_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: Category::class)]
    private $courses;

    /**
     * @var Category
     */
    #[ORM\JoinColumn(name: 'subjects_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: Category::class)]
    private $subjects;
}
