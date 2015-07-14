# Netwerven PeerReview
Peer review board

To replace the Netwerven Post-It version so that we can all see the Peer Review board where ever we are.

## Laravel 5.0: installation instructions


1. clone this repo on your machine (git clone -b develop <repo url>)
2. copy .env.example to .env and change the parameters for database etc.

For Vagrant Box (Netwerven)
3. in the repo dir, run: project (see Netwerven/vagrant repo for more information)
4. vagrant up
5. vagrant ssh

For Server as well as Vagrant box:
6. adjust apache config (sites-enabled/000-default for Vagrant), set docroot to /var/www/public and restart apache
7. composer install




Any remarks or additions? Send them to karin < at > netwerven < dot > nl
