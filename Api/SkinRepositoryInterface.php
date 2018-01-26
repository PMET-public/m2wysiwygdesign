<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 */
namespace MagentoEse\ThemeCustomizer\Api;

use MagentoEse\ThemeCustomizer\Api\Data\SkinInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface SkinRepositoryInterface
 * @package MagentoEse\ThemeCustomizer\Api
 */
interface SkinRepositoryInterface
{
    public function save(SkinInterface $page);

    public function getById($id);

    public function getList(SearchCriteriaInterface $criteria);

    public function delete(SkinInterface $page);

    public function deleteById($id);
}
