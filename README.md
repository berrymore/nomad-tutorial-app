# Nomad Tutorial App

Build an application image

```shell
docker build -t berrymore/nomad-tutorial-app:latest -f docker/Dockerfile .
```

### Environment Variables

| Variable      | Description                   |
|---------------|-------------------------------|
| BIND_ADDR     | Advertising IP                |
| BIND_PORT     | Advertising port              |
| API_HOST      | Address of an API application |
| API_PORT      | Port of an API application    |
| MEMCACHE_HOST | Address of Memcached          |
| MEMCACHE_PORT | Port of Memcached             |
