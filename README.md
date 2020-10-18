# Project - backend

## Installation instructions

Requirements:

- php version `7.3+`

- symfony [binary](https://symfony.com/download)

- `symfony check:requirements`

```sh
composer install
cp .env .env.local
```

In .env.local:

- add your db credentials there and specify db version

To run migrations and create admin run these commands. 
```sh
bin/console d:m:m
bin/console d:f:l
```
To run project on your local machine use command:
```sh
symfony server:start
```
## Update instructions

```sh
composer install
bin/console d:m:m
```

## Usage instructions

Admin is available under `/admin`.
Examples of video_link for video to become embed: 
```sh
https://www.youtube.com/watch?v=9PA8P_zIjtY
https://youtu.be/9PA8P_zIjtY
https://www.youtube.com/embed/9PA8P_zIjtY
```                                              

If you used dummy data, you can login with email
 ```sh
Login: admin@gmail.com
Password: AdminPassword150
```  
Frontend endpoints:
 ```sh
/interview
/conversation
/tag
/editorial
/room
/team
/gallery
/play-internal
/play-external
/welcome-video
/comment
```  
## Some comments
- On backend there is only one gallery created automatically. So all gallery images will be in one gallery.
- While creating first welcome-video the 'Create new' button will dissapear, so admin will be allowed only edit it (without delete)
- on `/tag` endpoint there is a tag cloud and when clicking on tag will generate the route for questionaire parts list with that tag
- Tags font size becomes large if count of it's questionaire parts is > than average count of questionaires of all tags