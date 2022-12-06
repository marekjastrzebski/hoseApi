<?php
declare(strict_types=1);

namespace App\Validation;

use App\Trait\RequestValidatorTrait;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RequestValidation
{
	use RequestValidatorTrait;

	protected array $errors = [];
	protected array $request;

	public function __construct(protected                             $entity,
								protected readonly ValidatorInterface $validator,
								protected readonly ManagerRegistry    $registry)
	{
		$this->request = Request::createFromGlobals()->toArray();
		$this->prepareRelationProperties();
		$this->populate();
	}

	/**
	 * @return array
	 */
	public function getErrors(): array
	{
		return $this->errors;
	}

	private function validate(): void
	{
		$errors = $this->validator->validate($this->entity);
		foreach ($errors as $error){
			$this->errors += $error;
		}
	}

	private function populate(): void
	{
		foreach ($this->request as $name => $value) {
			$setter = 'set' . $name;
			if (!method_exists($this->entity, $setter)) {
				$this->errors[] = 'Couldn\'t find ' . $name . ' as data destiny.';
				continue;
			}

			$this->entity->$setter($value);
		}
	}

	private function prepareRelationProperties(): void
	{
		foreach ($this->extractRelationProperties($this->getRelationProperties($this->entity)) as $name => $value) {
			if (!isset($this->request[$name]) || !is_int($this->request[$name])) {
				continue;
			}
			$repositoryName = $value . 'Repository';
			$repository = new $repositoryName($this->registry);
			assert($repository instanceof EntityRepository);
			$entityInstance = $repository->find($this->request[$name]);
			if (!$entityInstance) {
				$this->errors[] = $name . ' with id ' . $this->request[$name] . ' does not exists';
			}

			$this->request[$name] = $entityInstance ?? null;
		}
	}
}