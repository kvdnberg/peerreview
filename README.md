# Netwerven PeerReview
Peer review board

To replace the Netwerven Post-It version so that we can all see the Peer Review board where ever we are.

## Laravel 5.0: installation instructions


* clone this repo on your machine (git clone -b develop <repo url>)
* copy .env.example to .env and change the parameters for database etc.

For Vagrant Box (Netwerven)
* in the repo dir, run: project (see Netwerven/vagrant repo for more information)
* vagrant up
* vagrant ssh

For Server as well as Vagrant box:
* adjust apache config (sites-enabled/000-default for Vagrant), set docroot to /var/www/public and restart apache
* composer install




Any remarks or additions? Send them to karin < at > netwerven < dot > nl
