<?php
declare(strict_types=1);

namespace App\Validation;

use App\Entity\EntityInterface;
use App\Trait\EntityReflection;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RequestValidation
{
	use EntityReflection;

	protected array $errors = [];
	protected ?array $requestContent;
	private ?EntityInterface $entity;

	public function __construct(protected readonly ValidatorInterface $validator,
								protected readonly ManagerRegistry    $registry,
								protected RequestStack                     $request)
	{
		$this->requestContent = json_decode($this->request->getCurrentRequest()->getContent(), true);
		if(!$this->requestContent){
			$this->errors[] = 'Request is not valid JSON';
		}
	}

	/**
	 * @return EntityInterface | null
	 */
	final public function getEntity(): ?EntityInterface
	{
		return $this->errors ? null : $this->entity;
	}

	/**
	 * @return array
	 */
	final public function getErrors(): array
	{
		return $this->errors;
	}

	final public function validate(): self
	{
		if (!$this->entity) {
			return $this;
		}
		$this->prepareRelationProperties();
		$this->populate();

		$errors = $this->validator->validate($this->entity);
		foreach ($errors as $error) {
			$this->errors[] = $error->getMessage();
		}

		return $this;
	}

	private function prepareRelationProperties(): void
	{

		if(!$this->requestContent){
			return;
		}
		foreach ($this->extractRelationProperties($this->getRelationProperties($this->entity)) as $name => $value) {
			if (!isset($this->requestContent[$name])) {
				continue;
			}
			$repositoryName = $this->getRepositoryName($value);
			$repository = new $repositoryName($this->registry);
			assert($repository instanceof EntityRepository);
			$entityInstance = $repository->find($this->requestContent[$name]);
			if (!$entityInstance) {
				$this->errors[] = $name . ' with id ' . $this->requestContent[$name] . ' does not exists';
			}
			$this->requestContent[$name] = $entityInstance ?? null;
		}
	}

	private function populate(): void
	{
		if(!$this->entity || !$this->requestContent){
			return;
		}
		foreach ($this->requestContent as $name => $value) {
			$setter = 'set' . $name;
			if (!method_exists($this->entity, $setter)) {
				$this->errors[] = 'Couldn\'t find ' . $name . ' as data destiny.';
				continue;
			}

			$this->entity->$setter($value);
		}
	}

	protected function persist(?EntityInterface $entity): void
	{
		if (!$entity) {
			$this->errors[] = 'Could not reach selected element';
		}
		$this->entity = $entity;
	}
}