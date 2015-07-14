# Netwerven PeerReview
Peer review board

To replace the Netwerven Post-It version so that we can all see the Peer Review board where ever we are.

## Laravel 5.0: installation instructions


1. clone this repo on your machine
2. copy .env.example to .env and change the parameters for database etc.

For Vagrant Box (Netwerven)
3. in the repo dir, run: project --ip-address=192.168.10.2xx
4. vagrant up
5. vagrant ssh

For Server as well as Vagrant box:
6. adjust apache config (sites-enabled/000-default), replace /var/www/app with /var/www/public

For Server:
7. composer install




Any remarks or additions? Send them to karin < at > netwerven < dot > nl
