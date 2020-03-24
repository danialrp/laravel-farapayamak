<?php

namespace DanialPanah\Farapayamak;

use DanialPanah\Farapayamak\Traits\FarapayamakRequest;
use Exception;

/**
 * Class Farapayamak
 *
 * @package \DanialPanah\Farapayamak
 */
class Farapayamak
{
    use FarapayamakRequest;

    /**
     * @param array $data
     * @return mixed
     * @throws Exception
     */
    public function send(array $data = [])
    {
        if(isset($data['to']) && isset($data['text'])) {
            return $this->sendRequest($data);
        }
        throw new Exception('Recipient(s) or Text is not set');
    }
}