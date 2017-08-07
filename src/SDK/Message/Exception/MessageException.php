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

namespace Eelly\SDK\Message\Exception;

use Eelly\Exception\LogicException;

/**
 * @author hehui<hehui@eelly.net>
 */
class MessageException extends LogicException
{
    const PARAMETER_ERROR = '参数有误';

    const DATA_NOT_EXIT = '记录不存在';

    const DATA_INSERT_FAIL = '插入失败';

    const DATA_UPDATE_FAIL = '更新失败';

    const DATA_DELETE_FAIL = '删除失败';

    const DATA_ALREADER_EXIT = '该数据已经存在';

    const  NO_PERMISSIONS = '没有该权限操作';

}