.PHONY: clean install-dependencies update-dependencies setup-dev test-integration
.DEFAULT_GOAL := help

PHPUNIT =  ./vendor/bin/phpunit -c ./phpunit.xml

clean:
	rm -rf ./vendor ./var/cache

install-dependencies:
	composer install --no-scripts --no-interaction

update-dependencies:
	composer update --no-scripts --no-interaction

setup-dev: clean install-dependencies

test-integration:
	rm -rf ./var/cache
	${PHPUNIT} --testsuite=Integration

help:
	# Usage:
	#   make <target> [OPTION=value]
	#
	# Targets:
	#   clean                Cleans the coverage and the vendor directory
	#   install-dependencies Run composer install
	#   update-dependencies  Run composer update
	#   setup-dev            Delete build and vendor folder and install dependencies
	#   test-integration     Run all the tests with phpunit
	#   help                 You're looking at it!
