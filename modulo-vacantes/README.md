<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Setup 🚀

### Antes de arracar
Para levantar el servidor de desarrollo es necesario tener instalado: 
- **[Docker](https://docs.docker.com/)**.
- **npm**, se recomienda intalar **Node.js** usando **[nvm](https://github.com/nvm-sh/nvm)**
- **[Composer](https://getcomposer.org/)** 
- Si usas Windows, vas a necesitar **[WSL2](https://learn.microsoft.com/es-es/windows/wsl/install)**  para que Docker funcione. 

### Dependencias del proyecto
Luego de clonar el repositorio, estando parado en la carpeta `modulo-vacantes`, correr los siguientes comando para instalar las dependecias:
```bash
composer install
```
```bash
nmp i
```

### Levantar el servidor de desarrollo
Una vez instaladas las dependencias, se puede inicia el servidor 
con el ejecutable `sail` que se encuantra dentro de la carpeta `vendor\bin\`.
El mismo se llama utilizando el siguiente comando:
```bash
./vendor/bin/sail up
```
Ese comando levantara una serie de contenedores en utilizando `docker compose`, incluyedo `mysql` entre otros servicios.


A su vez, en otra consola es necesario levantar el otro servidor de desarollo con Vite, ya que usamos un preprocesador de CSS asi
que hay que tener un proceso de compliacion.Este otro servidor se levanta con:
```bash
npm run dev
```

Luego de todas estas vueltas, deberias poder ver la pagina de incion en [http://0.0.0.0/](http://0.0.0.0/) o en [http://localhost:80](http://localhost:80).


Espero que todo salga bien...
   
Que dios te bendiga
