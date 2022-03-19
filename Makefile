database-test:
	php bin/console doctrine:database:drop --if-exists --force --env=test
	php bin/console doctrine:database:create --env=test
	php bin/console doctrine:migrations:migrate --env=test
	php bin/console doctrine:fixtures:load --env=test

database:
	php bin/console doctrine:database:drop --if-exists --force
	php bin/console doctrine:database:create
	php bin/console doctrine:migrations:migrate
