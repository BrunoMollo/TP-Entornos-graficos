<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Setup 🚀

Basado en [esta plantilla](https://github.com/refactorian/laravel-docker/tree/main)

### Solo una vez, luego de clonar el proyecto

```sh
cp .env.example .env
docker compose up -d
docker compose exec php bash
composer setup
```
#### Troubleshooting
- Si al correr el utlimo comando salta el error diciendo que no encuentra `setup`, proba reiniciando los conenedores con el comando
```sh
docker compose down && docker compose up -d
docker compose exec php bash
composer setup
```

- Si e el navegodor salta un error relacionado al directorio `storage`, puede deverse a un tema de permisos, cambielo con el siguiente comando

```sh
chmod o+w ./storage/ -R
```

### Levantar el servidor

```sh
docker compose up -d
```

El servidor estara disponible en [http://localhost:8000](http://localhost:8000)
