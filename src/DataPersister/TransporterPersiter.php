<?php


namespace App\DataPersister;


use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Transporter;
use Doctrine\ORM\EntityManagerInterface;

class TransporterPersiter implements DataPersisterInterface
{
    protected  $em;

    /**
     * TransporterPersiter constructor.
     * @param $em
     */
    public function __construct(EntityManagerInterface  $em)
    {
        $this->em = $em;
    }


    public function supports($data, array $context = []): bool
    {
        return $data instanceof Transporter;
    }

    public function persist( $data)
    {
        // call your persistence layer to save $data
        return $data;
    }

    public function remove($data, array $context = [])
    {
        // call your persistence layer to delete $data
    }
}
