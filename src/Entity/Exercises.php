<?php

namespace ControleOnline\Entity;

use Symfony\Component\Serializer\Attribute\Groups; 
use Content;
use File;
use ControleOnline\Listener\LogListener;

use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiFilter;
use ControleOnline\Controller\DownloadOrderNFAction;
use Doctrine\ORM\Mapping as ORM;

/**
 * Exercises
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
#[ORM\Table(name: 'ead_exercises')]
#[ORM\Index(name: 'content_id', columns: ['content_id'])]
#[ORM\Index(name: 'file_id', columns: ['file_id'])]
#[ORM\Entity] 
class Exercises
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
    #[ORM\Column(name: 'exercise_type', type: 'string', length: 0, nullable: false)]
    private $exerciseType;

    /**
     * @var Content
     */
    #[ORM\JoinColumn(name: 'content_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: Content::class)]
    private $content;

    /**
     * @var File
     */
    #[ORM\JoinColumn(name: 'file_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: File::class)]
    private $file;


}
