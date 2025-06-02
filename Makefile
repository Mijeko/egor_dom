markup: npm-i markup-build markup-copy

npm-i:
	cd local/markup/vite && npm i

markup-build:
	cd local/markup/vite && npm run build

markup-copy:
	mkdir -p local/templates/main/images/
	cp -r -f local/markup/vite/dist/*.svg local/templates/main/images/