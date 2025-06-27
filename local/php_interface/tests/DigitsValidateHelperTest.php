<?php

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversMethod;
use Craft\Helper\DigitsValidateHelper;

#[CoversMethod(DigitsValidateHelper::class, 'testFromSnakeCaseToCamelCase')]
class DigitsValidateHelperTest extends TestCase
{

	protected function setUp(): void
	{
	}

	public function testValidateDigits()
	{
		$this->assertTrue(
			DigitsValidateHelper::validateDigits('12345', 5),
		);
		$this->assertFalse(
			DigitsValidateHelper::validateDigits('-2-4-5', 3),
		);
		$this->assertTrue(
			DigitsValidateHelper::validateDigits('1237700103277', 13),
		);
		$this->assertFalse(
			DigitsValidateHelper::validateDigits('12ы37фв70фыв0в1фы0вфы3вфы277', 13),
		);
	}
}