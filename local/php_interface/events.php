<?php

RegisterModuleDependences(
	"rest",
	"OnRestServiceBuildDescription",
	"main",
	\Craft\Rest\Handler::class,
	"onRestServiceBuildDescription"
);