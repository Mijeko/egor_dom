<?php

use Craft\DDD\Referal\Application\Facade\StorageManager;
use Craft\DDD\Referal\Application\UseCase\InviteUseCase;
use Craft\DDD\Referal\Domain\Entity\ReferralEntity;
use Craft\DDD\Referal\Domain\Repository\ReferralRepositoryInterface;
use Craft\DDD\Shared\Domain\ValueObject\ActiveValueObject;
use Craft\DDD\Shared\Domain\ValueObject\PhoneValueObject;
use Craft\Phpunit\Fakes\Service\ArrayStorageManager;
use Craft\Phpunit\Fakes\Repository\ArrayReferralRepository;
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
		$refCode = 'test1';
		$this->referralRepository = new ArrayReferralRepository();
		$this->storageManager = ArrayStorageManager::instance();

		$this->storageManager->storeCode($refCode);

		foreach([
					[
						'id'           => 1,
						'active'       => true,
						'userId'       => 1,
						'inviteUserId' => 0,
						'code'         => $refCode,
						'phone'        => '+79967026637',
					],
					[
						'id'           => 2,
						'active'       => true,
						'userId'       => 2,
						'inviteUserId' => 0,
						'code'         => 'test2',
						'phone'        => '+79967026636',
					],
				] as $referral)
		{
			$this->referralRepository->create(
				ReferralEntity::hydrate(
					$referral['id'],
					new ActiveValueObject($referral['active']),
					$referral['userId'],
					$referral['inviteUserId'],
					$referral['code'],
					new PhoneValueObject($referral['phone'])
				)
			);
		}

		$this->useCase = new InviteUseCase(
			$this->referralRepository,
			$this->storageManager
		);
	}

	public function testExecute()
	{
		$this->expectException(Exception::class);
		$this->useCase->execute(1);


		$this->assertNull($this->useCase->execute(2));
	}
}