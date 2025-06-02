<?php

use Craft\Slider\Params\SizeSpecification;

class DevelopRichSlider extends CBitrixComponent
{


	public function onPrepareComponentParams($arParams)
	{
		$arParams['IBLOCK_ID'] = intval($arParams['IBLOCK_ID']);
		$arParams['SORT_KEY'] = $arParams['SORT_KEY'] ?: 'SORT';
		$arParams['SORT_DIRECTION'] = in_array($arParams['SORT_DIRECTION'], ['ASC', 'DESC']) ? $arParams['SORT_DIRECTION'] : 'ASC';
		return $arParams;
	}

	public function executeComponent()
	{
		try
		{
			$this->initModules();
			$this->loadData();
			$this->prepareData();
			$this->includeComponentTemplate();
		} catch(Exception $e)
		{

			echo $e->getMessage();

			return;
		}
	}

	protected function initModules(): void
	{
		foreach(['iblock', 'craft.slider'] as $module)
		{
			if(!\Bitrix\Main\Loader::includeModule($module))
			{
				throw new Exception('Module "' . $module . '" not found');
			}
		}
	}

	protected function loadData(): void
	{

		$slidesQuery = CIBlockElement::GetList(
			[
				$this->arParams['SORT_KEY'] => $this->arParams['SORT_DIRECTION'],
			],
			[
				'ACTIVE'    => 'Y',
				'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
			],
			false,
			false,

		);

		while($slide = $slidesQuery->GetNextElement())
		{
			$slideFields = $slide->GetFields();
			$slideProperties = $slide->GetProperties(false, [
				'CODE' => $this->arParams['PROPERTY'],
			]);

			$property = $slideProperties[$this->arParams['PROPERTY']];

			$source = $property['VALUE']['SOURCE'];
			$adaptive = $property['VALUE']['ADAPTIVE'];
			$sizes = $property['VALUE']['SIZE'];

			$index = -1;
			$sizes = array_map(function($item) use ($adaptive, &$index) {
				$index++;
				$adaptiveItem = $adaptive[$index];
				return [
					'point' => $item['value'],
					'type'  => $item['rule'],
					'image' => $adaptiveItem['SRC'],
				];

			}, $sizes);

			$this->arResult['SLIDER']['slides'][] = [
				'image' => $source['SRC'],
				'sort'  => $slideFields['SORT'],
				'sizes' => $sizes,
			];
		}
	}

	protected function prepareData(): void
	{
		$this->sortingSizes();
	}

	protected function sortingSizes(): void
	{
		if($this->arResult['SLIDER']['slides'])
		{
			$slides = $this->arResult['SLIDER']['slides'];


			foreach($slides as &$slide)
			{
				$_sizes = [];

				$groupByTypeSizes[SizeSpecification::TYPE_MAX_WIDTH] = array_filter($slide['sizes'], function($slide) {
					return $slide['type'] === SizeSpecification::TYPE_MAX_WIDTH;
				});

				$groupByTypeSizes[SizeSpecification::TYPE_BETWEEN] = array_filter($slide['sizes'], function($slide) {
					return $slide['type'] === SizeSpecification::TYPE_BETWEEN;
				});

				$groupByTypeSizes[SizeSpecification::TYPE_MIN_WIDTH] = array_filter($slide['sizes'], function($slide) {
					return $slide['type'] === SizeSpecification::TYPE_MIN_WIDTH;
				});


				foreach($groupByTypeSizes as $typeSizes => &$sizes)
				{
					switch($groupByTypeSizes)
					{
						case SizeSpecification::TYPE_MAX_WIDTH:
							usort($sizes, function($a, $b) {
								return $a['point'] > $b['point'] ? -1 : 1;
							});
							break;
						case SizeSpecification::TYPE_MIN_WIDTH:
							usort($sizes, function($a, $b) {
								return $a['point'] > $b['point'] ? -1 : 1;
							});
							break;
						case SizeSpecification::TYPE_BETWEEN:
							usort($sizes, function($a, $b) {
								return $a['point'] > $b['point'] ? -1 : 1;
							});
							break;
					}
				}

				$_sizes = array_merge($_sizes, $groupByTypeSizes[SizeSpecification::TYPE_MAX_WIDTH]);
				$_sizes = array_merge($_sizes, $groupByTypeSizes[SizeSpecification::TYPE_MIN_WIDTH]);
				$_sizes = array_merge($_sizes, $groupByTypeSizes[SizeSpecification::TYPE_BETWEEN]);

				$slide['sizes'] = $_sizes;
			}


			$this->arResult['SLIDER']['slides'] = $slides;
		}
	}

}