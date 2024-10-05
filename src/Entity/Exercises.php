<?php

namespace ControleOnline\Entity;

use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiFilter;
use ControleOnline\Controller\DownloadOrderNFAction;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Exercises
 *
 * @ORM\Table(name="ead_exercises", indexes={@ORM\Index(name="content_id", columns={"content_id"}), @ORM\Index(name="file_id", columns={"file_id"})})
 * @ORM\Entity

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
class Exercises
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="exercise_type", type="string", length=0, nullable=false)
     */
    private $exerciseType;

    /**
     * @var \Content
     *
     * @ORM\ManyToOne(targetEntity="Content")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="content_id", referencedColumnName="id")
     * })
     */
    private $content;

    /**
     * @var \File
     *
     * @ORM\ManyToOne(targetEntity="File")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="file_id", referencedColumnName="id")
     * })
     */
    private $file;


}
