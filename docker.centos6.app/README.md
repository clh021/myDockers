docker build --rm -t leehom/wetrip:01 .
sudo docker run -it leehom/wetrip:01 /bin/bash

```
# CID=$(docker run -d -p 80 -p 22 <yourname>/wordpress:centos6)
```

Check docker logs after running to see MySQL root password and Wordpress MySQL password, as so:

```
# echo "$(docker logs $CID | grep password)"
```

(note: you won't need the mysql root or the wordpress db password normally)

Then find the external port assigned to your container:

```
# docker port $CID 80
```

Visit in a webrowser, then fill out the form. No need to mess with wp-config.php, it's been auto-generated with proper values.


Note that this image now has a user account (appropriately named "user") and passwordless sudo for that user account. The password is generated upon startup; check logs for "ssh user password", docker ps for the port assigned to 22, and something like this to get in:

```
# ssh -p <port> user@localhost
```


