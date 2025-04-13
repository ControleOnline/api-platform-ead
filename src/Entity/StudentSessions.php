<?php

namespace ControleOnline\Entity; 
use Status;
use Sessions;
use DateTime;
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
 * StudentSessions
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
#[ORM\Table(name: 'ead_student_sessions')]
#[ORM\Index(name: 'status_id', columns: ['status_id'])]
#[ORM\Index(name: 'session_id', columns: ['session_id'])]
#[ORM\Entity] 
class StudentSessions
{
    /**
     * @var int
     */
    #[ORM\Column(name: 'id', type: 'integer', nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    private $id;

    /**
     * @var DateTime|null
     */
    #[ORM\Column(name: 'start_date', type: 'datetime', nullable: true)]
    private $startDate;

    /**
     * @var DateTime|null
     */
    #[ORM\Column(name: 'end_date', type: 'datetime', nullable: true)]
    private $endDate;

    /**
     * @var Status
     */
    #[ORM\JoinColumn(name: 'status_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: Status::class)]
    private $status;

    /**
     * @var Sessions
     */
    #[ORM\JoinColumn(name: 'session_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: Sessions::class)]
    private $session;
}
