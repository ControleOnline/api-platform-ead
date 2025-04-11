<?php

namespace ControleOnline\Entity; 
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
 * Sessions
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
#[ORM\Table(name: 'ead_sessions')]
#[ORM\Index(name: 'content_id', columns: ['content_id'])]
#[ORM\Entity] 
class Sessions
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
    #[ORM\Column(name: 'session_type', type: 'string', length: 0, nullable: false)]
    private $sessionType;

    /**
     * @var string
     */
    #[ORM\Column(name: 'session', type: 'string', length: 255, nullable: false)]
    private $session;

    /**
     * @var \DateTime|null
     */
    #[ORM\Column(name: 'start_data', type: 'datetime', nullable: true)]
    private $startData;

    /**
     * @var \DateTime|null
     */
    #[ORM\Column(name: 'end_data', type: 'datetime', nullable: true)]
    private $endData;

    /**
     * @var \Content
     */
    #[ORM\JoinColumn(name: 'content_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: \Content::class)]
    private $content;


}
