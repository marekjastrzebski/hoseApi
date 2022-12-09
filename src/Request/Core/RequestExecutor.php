<?php
declare(strict_types=1);
namespace App\Request\Core;

use App\Request\RequestInterface;
use App\Utils\BasicRepository;
use Symfony\Component\HttpFoundation\Response;

class RequestExecutor
{
	private RequestInterface $request;

	public function persist(RequestInterface $request): void
	{
		$this->request = $request;
	}

	public function execute(): void
	{
		if(!empty($this->request->getErrors())){
			$this->responseCode = Response::HTTP_BAD_REQUEST;
			return;
		}
		$this->request->getRepository()->save($this->request->getValidEntity());
	}

	public function getResults(): array
	{
		if(!empty($this->request->getErrors())){
			return $this->request->getErrors();
		}

		return $this->request->getRepository()->getOneById($this->request->getValidEntity()->getId());
	}

}