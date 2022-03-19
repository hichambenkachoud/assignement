<?php

declare(strict_types=1);

/**
 * This file is part of a Upply project.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Infrastructure\Controller;

use App\Application\Handler\KnightHandler;
use App\Infrastructure\DataMapper\KnightDataMapperInterface;
use App\Infrastructure\Dto\AddKnightDto;
use Exception;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class KnightController extends AbstractController
{
    private KnightHandler $knightHandler;
    private KnightDataMapperInterface $knightDataMapper;
    private ValidatorInterface $validator;

    public function __construct(
        KnightHandler $knightHandler,
        KnightDataMapperInterface $knightDataMapper,
        ValidatorInterface $validator
    ) {
        $this->knightHandler = $knightHandler;
        $this->knightDataMapper = $knightDataMapper;
        $this->validator = $validator;
    }

    /**
     * @return View
     * @Rest\Get(path="/knights", name="knights_list")
     */
    public function findAll(): View
    {
        return View::create($this->knightHandler->listKnights(), Response::HTTP_OK);
    }

    /**
     * @param AddKnightDto $addKnightDto
     * @return View
     * @Rest\Post(path="/knights", name="knights_add")
     * @ParamConverter("addKnightDto", converter="fos_rest.request_body")
     * @throws Exception
     */
    public function add(AddKnightDto $addKnightDto): View
    {
        $errors = $this->validator->validate($addKnightDto);

        if (count($errors) > 0) {
            return View::create(
                $this->_createError($errors),
                Response::HTTP_BAD_REQUEST);
        }

        $this->knightHandler->add(
            $this->knightDataMapper->dtoAddKnightToDomain($addKnightDto)
        );

        return View::create('Knight added successfully', Response::HTTP_CREATED);
    }

    /**
     * @param string $id
     * @return View
     * @Rest\Get(path="/knights/{id}", name="knights_show")
     */
    public function find(string $id): View
    {
        if(!Uuid::isValid($id)) {
            return View::create('invalid-identifier', Response::HTTP_BAD_REQUEST);
        }

        $knight = $this->knightHandler->getKnight($id);

        if (!$knight) {
            return View::create([
                "message" => "Knight #$id not found.",
                "code" => Response::HTTP_NOT_FOUND
            ], Response::HTTP_NOT_FOUND);
        }

        return View::create($knight, Response::HTTP_OK);
    }

    /**
     * @throws Exception
     */
    private function _createError(ConstraintViolationListInterface $violations): array
    {
        $violation = $violations->getIterator()->current();

        return [
            'code' => Response::HTTP_BAD_REQUEST,
            'message' => $violation->getMessage(),
            'values' => $violation->getInvalidValue()
        ];
    }

}
