<?php
declare(strict_types=1);
namespace App\Validation;

class Validate
{
	public static function email(mixed $email): bool
	{
		preg_match("/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/", $email, $matches);

		return (bool) $matches;
	}

	public static function phone(mixed $phone): bool
	{
		return strlen((string)$phone) === 9;
	}
}