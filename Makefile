markup: npm-i markup-build markup-copy
composer: composer-i

npm-i:
	cd local/markup/dom-egor && npm i
	cd local/markup/html && npm i

markup-build:
	cd local/markup/dom-egor && npm run build
	cd local/markup/html && npm run build

markup-copy:
	mkdir -p local/templates/main/images/
	cp -r local/markup/html/build/css local/templates/main/
	cp -r local/markup/html/build/js local/templates/main/
	cp -r local/markup/html/build/images local/templates/main/

composer-i:
	cd local/php_interface && composer i

composer-dump:
	cd local/php_interface && composer dump-autoload

orm:
	cd local/modules/craft.orm && composer i
	cd local/modules/craft.orm && php run.php orm:annotate -m all