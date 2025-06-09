markup: npm-i markup-build markup-copy
composer: composer-i

npm-i:
	cd local/markup/dom-egor && npm i

markup-build:
	cd local/markup/dom-egor && npm run build

markup-copy:
	mkdir -p local/templates/main/images/
	cp -r -f local/markup/vite/dist/*.svg local/templates/main/images/

composer-i:
	cd local/php_interface && composer i

composer-dump:
	cd local/php_interface && composer dump-autoload

orm:
	cd local/modules/craft.orm && composer i
	cd local/modules/craft.orm && php run.php orm:annotate -m all