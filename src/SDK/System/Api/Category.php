<?php

declare(strict_types=1);
/*
 * PHP version 7.1
 *
 * @copyright Copyright (c) 2012-2017 EELLY Inc. (https://www.eelly.com)
 * @link      https://api.eelly.com
 * @license   衣联网版权所有
 */

namespace Eelly\SDK\System\Api;

use Eelly\SDK\EellyClient;
use Eelly\SDK\System\Service\CategoryInterface;
use Eelly\SDK\System\DTO\CategoryDTO;
use Eelly\DTO\UidDTO;

/**
 *
 * @author eellytools<localhost.shell@gmail.com>
 */
class Category implements CategoryInterface
{

    /**
     * 获取指定id文章分类.
     *
     * @param int $categoryId 文章id
     *
     * @throws \Eelly\SDK\System\Exception\SystemException
     *
     * @return \Eelly\SDK\System\DTO\CategoryDTO
     * @requestExample({"categoryId":1})
     * @returnExample({"parentId":0,"name":"分类名称","code":"分类编码","categoryId":1,"sort":1,"status":1,"checkFlag":1,"remark":"分类备注"})
     *
     * @author wujunhua<wujunhua@eelly.net>
     *
     * @since 2017-08-31
     */
    public function getCategory(int $categoryId): CategoryDTO
    {
        return EellyClient::request('system/category', 'getCategory', $categoryId);
    }

    /**
     * 新增文章分类.
     *
     * @param array  $data              文章分类数据
     * @param int    $data['name']      分类名称
     * @param string $data['code']      分类编码
     * @param string $data['parentId']  父分类ID
     * @param int    $data['sort']      排序
     * @param int    $data['status']    状态 0:无效 1:有效
     * @param int    $data['checkFlag'] 分类文章审核标志：0:需审核 1:不需审核
     * @param int    $data['remark']    分类备注
     * @param UidDTO $user              登录用户对象
     *
     * @throws \Eelly\SDK\System\Exception\SystemException
     *
     * @return bool 新增结果
     * @requestExample({"data":{"name":"分类名称","code":"分类编码","parentId":1,"sort":1,"status":1,"checkFlag":1,"remark":"分类备注"}})
     * @returnExample(true)
     *
     * @author wujunhua<wujunhua@eelly.net>
     *
     * @since 2017-08-31
     */
    public function addCategory(array $data, UidDTO $user = null): bool
    {
        return EellyClient::request('system/category', 'addCategory', $data, $user);
    }

    /**
     * 修改文章分类.
     *
     * @param int    $categoryId        文章分类id
     * @param array  $data              文章分类数据
     * @param int    $data['name']      分类名称
     * @param string $data['code']      分类编码
     * @param string $data['parentId']  父分类ID
     * @param int    $data['sort']      排序
     * @param int    $data['status']    状态 0:无效 1:有效
     * @param int    $data['checkFlag'] 分类文章审核标志：0:需审核 1:不需审核
     * @param int    $data['remark']    分类备注
     * @param UidDTO $user              登录用户对象
     *
     * @throws \Eelly\SDK\System\Exception\SystemException
     *
     * @return bool 修改结果
     * @requestExample({"categoryId":1,"data":{"name":"分类名称","code":"分类编码","parentId":1,"sort":1,"status":1,"checkFlag":1,"remark":"分类备注"}})
     * @returnExample(true)
     *
     * @author wujunhua<wujunhua@eelly.net>
     *
     * @since 2017-08-31
     */
    public function updateCategory(int $categoryId, array $data, UidDTO $user = null): bool
    {
        return EellyClient::request('system/category', 'updateCategory', $categoryId, $data, $user);
    }

    /**
     * 删除文章分类.
     *
     * @param int    $categoryId 文章分类id
     * @param UidDTO $user       登录用户对象
     *
     * @throws \Eelly\SDK\System\Exception\SystemException
     *
     * @return bool 删除结果
     * @requestExample({"categoryId":1})
     * @returnExample(true)
     *
     * @author wujunhua<wujunhua@eelly.net>
     *
     * @since 2017-08-31
     */
    public function deleteCategory(int $categoryId, UidDTO $user = null): bool
    {
        return EellyClient::request('system/category', 'deleteCategory', $categoryId, $user);
    }

    /**
     * 获取文章分类列表.
     *
     * @throws \Eelly\SDK\System\Exception\SystemException
     *
     * @return array 文章分类列表
     * @requestExample()
     * @returnExample({"categoryId":"1","name":"分类1","parentId":"0","status":"1","checkFlag":"1","son":[{"categoryId":"3","name":"分类3","parentId":"1","status":"1","checkFlag":"1"},{"categoryId":"4","name":"分类4","parentId":"1","status":"1","checkFlag":"1"}]})
     *
     * @author wujunhua<wujunhua@eelly.net>
     *
     * @since 2017-08-31
     */
    public function listCategory(): array
    {
        return EellyClient::request('system/category', 'listCategory');
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