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
 * StudentSessionResponses
 *
 * @ORM\Table(name="ead_student_session_responses", indexes={@ORM\Index(name="student_session_id", columns={"student_session_id"}), @ORM\Index(name="exercise_id", columns={"exercise_id"}), @ORM\Index(name="response_id", columns={"response_id"})})
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
class StudentSessionResponses
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
     * @var \Exercises
     *
     * @ORM\ManyToOne(targetEntity="Exercises")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="exercise_id", referencedColumnName="id")
     * })
     */
    private $exercise;

    /**
     * @var \ExercisesOptions
     *
     * @ORM\ManyToOne(targetEntity="ExercisesOptions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="response_id", referencedColumnName="id")
     * })
     */
    private $response;

    /**
     * @var \StudentSessions
     *
     * @ORM\ManyToOne(targetEntity="StudentSessions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="student_session_id", referencedColumnName="id")
     * })
     */
    private $studentSession;


}
