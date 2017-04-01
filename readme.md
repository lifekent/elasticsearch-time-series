
# Elasticsearch as a time-series storage
[![Issue Count](https://codeclimate.com/github/lifekent/elasticsearch-time-series/badges/issue_count.svg)](https://codeclimate.com/github/lifekent/elasticsearch-time-series)
#### Built with PHP and Lumen (Laravel) framework

You can easily send/track any events type, single (f.e. mouse click, audio/video start, ad start/stop), repeatable (f.e. audio/video pause/progress) etc

#### What's included:

1. Events tracking
2. Reports:
  * Total number of events by a requested event type for a given period
  * Histogram for a given period by the given interval
  
#### Instalation
You can run app on an existing LAMP/LEMP stack or with the provided Docker compose configuration

##### Running inside Docker
1. Build containers
$ cd /project_root && docker-compose build
2. Run docker
$ docker-compose up -d
3. Login to the workspace container
$ docker-compose run workspace bash
Repeat steps from 

##### Configure app
1. Create a new Elasticsearch index, from the project root:
$ curl -XPUT "https://elastichost/indexname/typename" -d @database/esmappings.json
2. Install project dependencies
$ php composer.phar install
3. Create and fill with the appropriate values your .env file
$ cp .env.example .env
4. Cache routes
$ php artisan route:cache

##### API Documentation
API documentation available with a [http://swagger.io/](http://swagger.io/)

#### Usage
##### Events tracking (POST request parameters must be a valid JSON string)
$ curl -H "Content-Type: application/json" -X POST "https://example.com/api/stats/pulse" -d '{"event":"audiostart", "domain":"https://video.example.com", "uid":"123"}' 

Response has a "session" key which can be used as a session for sending an associated events, f.e. audio progress for the same
audio or video

##### Reporting API
Available at 
https://example.com/api/count - Total events
https://example.com/api/histogram - Date histogram
