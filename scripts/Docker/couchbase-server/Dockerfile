FROM couchbase:community

#
# Thanks to Brandt Burnett for the Reference
# See https://github.com/brantburnett/couchbasefakeit/blob/master/Dockerfile
# Also https://hub.docker.com/r/btburnett3/couchbasefakeit
#

RUN  mkdir /scripts
COPY configure.sh /scripts/configure.sh
RUN chmod +x /scripts/configure.sh

WORKDIR /scripts

ENTRYPOINT ["./configure.sh"]
