# Image-Repository

Shoppify Challenge for backend development. 

Image repositroy is a platform to discover artists' work. 
Users can create accounts and add their own images.

https://image-repository-shopify2021.herokuapp.com/

The homepage is the "Discovery" section. It contains all images where the visibility was set to "public". By clicking on any of the images, you can see more information about that specific image.

The artists section provides an overview of all artists who have an image in their collection set to "public". By clicking on any artists, you can see all their "public" image. 

If you want to add images to the platform, you can do so by either logging in or signing up.
Click on Login/Sign Up. 
You can use the following credentials:
* Username: xdeng10
* Email: xdeng10@image.repo
You can also create your own. Just put any username and email. If it's already taken, an error message will showup. 
After signing in, the user's collection of images is shown in a list (public and private). You can add images using the "Add Images" button. You can also click on any images in the list to be able to edit that image's information. If you set an image's visibility to "private", that image will no longer appear on the public webpages ("Discover", "Artists", etc.).

Warning: Images uploaded to the website through Heroku app platform could disappear after a while. Heroku uses a temporary filesystem and all written files is discarded after a new deployment or as part of Heroku's normal dyno management.

A MySQL database can be found in assets if you want to download this repo and run it on your computer.

The design of the website is a template taken from "Mashup templates" and developped by "Orson.io" team. http://www.mashup-template.com/preview.html?template=savory



