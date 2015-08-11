# explosm-builder
build an images 'database' from Explosm Comic Generator

# building
- Grab a lot of RCG images with the `downloader.sh`
- Run `php explosmer.php` (in a linux console, not on a web page) to build the images
- Images are on "final" directory

# how does it works ?
- Requesting a lot of explosm.net/rcg to grab the differents generated image
- Images are build like: http://files.explosm.net/rcg/ImageleftImagecenterImageright.png
- We keep only unique « Imagename » from file list downloaded
- We request rcg with 3 times the same image, to have left/center/right part the same
- We keep the 1st and 3rd image, then we merge it to remove the watermark
- We add a copyright on the picture
