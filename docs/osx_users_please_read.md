File access performance

The Docker Mac native client has file access performance issues. To correct
this until the native client is up to snuff here is steps to get `near`
native performance.

Ensure the native client is not running and all containers have stopped.

In your projects root create a `docker-compose.override.yml` file. In the
file we will create an override for the Volume mounts. See the following
example:

```YML
./docker-compose.yml:

app:
  build: docker/php
  working_dir: /app
  volumes:
    - ./:/app
    - ./docker/php/php.ini:/usr/local/etc/php/php.ini
  links:
    - db
    - mailcatcher
```

```YML
./docker-compose.override.yml:

app:
  volumes:
    - /mnt/Sites/yii2-starter-kit.dev:/app
    - ./docker/php/php.ini:/usr/local/etc/php/php.ini
```

Notice the new `/mnt` point. Think of this as an alias to /User/$USER (your
users home directory). Currently D4M ONLY mounts this directory. This is
the ONLY part of the configuration you need to override. As long as your
projects are in your users home directory or below all is good.

Finally we will run the D4M script that creates a NFS file mount into the
docker mini linux host machine
- `cd ~/`
- `git clone https://github.com/IFSight/d4m-nfs.git`
- `./d4m-nfs/d4m-nfs.sh`