
<p align="center"><img src="scheme.png" alt="Структурная схема данных"></p>

# VR Pharmacy API

API для проекта VR Pharmacy

## Запуск API с внешними зависимостями (PostgreSQL, Redis)

Для сборки использовать:

```bash
$ docker-compose -f docker-compose-containerized.yaml build
```

Для запуска:

```bash
$ docker-compose -f docker-compose-containerized.yaml up -d
```

При первом запуске также выполнить:

```bash
$ docker-compose -f docker-compose-containerized.yaml exec api php artisan migrate --force --seed
```

Для остановки использовать:

```bash
$ docker-compose -f docker-compose-containerized.yaml down
```

## Запуск легкой версии API без зависимостей All In One (SQLite в контейнере)

Для сборки использовать:

```bash
$ docker-compose -f docker-compose-lite.yaml build
```

Для запуска:

```bash
$ docker-compose -f docker-compose-lite.yaml up -d
```

При первом запуске также выполнить:

```bash
$ docker-compose -f docker-compose-lite.yaml exec api php artisan migrate --force --seed
```

Для остановки использовать:

```bash
$ docker-compose -f docker-compose-lite.yaml down
```

## Документация API

После запуска любой версии документация к API будет доступна по адресу: [http://localhost:8001/fly-docs](http://localhost:8001/fly-docs)
