<?php

use Bitrix\Main\ErrorCollection;
use Craft\Core\Component\AjaxComponent;
use Craft\User\Application\Auth\Social\GoogleAuthorization;
use Craft\User\Domain\Dto\UserRegisterDto;
use Craft\User\Application\Service\Register;
use Craft\User\Admin\Settings\AvailableSocial;
use Craft\User\Application\Auth\Social\VkAuthorization;
use Craft\User\Application\Service\RegisterFactory;

class JediUserRegisterComponent extends AjaxComponent
{
	protected ?Register $userRegisterService;

	public function onPrepareComponentParams($arParams)
	{
		return parent::onPrepareComponentParams($arParams);
	}

	protected function store(array $formData): void
	{

		$phone = $formData['PHONE'];
		unset($formData['PHONE']);

		$email = $formData['EMAIL'];
		unset($formData['EMAIL']);

		$password = $formData['PASSWORD'];
		unset($formData['PASSWORD']);


		$this->userRegisterService
			->usePhone($this->usePhone())
			->registerUser(
				$email,
				$phone,
				$password,
				UserRegisterDto::fromArray($formData)
			);
	}

	protected function validate(array $postData): void
	{
		if(empty($postData['PHONE']))
		{
			$this->addValidationError('PHONE', 'Телефон должен быть заполнен');
		}

		if(empty($postData['EMAIL']))
		{
			$this->addValidationError('EMAIL', 'E-mail должен быть заполнен');
		}

		if(empty($postData['PASSWORD']))
		{
			$this->addValidationError('PASSWORD', 'Пароль должен быть заполнен');
		}
	}

	function componentNamespace(): string
	{
		return 'craftUserForm';
	}

	protected function modules(): ?array
	{
		return ['craft.core', 'craft.user'];
	}

	protected function loadData(): void
	{
	}

	public function loadServices(): void
	{
		$this->userRegisterService = RegisterFactory::create();
		$this->errorCollection = new ErrorCollection();
	}

	//	code

	protected function usePhone(): bool
	{
		$val = COption::GetOptionString('main', 'new_user_phone_auth');
		return $val == 'Y';
	}

	public function showSocialAuth(): string
	{
		$availableSocials = AvailableSocial::instance()->value();
		$socialList = [];

		foreach($availableSocials as $social)
		{
			switch($social)
			{
				case AvailableSocial::V_VK:
					$socialList[] = new VkAuthorization();
					break;
				case AvailableSocial::V_GOOGLE:
					$socialList[] = new GoogleAuthorization();
					break;
			}
		}

		ob_start();
		?>
		<div class="social-auth-block">
			<?php
			foreach($socialList as $social)
			{
				?>
				<div class="social-auth-item">
					<a href="<?=$social->getRegisterLink();?>" target="_blank"><?=$social->label();?></a>
				</div>
				<?php
			}
			?>
		</div>
		<?php
		return ob_get_clean();
	}
}