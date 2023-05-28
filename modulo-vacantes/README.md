<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Setup

Para levantar el servidor de desarrollo es necesario tener instalado [Docker](https://docs.docker.com/).

Una vez instalada esta dependencia, se puede inicia el servidor 
con el ejecutable `sail` que se encuantra dentro de la carpeta `vendor`.
El mismo se llama utilizando el siguiente comando:
:::bash
  ./vendor/bin/sail up
:::

Ese comando levantara una serie de contenedores en utilizando `docker compose`, incluyedo `mysql` entre otros servicios.


