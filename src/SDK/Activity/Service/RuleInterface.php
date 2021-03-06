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

namespace Eelly\SDK\Activity\Service;

use Eelly\DTO\RuleDTO;

/**
 * 营销活动优惠规则.
 * 
 * @author eellytools<localhost.shell@gmail.com>
 */
interface RuleInterface
{
    /**
     * @author eellytools<localhost.shell@gmail.com>
     */
    public function getRule(int $ruleId): RuleDTO;

    /**
     * @author eellytools<localhost.shell@gmail.com>
     */
    public function addRule(array $data): bool;

    /**
     * @author eellytools<localhost.shell@gmail.com>
     */
    public function updateRule(int $ruleId, array $data): bool;

    /**
     * @author eellytools<localhost.shell@gmail.com>
     */
    public function deleteRule(int $ruleId): bool;

    /**
     * @author eellytools<localhost.shell@gmail.com>
     */
    public function listRulePage(array $condition = [], int $limit = 10, int $currentPage = 1): array;
}
