build:
	mkdir -p ./build
	rm -f composer.lock
	curl -sS https://getcomposer.org/installer | php
	php composer.phar install
	php buildPhar.php
	./vendor/bin/phpunit ./unitTests

clean:
	rm -rf ./build

