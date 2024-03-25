
# Prueba Fullstack

Prueba fullstack sin frameworks: HTML - CSS - JavaScript - PHP - MariaDB - Docker


## PHP Endpoints

### Create User

POST: http://localhost:8080/api/usuario

Body:

```javascript
{
    "fullname": "Axel Andres Cruz Cordova",
    "email": "axel@correo.com",
    "pass": "123456",
    "openid": "13456"
}
```

### Update User

PUT: http://localhost:8080/api/usuario?id=1

Body:

```javascript
{
    "fullname": "Axel Andres Cruz Cordova",
    "email": "axel@correo.com",
    "pass": "nuevopass",
    "openid": "13456"
}
```

### Get User

GET: http://localhost:8080/api/usuario?id=1

### Delete User

DELETE: http://localhost:8080/api/usuario?id=1


### Create Comment

POST: http://localhost:8080/api/comment

Body:

```javascript
{
    "user": 1,
    "coment_text": "Hello everyone!",
    "likes": 0
}
```

### Create Comment

PUT: http://localhost:8080/api/comment

Body:

```javascript
{
    "user": 1,
    "coment_text": "Hello everyone! this is my new message",
    "likes": 0
}
```

### Get Comment

GET: http://localhost:8080/api/comment?id=1

### Get All Comments

GET: http://localhost:8080/api/comment/all

### Delete Comment

GET: http://localhost:8080/api/comment?id=1
## Postman Examples

[Documentation](https://documenter.getpostman.com/view/25443512/2sA35Bcjtb)


## Author

- [@axlkun](https://www.github.com/axlkun)

