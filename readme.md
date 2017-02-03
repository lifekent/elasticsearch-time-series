Basic example of using Elasticsearch as a time-series storage with PHP and Laravel/Lumen framework

You can easily send/track any events type, single (f.e. mouse click, audio/video start, ad start/stop), repeatable (f.e. audio/video pause/progress) etc

Available options:
1) Events tracking
2) Reports by:
    - total number of events by event type
    - total number of events by event type for a given period
    - hours histogram for the last N hours

Documentation
API documentation available with the http://apidocjs.com/
ElasticSearch documentation https://www.elastic.co/guide/en/elasticsearch/reference/current/index.html

POST request params must be a JSON string
Response has "hash" key which can be used as a session for sending an associated events, f.e. audio pause, audio progress for the same audio

Notes:
- don't forget to put right mappings, example file is in the database folder
- use elasticsearch/elasticsearch 5.0 if you use ElasticSearch >= 5.0