


Сбилдить образы
    # Билдит все докер образы.
    docker-compose build

    #  Удаляет старый кеш и билдит с нуля (дольше будет билдить)
    docker-compose build --no-cache

Запустить контейнеры:
    # Поднимет все контейнеры записаные в docker-compose файле. Если контейнеры не сбилдены
    # сам их сбилдит. Если вы изменили вайлы докера нужно сбилдить заново перед запуском
    docker-compose up -d

Удалить контейнеры:
    # Удаляяет контейнеры
    docker-compose down





# следующие команды для носителей виндовса



composer-install:
    # для установки пакетов через композер
    docker-compose exec php-cli composer install --prefer-source --no-interaction


composer-update:
    # для обновления пакетов если добавите новые пакеты или обновите
    docker-compose exec php-cli composer update --prefer-source --no-interaction


migrate:
    # для того чтобы запустить миграции
docker-compose exec php-cli php artisan migrate


storage-link:
    docker-compose exec php-cli-admin php artisan storage:link
