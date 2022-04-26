build:
	$(MAKE) reset-database
	$(MAKE) test-unitaire

reset-database:
	php bin/console doctrine:database:drop --if-exists --force
	php bin/console doctrine:database:create
	php bin/console doctrine:migration:migrate -n
	php bin/console doctrine:fixtures:load -n

test-unitaire:
	php bin/console doctrine:fixtures:load -n
	php bin/phpunit

.PHONY: reset-database
.PHONY: test-unitaire
