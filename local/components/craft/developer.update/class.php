<?php

use Craft\Core\Component\AjaxComponent;
use Craft\Core\Rest\ResponseBx;
use Craft\DDD\Developers\Application\Dto\DeveloperSettingsUpdateDto;
use Craft\DDD\Developers\Application\Factory\DeveloperSettingsUpdateUseCaseFactory;
use Craft\DDD\Developers\Application\UseCase\DeveloperSettingsUpdateUseCase;
use Craft\Enum\ChannelListEnum;

class CraftDeveloperUpdateComponent extends AjaxComponent
{
	private ?DeveloperSettingsUpdateUseCase $developerSettingsUpdateUseCase = null;

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
			$this->developerSettingsUpdateUseCase->execute(
				new DeveloperSettingsUpdateDto(
					$formData['developerId'],
					$formData['sources'],
					$formData['timeoutBron'],
					$formData['timePay'],
					$formData['channelLead'],
				)
			);


			ResponseBx::success([

			]);

		} catch(Exception $e)
		{
			ResponseBx::badRequest($e->getMessage());
		}
	}

	protected function modules(): ?array
	{
		return [];
	}

	protected function loadData(): void
	{
		$contactChannel = array_reduce(ChannelListEnum::cases(), function(array $init, ChannelListEnum $item) {
			$init[] = ['value' => $item->name, 'label' => $item->value];
			return $init;
		}, []);

		$this->arResult['CHANNELS'] = $contactChannel;
	}

	public function loadServices(): void
	{
		$this->developerSettingsUpdateUseCase = DeveloperSettingsUpdateUseCaseFactory::getUseCase();
	}
}