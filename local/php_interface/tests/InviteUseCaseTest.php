<?php

use Craft\DDD\Referal\Application\Facade\StorageManager;
use Craft\DDD\Referal\Application\UseCase\InviteUseCase;
use Craft\DDD\Referal\Domain\Entity\ReferralEntity;
use Craft\DDD\Referal\Domain\Repository\ReferralRepositoryInterface;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;


#[CoversMethod(InviteUseCase::class, 'execute')]
class InviteUseCaseTest extends TestCase
{
	private InviteUseCase $useCase;
	private ReferralRepositoryInterface $referralRepository;
	private StorageManager $storageManager;

	protected function setUp(): void
	{
		$this->referralRepository = $this->createMock(ReferralRepositoryInterface::class);


		$user1 = $this->createMock(ReferralEntity::class);

		$this->referralRepository->create($user1);

		$this->storageManager = $this->createMock(StorageManager::class);

		$this->useCase = new InviteUseCase(
			$this->referralRepository,
			$this->storageManager
		);
	}

	public function testExecute()
	{
		$this->useCase->execute(1);
	}
}