# Setup
Add host to /etc/hosts
```
127.0.0.1      www.local.test-sonata.com
```

Override docker-compose
```
cp docker-compose.override.yml.dist docker-compose.override.yml
```
and edit docker-compose.override.yml with your configuration


Run
```
$ docker-compose build
$ docker-compose up -d
$ make install
```

Then go to :
http://www.local.test-sonata.com/admin/dashboard

# How to reproduce bug
1. On dashboard page click "Add new"
2. Once on edit page click "Add new" under B's
3. Then click "Add new" under C's



Then you can see the error:

**Admin "App\Admin\BAdmin" has no subject**

This error appear on ajax response