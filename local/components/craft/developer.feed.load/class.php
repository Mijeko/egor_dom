<?php

use Craft\Core\Component\AjaxComponent;
use Craft\DDD\Developers\Application\Factory\FeedUpdateUseCaseFactory;
use Craft\DDD\Developers\Application\UseCase\FeedUpdateUseCase;

class CraftDeveloperFeedLoadComponent extends AjaxComponent
{
	private ?FeedUpdateUseCase $feedSettingsUpdateUseCase = null;

	function componentNamespace(): string
	{
		return 'craftDeveloperFeedLoad';
	}

	protected function validate(array $postData): void
	{
	}

	protected function work(array $formData): void
	{
		try
		{
			$this->feedSettingsUpdateUseCase->execute();


		} catch(Exception $e)
		{
		}
	}

	protected function modules(): ?array
	{
		return [];
	}

	protected function loadData(): void
	{

		$contactChannel = [
			['value' => 'tg', 'label' => 'Telegram'],
			['value' => 'email', 'label' => 'E-Mail'],
			['value' => 'phone', 'label' => 'Звонок по телефону'],
		];

		$this->arResult['CHANNELS'] = $contactChannel;
	}

	public function loadServices(): void
	{
		$this->feedSettingsUpdateUseCase = FeedUpdateUseCaseFactory::getUseCase();
	}
}