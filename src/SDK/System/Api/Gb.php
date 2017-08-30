<?php

declare(strict_types=1);

/*
 * This file is part of eelly package.
 *
 * (c) eelly.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eelly\SDK\System\Api;

use Eelly\DTO\GbDTO;
use Eelly\SDK\EellyClient;
use Eelly\SDK\System\Service\GbInterface;

/**
 * @author eellytools<localhost.shell@gmail.com>
 */
class Gb implements GbInterface
{
    /**
     * @author eellytools<localhost.shell@gmail.com>
     */
    public function getGb(int $GbId): GbDTO
    {
        return EellyClient::request('system/gb', 'getGb', $GbId);
    }

    /**
     * @author eellytools<localhost.shell@gmail.com>
     */
    public function addGb(array $data): bool
    {
        return EellyClient::request('system/gb', 'addGb', $data);
    }

    /**
     * @author eellytools<localhost.shell@gmail.com>
     */
    public function updateGb(int $GbId, array $data): bool
    {
        return EellyClient::request('system/gb', 'updateGb', $GbId, $data);
    }

    /**
     * @author eellytools<localhost.shell@gmail.com>
     */
    public function deleteGb(int $GbId): bool
    {
        return EellyClient::request('system/gb', 'deleteGb', $GbId);
    }

    /**
     * @author eellytools<localhost.shell@gmail.com>
     */
    public function listGbPage(array $condition = [], int $limit = 10, int $currentPage = 1): array
    {
        return EellyClient::request('system/gb', 'listGbPage', $condition, $limit, $currentPage);
    }

    /**
     * @return self
     */
    public static function getInstance(): self
    {
        static $instance;
        if (null === $instance) {
            $instance = new self();
        }

        return $instance;
    }
}