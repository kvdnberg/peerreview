# Netwerven PeerReview
Peer review board

To replace the Netwerven Post-It version so that we can all see the Peer Review board where ever we are.

## Laravel 5.0: installation instructions

For Netwervers: using netwerven vagrant box:

1. clone this repo on your machine
2. in the repo dir, run: project --ip-address=192.168.10.2xx
3. vagrant up
4. vagrant ssh
5. adjust apache config (sites-enabled/000-default), replace /var/www/app with /var/www/public
6. copy .env.example and change database parameters.
7. composer install
8. sudo npm install
9. gulp (will be added to composer later)

Any remarks or additions? Send them to karin < at > netwerven < dot > nl
