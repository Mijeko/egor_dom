<?php

use Craft\Core\Component\AjaxComponent;
use Craft\Core\Rest\ResponseBx;
use Craft\DDD\Shared\Application\Service\ImageServiceInterface;
use Craft\DDD\Shared\Infrastructure\Service\ImageService;
use Craft\DDD\User\Domain\Entity\UserEntity;
use Craft\DDD\User\Domain\Repository\UserRepositoryInterface;
use Craft\DDD\User\Infrastructure\Repository\BxUserRepository;
use Craft\Dto\BxImageDto;
use Craft\Dto\BxUserDto;
use Craft\Helper\Criteria;
use Craft\Model\CraftUserTable;

class CraftStreamSearchUserComponent extends AjaxComponent
{

	private UserRepositoryInterface $userRepository;
	private ImageServiceInterface $imageService;

	function componentNamespace(): string
	{
		return 'streamSearchUser';
	}

	protected function validate(array $postData): void
	{
	}

	protected function work(array $formData): void
	{
		try
		{

			$users = $this->userRepository->findAll(Criteria::instance()->filter([
				CraftUserTable::F_EMAIL => $formData['source'],
			]));


			ResponseBx::success([
				'users' => array_map(function(UserEntity $user) {

					$avatarDto = null;

					if($user->getAvatarId())
					{
						$image = $this->imageService->findById($user->getAvatarId());
						if($image)
						{
							$avatarDto = new BxImageDto(
								$image->id,
								$image->src,
							);
						}
					}

					return BxUserDto::chatMember(
						$user->getId(),
						$user->getName(),
						$user->getEmail()->getValue(),
						$user->getPhone()->getValue(),
						$avatarDto
					);
				}, $users),
			]);

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
	}

	public function loadServices(): void
	{
		$this->userRepository = new BxUserRepository();
		$this->imageService = new ImageService();
	}
}