### Basic example of using Elasticsearch as a time-series storage with PHP and Laravel/Lumen framework

You can easily send/track any events type, single (f.e. mouse click, audio/video start, ad start/stop), repeatable (f.e. audio/video pause/progress) etc

#### Available options:

1. Events tracking
2. Reports by:
  * Total number of events by event type for a given period
  * Histogram for a given period by the given interval

#### Documentation
API documentation available with [http://swagger.io/](http://swagger.io/)

ElasticSearch documentation [https://www.elastic.co/guide/en/elasticsearch/reference/current/index.html](https://www.elastic.co/guide/en/elasticsearch/reference/current/index.html)

##### POST request parameters must be a JSON string
Response has a "session" key which can be used as a session for sending an associated events, f.e. audio progress for the same audio item

##### Notes:
  * Don't forget to put right mappings for the time field (check config/database.php)
  * Use "elasticsearch/elasticsearch: 5.0" dependency if you use ElasticSearch >= 5.0