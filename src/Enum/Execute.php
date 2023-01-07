<?php
declare(strict_types=1);
namespace App\Enum;

enum Execute
{
	case GET;
	case UPDATE;
	case CREATE;
	case DELETE;
}