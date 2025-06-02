<?php

namespace Craft\Slider\Params;

class SizeSpecification
{

	const TYPE_MAX_WIDTH = 'max-width';
	const TYPE_MIN_WIDTH = 'min-width';
	const TYPE_BETWEEN = 'between';

	const TYPE_BY_TEMPLATE_MOBILE = 'mobile';
	const TYPE_BY_TEMPLATE_TABLET = 'tablet';

	public static function specification(): array
	{
		return [
			self::TYPE_MAX_WIDTH => 'Максимальная ширина (max-width)',
			self::TYPE_MIN_WIDTH => 'Минимальная ширина (min-width)',
			self::TYPE_BETWEEN   => 'Между точками (between)',
		];
	}

	public static function specificationTemplates(): array
	{
		return [
			self::TYPE_BY_TEMPLATE_MOBILE => 'Мобильная картинка',
			self::TYPE_BY_TEMPLATE_TABLET => 'Изображение для планшета',
		];
	}
}