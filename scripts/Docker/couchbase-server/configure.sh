#!/bin/bash

#
# Thanks to Brandt Burnett for this reference
# https://github.com/brantburnett/couchbasefakeit/blob/master/scripts/configure-node.sh
#

set -m

CB_CLI=/opt/couchbase/bin/couchbase-cli
CB_CBQ=/opt/couchbase/bin/cbq

# Start CB Server
/entrypoint.sh couchbase-server &

if [ ! -e "/nodestatus-initialized" ] ; then

  echo "Waiting for the Couchbase Server to Start"

  # Wait a bit for the Server to Start
  sleep 15

  echo "Initializing Couchbase Server"

  # initialize the cluster
  # if using enterprise, add "eventing, analytics" to list of services
  $CB_CLI cluster-init \
    --cluster couchbase://127.0.0.1 \
    --cluster-username $COUCHBASE_ADMINISTRATOR_USERNAME \
    --cluster-password $COUCHBASE_ADMINISTRATOR_PASSWORD \
    --cluster-ramsize 512 \
    --cluster-index-ramsize 512 \
    --cluster-name fsm \
    --services data,index,query,fts \
    && \
  $CB_CLI bucket-create \
    --cluster couchbase://127.0.0.1 \
    --username $COUCHBASE_ADMINISTRATOR_USERNAME \
    --password $COUCHBASE_ADMINISTRATOR_PASSWORD \
    --bucket $COUCHBASE_BUCKET \
    --bucket-type couchbase \
    --bucket-ramsize 512 \
    --bucket-replica 1 \
    --wait

  echo "Waiting 20 for server to calm..."
  sleep 20
  $CB_CBQ -e http://127.0.0.1:8093 -u $COUCHBASE_ADMINISTRATOR_USERNAME -p $COUCHBASE_ADMINISTRATOR_PASSWORD \
    -q=true -s="CREATE PRIMARY INDEX ON \`${COUCHBASE_BUCKET}\` USING GSI"

  echo "Couchbase Server initialized."
  echo "Initialized `date +"%D %T"`" > /nodestatus-initialized
else
  echo "Couchbase Server already initialized."
fi

# Wait for CB Server Shutdown
fg 1




