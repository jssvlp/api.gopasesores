version: '3.5'
services:
  blackcloset_db:
    container_name: blackcloset_db
    image: mysql:8.0
    command: --default-authentication-plugin=mysql_native_password
    restart: always
    networks:
      blackcloset_fs:
        aliases:
          - db
    environment:
      MYSQL_ROOT_PASSWORD: by86yZLsx8HEBhG6
    volumes:
      - ./mysql:/var/lib/mysql
    #ports:
      #- 8098:3306

  365_food_facturascripts:
    container_name: blackcloset_app
    image: facturascripts/facturascripts:latest
    restart: always
    ports:
      - 83:80
    networks:
      blackcloset_fs:
       aliases:
         - app
    volumes:
      - ./facturascripts:/var/www/html

#Docker Networks
networks:
  blackcloset_fs:
    name: blackcloset-fs-network

