- composer install
- php bin/console m:m
- php bin/console d:f:l : to insert two user one with ROLE_ADMIN, the one with ROLE_USER
- symfony serve
  
  Api endpoints:
  
- /api/entities
- /api/manufacturers
- /api/models
- api/ports

  genrate pdf:
- /pdf/entities
- /pdf/manufacturers
- /pdf/models
- /pdf/ports

To login : chose one of the users in the AppFixtures  : POST /api/login_check 
