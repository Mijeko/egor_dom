webpack: npm-i markup-build
composer: composer-i

npm-i:
	cd local/markup/abn && npm i

markup-build:
	cd local/markup/abn && npm run build

composer-i:
	cd local/php_interface && composer i

composer-dump:
	cd local/php_interface && composer dump-autoload

tests:
	cd local/php_interface/vendor/phpunit/phpunit && php phpunit -c /var/www/dom.local/local/php_interface/phpunit.xml

orm:
	cd local/modules/craft.orm && composer i
	cd local/modules/craft.orm && php run.php orm:annotate -m all

import:
	php local/php_interface/console/import.php

phpstan:
	cd local/php_interface && php vendor/phpstan/phpstan/phpstan analyze