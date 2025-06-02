<?php

namespace Craft\User\Application\Entity;

// @phpstan-ignore-next-line
class JUser extends EO_JUser
{

	/**
	 * @param array<string, string> $data
	 */
	public function fillFromArray(array $data): JUser
	{
		try
		{
			foreach($data as $key => $value)
			{
				$this->set($key, $value);
			}
		} catch(\Exception $e)
		{
		}

		return $this;
	}

}