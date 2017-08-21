<?php

declare(strict_types=1);
/*
 * PHP version 7.1
 *
 * @copyright Copyright (c) 2012-2017 EELLY Inc. (https://www.eelly.com)
 * @link      https://api.eelly.com
 * @license   衣联网版权所有
 */

namespace Eelly\SDK\Service\Service;

use Eelly\DTO\UidDTO;

/**
 *
 * @author eellytools<localhost.shell@gmail.com>
 */
interface CompanyInterface
{
    /**
     * 新增店铺企业认证数据.
     *
     * @param array $data 认证数据
     * @param int $data['store_id']
     * @param int $data['name']
     * @param int $data['license']
     * @param int $data['mobile']
     * @param int $data['company']
     * @param int $data['number']
     * @param int $data['business_license']
     * @param int $data['company_photo']
     * @param UidDTO $user   登录用户对象
     * @return bool 
     * @requestExample({"data":{"store_id":1,"name":"\u5e97\u94fa1","license":"440981198806232871","mobile":"13427587735","company":"sixdec","number":"12345678899999","business_license":"[\"https:\\\/\\\/img03.eelly.com\\\/G04\\\/M00\\\/00\\\/98\\\/small_118_poYBAFjWXYaIWdWkAAJU9MtwDJgAAA7dgEx54sAAlUM236.jpg\",\"https:\\\/\\\/img03.eelly.com\\\/G02\\\/M00\\\/00\\\/BD\\\/small_118_ooYBAFjWXYqICR1yAAJWitxTD2AAABXRwMJp64AAlai106.jpg\"]","company_photo":"[\"https:\\\/\\\/img03.eelly.com\\\/G04\\\/M00\\\/00\\\/98\\\/small_118_poYBAFjWXYaIWdWkAAJU9MtwDJgAAA7dgEx54sAAlUM236.jpg\",\"https:\\\/\\\/img03.eelly.com\\\/G02\\\/M00\\\/00\\\/BD\\\/small_118_ooYBAFjWXYqICR1yAAJWitxTD2AAABXRwMJp64AAlai106.jpg\"]"}})
     * @returnExample(true)
     * @throws Eelly\SDK\Service\Exception\CompanyException 701001 参数错误
     * @throws Eelly\SDK\Service\Exception\CompanyException 700001 用户未登录
     * @throws Eelly\SDK\Service\Exception\CompanyException 702001 数据不存在
     * @author fenghaikun<fenghaikun@eelly.net>
     * @since 2017-8-02
     */
    public function addCompany(array $data,UidDTO $user=null):bool;
   
    /**
     * 修改店铺企业认证数据.
     * 用于用户修改认证信息
     *
     * @param array $data 认证数据
     * @param int $data['store_id']
     * @param int $data['name']
     * @param int $data['license']
     * @param int $data['mobile']
     * @param int $data['company']
     * @param int $data['number']
     * @param int $data['business_license']
     * @param int $data['company_photo']
     * @param int $data['status']
     * @param UidDTO $user   登录用户对象
     * @return bool 
     * @requestExample({"data":{"store_id":1,"name":"\u5e97\u94fa1","license":"440981198806232871","mobile":"13427587735","company":"sixdec","number":"12345678899999","business_license":"[\"https:\\\/\\\/img03.eelly.com\\\/G04\\\/M00\\\/00\\\/98\\\/small_118_poYBAFjWXYaIWdWkAAJU9MtwDJgAAA7dgEx54sAAlUM236.jpg\",\"https:\\\/\\\/img03.eelly.com\\\/G02\\\/M00\\\/00\\\/BD\\\/small_118_ooYBAFjWXYqICR1yAAJWitxTD2AAABXRwMJp64AAlai106.jpg\"]","company_photo":"[\"https:\\\/\\\/img03.eelly.com\\\/G04\\\/M00\\\/00\\\/98\\\/small_118_poYBAFjWXYaIWdWkAAJU9MtwDJgAAA7dgEx54sAAlUM236.jpg\",\"https:\\\/\\\/img03.eelly.com\\\/G02\\\/M00\\\/00\\\/BD\\\/small_118_ooYBAFjWXYqICR1yAAJWitxTD2AAABXRwMJp64AAlai106.jpg\"]","status":1}})
     * @returnExample(true)
     * @throws Eelly\SDK\Service\Exception\CompanyException 701001 参数错误
     * @throws Eelly\SDK\Service\Exception\CompanyException 700001 用户未登录
     * @throws Eelly\SDK\Service\Exception\CompanyException 702001 数据不存在
     * @author fenghaikun<fenghaikun@eelly.net>
     * @since 2017-8-02
     */
    public function updateCompany(array $data,UidDTO $user=null):bool;
    /**
     * 审核品店铺企业认证.
     * 用于管理员审核认证信息
     * @param int $storeId 店铺ID
     * @param UidDTO $user   登录用户对象
     * 
     * @return bool 
     * @requestExample({"storeId":1})
     * @returnExample(true)
     * @throws Eelly\SDK\Service\Exception\CompanyException 701001 参数错误
     * @throws Eelly\SDK\Service\Exception\CompanyException 700001 用户未登录
     * @throws Eelly\SDK\Service\Exception\CompanyException 700002 无权限操作
     * @throws Eelly\SDK\Service\Exception\CompanyException 702001 数据不存在
     * @author fenghaikun<fenghaikun@eelly.net>
     * @since 2017-8-02
     */
    public function checkCompany(int $storeId,UidDTO $user=null):bool;
    
    /**
     * 获取一条店铺企业认证记录.
     *
     * @param int $storeId 店铺ID
     * 
     * @return array 
     * @requestExample({"storeId":1})
     * @returnExample({"store_id":1,"name":"\u5e97\u94fa1","license":"440981198806232871","mobile":"13427587735","company":"sixdec","number":"12345678899999","business_license":"[\"https:\\\/\\\/img03.eelly.com\\\/G04\\\/M00\\\/00\\\/98\\\/small_118_poYBAFjWXYaIWdWkAAJU9MtwDJgAAA7dgEx54sAAlUM236.jpg\",\"https:\\\/\\\/img03.eelly.com\\\/G02\\\/M00\\\/00\\\/BD\\\/small_118_ooYBAFjWXYqICR1yAAJWitxTD2AAABXRwMJp64AAlai106.jpg\"]","company_photo":"[\"https:\\\/\\\/img03.eelly.com\\\/G04\\\/M00\\\/00\\\/98\\\/small_118_poYBAFjWXYaIWdWkAAJU9MtwDJgAAA7dgEx54sAAlUM236.jpg\",\"https:\\\/\\\/img03.eelly.com\\\/G02\\\/M00\\\/00\\\/BD\\\/small_118_ooYBAFjWXYqICR1yAAJWitxTD2AAABXRwMJp64AAlai106.jpg\"]","status":1,"created_time":1458093605})
     * @throws Eelly\SDK\Service\Exception\CompanyException 701001 参数错误
     * @throws Eelly\SDK\Service\Exception\CompanyException 702001 数据不存在
     * @author fenghaikun<fenghaikun@eelly.net>
     * @since 2017-8-02
     */
    public function getCompany(int $storeId):array;

}