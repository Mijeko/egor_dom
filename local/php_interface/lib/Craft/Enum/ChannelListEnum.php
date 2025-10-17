<?php

namespace Craft\Enum;

enum ChannelListEnum: string
{
	case TG = 'Телеграм';
	case EMAIL = 'E-mail';
	case PHONE = 'По телефону';
}