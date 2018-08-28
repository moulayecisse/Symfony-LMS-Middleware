<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 18/08/2018
 * Time: 18:27.
 */

namespace App\Controller\API;

use App\Repository\SubCategoryRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SubCategoryController.
 *
 * @Route("/api/sub-categories")
 */
class SubCategoryController
{
    /**
     * Count action.
     *
     * @Route(
     *     name="api_sub_category_count",
     *     path="/count",
     *     methods={"GET"},
     *     defaults={
     *         "_api_item_operation_name"="count"
     *     }
     * )
     *
     * @param SubCategoryRepository $subCategoryRepository
     *
     * @return JsonResponse
     */
    public function count(SubCategoryRepository $subCategoryRepository)
    {
        $subCategoriesCount = $subCategoryRepository->count([]);

        return new JsonResponse(['subCategoriesCount' => $subCategoriesCount]);
    }

    /**
     * Count action.
     *
     * @Route(
     *     name="api_sub_category_counts",
     *     path="/counts",
     *     methods={"GET"},
     *     defaults={
     *         "_api_item_operation_name"="counts"
     *     }
     * )
     *
     * @param SubCategoryRepository $subCategoryRepository
     *
     * @return JsonResponse
     */
    public function counts(SubCategoryRepository $subCategoryRepository)
    {
        $subCategories = $subCategoryRepository->findBy([], [], 4);

        $subCategoryCounts = [];

        foreach ($subCategories as $subCategory) {
            $subCategoryCounts[] = ['name' => $subCategory->getName(), 'count' => count($subCategory->getBooks())];
        }

        return new JsonResponse($subCategoryCounts);
    }
}
