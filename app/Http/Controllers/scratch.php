curl 'localhost:9200/plans/_search?pretty' -d '
{
    "query": {
        "match_phrase": { "stripe_plan_name": {"query":"jawn","analyzer":"english"} },
        "location"
    }
}'


curl -XPUT 'localhost:9200/plans/plans' -d '
{
"settings": {
"analysis": {
"analyzer": {
"english": {
"lowercase": true
}
}
}
}
}'





<!---->

curl -XPUT 'localhost:9200/plans?pretty' -H 'Content-Type: application/json' -d'
{
"settings": {
"analysis": {
"analyzer": {
"english": {
"tokenizer": "whitespace",
"lowercase": true
}
}
}
}
}
'
curl -XPOST 'localhost:9200/my_index/my_type?pretty' -H 'Content-Type: application/json' -d'
{
"first_name": "jawning bruce",
"age": "26"
}
'



curl -XDELETE 'localhost:9200/plans?pretty'

php artisan search:reindex

