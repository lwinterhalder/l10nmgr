.DEFAULT_GOAL := help
.PHONY: lint fix stan stan-baseline docs_render docs_serve

# help: @ List available tasks on this project
help:
	@grep -E '[a-zA-Z\.\-]+:.*?@ .*$$' $(MAKEFILE_LIST)| tr -d '#'  | awk 'BEGIN {FS = ":.*?@ "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

# lint: @ Lints all PHP files of the project
lint:
	composer ci:php:lint

# fix: @ Adjust the code to the CGL via PHP-CS-Fixer
fix:
	composer php:fix

# stan: @ Run PHPStan on the files
stan:
	composer ci:php:stan

# stan-baseline: @ Creates a new PHPStan baseline
stan-baseline:
	composer phpstan:baseline

# docs_render: @ Render the documentation
docs_render:
	composer typo3:docs:render

# docs_serve: @ Serve the rendered documentation
docs_serve: Documentation-GENERATED-temp
	composer typo3:docs:serve

Documentation-GENERATED-temp: docs_render

# test_php_8.1: @ Check the code compatibility with PHP 8.1
test_php_8.1:
	phpcs -p . --standard=PHPCompatibility --runtime-set testVersion 8.1 --ignore=.Build,Documentation-GENERATED-temp

# test_php_8.2: @ Check the code compatibility with PHP 8.2
test_php_8.2:
	phpcs -p . --standard=PHPCompatibility --runtime-set testVersion 8.2 --ignore=.Build,Documentation-GENERATED-temp
